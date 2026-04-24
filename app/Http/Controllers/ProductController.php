<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Eager load category to prevent N+1 queries
        $query = Product::query()->with('category');

        // Search optimization - use indexed columns
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%")
                  ->orWhere('barcode', 'like', "%{$search}%");
            });
        }

        // Filter by category (indexed)
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Filter by stock status (optimized)
        if ($request->filled('stock_status')) {
            if ($request->stock_status == 'low') {
                $query->whereColumn('stock_quantity', '<=', 'min_stock_alert')
                      ->where('stock_quantity', '>', 0);
            } elseif ($request->stock_status == 'out') {
                $query->where('stock_quantity', 0);
            }
        }

        // Use indexed is_active column
        $products = $query->where('is_active', true)
                          ->latest('updated_at')
                          ->paginate(12);

        // Cache categories for 1 hour (they don't change often)
        $categories = cache()->remember('active_categories', 3600, function () {
            return Category::where('is_active', true)->get();
        });

        return view('products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('products.form', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sku' => 'nullable|string|unique:products,sku',
            'barcode' => 'nullable|string|unique:products,barcode',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'cost_price' => 'nullable|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'min_stock_alert' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['image_url'] = $path;
        }

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit(Product $product)
    {
        $categories = Category::where('is_active', true)->get();
        return view('products.form', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sku' => 'nullable|string|unique:products,sku,' . $product->id,
            'barcode' => 'nullable|string|unique:products,barcode,' . $product->id,
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'cost_price' => 'nullable|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'min_stock_alert' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image_url) {
                Storage::disk('public')->delete($product->image_url);
            }
            $path = $request->file('image')->store('products', 'public');
            $validated['image_url'] = $path;
        }

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diupdate');
    }

    public function destroy(Product $product)
    {
        $product->update(['is_active' => false]);
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus');
    }

    /**
     * AJAX Search for products (User role)
     */
    public function search(Request $request)
    {
        $query = $request->get('q', '');
        
        // Cache search results for 5 minutes
        $cacheKey = 'product_search_' . md5($query);
        
        $products = cache()->remember($cacheKey, 300, function () use ($query) {
            return Product::where('is_active', true)
                ->where(function($q) use ($query) {
                    $q->where('name', 'LIKE', "%{$query}%")
                      ->orWhere('sku', 'LIKE', "%{$query}%")
                      ->orWhere('barcode', 'LIKE', "%{$query}%")
                      ->orWhere('description', 'LIKE', "%{$query}%");
                })
                ->with('category:id,name') // Only load needed category fields
                ->select('id', 'name', 'sku', 'barcode', 'description', 'price', 'stock_quantity', 'category_id', 'image_url')
                ->limit(50)
                ->get();
        });
        
        return response()->json([
            'success' => true,
            'products' => $products,
            'count' => $products->count()
        ]);
    }
}
