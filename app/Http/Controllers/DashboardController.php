<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $data = [
            'user' => $user,
        ];

        // Stats untuk Owner (cached for 5 minutes)
        if ($user->isOwner()) {
            $data['todaySales'] = cache()->remember('owner_today_sales_' . today()->format('Y-m-d'), 300, function () {
                return Transaction::whereDate('transaction_date', today())->sum('total');
            });
            
            $data['todayTransactions'] = cache()->remember('owner_today_transactions_' . today()->format('Y-m-d'), 300, function () {
                return Transaction::whereDate('transaction_date', today())->count();
            });
            
            $data['lowStockProducts'] = cache()->remember('low_stock_count', 300, function () {
                return Product::where('is_active', true)
                    ->whereColumn('stock_quantity', '<=', 'min_stock_alert')
                    ->count();
            });
            
            $data['totalProducts'] = cache()->remember('total_active_products', 300, function () {
                return Product::where('is_active', true)->count();
            });
            
            // Chart data - Sales per day (last 7 days)
            $data['salesChart'] = cache()->remember('sales_chart_7days_' . today()->format('Y-m-d'), 300, function () {
                return Transaction::whereDate('transaction_date', '>=', now()->subDays(6))
                    ->select(DB::raw('DATE(transaction_date) as date'), DB::raw('SUM(total) as total'))
                    ->groupBy('date')
                    ->orderBy('date')
                    ->get();
            });
            
            // Recent transactions
            $data['recentTransactions'] = cache()->remember('recent_transactions_5', 300, function () {
                return Transaction::with('user:id,name')
                    ->latest('transaction_date')
                    ->limit(5)
                    ->get();
            });
            
            // Monthly Sales Performance
            $data['monthlyTarget'] = 100000000; // Rp 100M target per bulan
            $data['monthlySales'] = cache()->remember('monthly_sales_' . now()->format('Y-m'), 300, function () {
                return Transaction::whereMonth('transaction_date', now()->month)
                    ->whereYear('transaction_date', now()->year)
                    ->sum('total');
            });
            $data['salesPercentage'] = $data['monthlyTarget'] > 0 
                ? round(($data['monthlySales'] / $data['monthlyTarget']) * 100) 
                : 0;
            
            // Last month sales for comparison
            $data['lastMonthSales'] = cache()->remember('last_month_sales_' . now()->subMonth()->format('Y-m'), 300, function () {
                return Transaction::whereMonth('transaction_date', now()->subMonth()->month)
                    ->whereYear('transaction_date', now()->subMonth()->year)
                    ->sum('total');
            });

            // Category distribution for chart
            $data['categoryChart'] = cache()->remember('category_stock_chart', 300, function () {
                return \App\Models\Category::withCount('products')
                    ->get(['id', 'name'])
                    ->map(function ($cat) {
                        return [
                            'name' => $cat->name,
                            'count' => $cat->products_count
                        ];
                    });
            });
        }

        // Stats untuk Cashier (cached for 5 minutes)
        if ($user->isCashier()) {
            $cacheKey = 'cashier_' . $user->id . '_today_' . today()->format('Y-m-d');
            
            $data['todayMySales'] = cache()->remember($cacheKey . '_sales', 300, function () use ($user) {
                return Transaction::where('user_id', $user->id)
                    ->whereDate('transaction_date', today())
                    ->sum('total');
            });
            
            $data['todayMyTransactions'] = cache()->remember($cacheKey . '_count', 300, function () use ($user) {
                return Transaction::where('user_id', $user->id)
                    ->whereDate('transaction_date', today())
                    ->count();
            });
            
            $data['myRecentTransactions'] = cache()->remember('cashier_' . $user->id . '_recent_5', 300, function () use ($user) {
                return Transaction::where('user_id', $user->id)
                    ->latest('transaction_date')
                    ->limit(5)
                    ->get();
            });
        }

        return view('dashboard', $data);
    }
}
