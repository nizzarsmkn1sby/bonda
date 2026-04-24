<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::with('user', 'items.product');

        // Filter by date range
        if ($request->has('start_date') && $request->start_date != '') {
            $query->whereDate('transaction_date', '>=', $request->start_date);
        }
        if ($request->has('end_date') && $request->end_date != '') {
            $query->whereDate('transaction_date', '<=', $request->end_date);
        }

        // Cashier only sees their own transactions
        if (auth()->user()->isCashier()) {
            $query->where('user_id', auth()->id());
        }

        $transactions = $query->latest('transaction_date')->paginate(20);

        return view('transactions.index', compact('transactions'));
    }

    public function show(Transaction $transaction)
    {
        $transaction->load('user', 'items.product');
        
        // Cashier can only see their own transactions
        if (auth()->user()->isCashier() && $transaction->user_id != auth()->id()) {
            abort(403);
        }

        return view('transactions.detail', compact('transaction'));
    }

    public function store(Request $request)
    {
        // Log incoming request for debugging
        \Log::info('=== TRANSACTION REQUEST START ===');
        \Log::info('Request Data:', $request->all());
        \Log::info('User:', ['id' => auth()->id(), 'name' => auth()->user()->name]);
        
        $validated = $request->validate([
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'payment_method' => 'required|in:cash,card,e-wallet',
            'payment_amount' => 'nullable|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'tax' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ]);
        
        \Log::info('Validated Data:', $validated);

        try {
            DB::beginTransaction();

            // Create transaction
            $transaction = Transaction::create([
                'transaction_number' => Transaction::generateTransactionNumber(),
                'user_id' => auth()->id(),
                'payment_method' => $validated['payment_method'],
                'discount' => $validated['discount'] ?? 0,
                'tax' => $validated['tax'] ?? 0,
                'payment_status' => 'completed',
                'notes' => $validated['notes'] ?? null,
                'subtotal' => 0, // Will be calculated
                'total' => 0, // Will be calculated
                'transaction_date' => now(), // FIXED: Added missing field
            ]);

            $subtotal = 0;

            // Create transaction items and update stock
            foreach ($validated['items'] as $item) {
                $product = Product::findOrFail($item['product_id']);

                // Check stock availability
                if ($product->stock_quantity < $item['quantity']) {
                    throw new \Exception("Stock {$product->name} tidak mencukupi");
                }

                $itemSubtotal = $product->price * $item['quantity'];
                $subtotal += $itemSubtotal;

                // Create transaction item
                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'unit_price' => $product->price,
                    'subtotal' => $itemSubtotal,
                ]);

                // Update product stock
                $product->updateStock(
                    -$item['quantity'],
                    'out',
                    'Transaction',
                    $transaction->id,
                    auth()->id()
                );
            }

            // Calculate totals
            $total = $subtotal + $transaction->tax - $transaction->discount;
            $transaction->update([
                'subtotal' => $subtotal,
                'total' => $total,
                'payment_amount' => $validated['payment_amount'] ?? $total,
                'change_amount' => ($validated['payment_amount'] ?? $total) - $total,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil',
                'transaction_id' => $transaction->id,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            
            // Log the error for debugging
            \Log::error('Transaction Error: ' . $e->getMessage());
            \Log::error('Stack Trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'error_type' => get_class($e),
                'line' => $e->getLine(),
                'file' => basename($e->getFile()),
            ], 422);
        }
    }

    public function print(Transaction $transaction)
    {
        $transaction->load('user', 'items.product');
        
        // Cashier can only print their own transactions
        if (auth()->user()->isCashier() && $transaction->user_id != auth()->id()) {
            abort(403);
        }

        return view('transactions.print', compact('transaction'));
    }
}
