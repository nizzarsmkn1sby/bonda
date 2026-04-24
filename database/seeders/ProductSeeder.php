<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $minumanCategory = Category::where('name', 'Minuman')->first();
        $makananCategory = Category::where('name', 'Makanan')->first();
        $snackCategory = Category::where('name', 'Snack')->first();

        $products = [
            // Minuman
            [
                'name' => 'Air Mineral 600ml',
                'description' => 'Air mineral kemasan botol',
                'sku' => 'MIN001',
                'barcode' => '8992761111001',
                'category_id' => $minumanCategory->id,
                'price' => 3000,
                'cost_price' => 2000,
                'stock_quantity' => 50,
                'min_stock_alert' => 10,
            ],
            [
                'name' => 'Teh Botol',
                'description' => 'Teh botol sosro',
                'sku' => 'MIN002',
                'barcode' => '8992761111002',
                'category_id' => $minumanCategory->id,
                'price' => 5000,
                'cost_price' => 3500,
                'stock_quantity' => 30,
                'min_stock_alert' => 10,
            ],
            [
                'name' => 'Kopi Kaleng',
                'description' => 'Kopi kaleng siap minum',
                'sku' => 'MIN003',
                'barcode' => '8992761111003',
                'category_id' => $minumanCategory->id,
                'price' => 7000,
                'cost_price' => 5000,
                'stock_quantity' => 25,
                'min_stock_alert' => 8,
            ],
            
            // Makanan
            [
                'name' => 'Nasi Goreng',
                'description' => 'Nasi goreng spesial',
                'sku' => 'MAK001',
                'category_id' => $makananCategory->id,
                'price' => 15000,
                'cost_price' => 8000,
                'stock_quantity' => 20,
                'min_stock_alert' => 5,
            ],
            [
                'name' => 'Mie Instant',
                'description' => 'Mie instant berbagai rasa',
                'sku' => 'MAK002',
                'barcode' => '8992761222001',
                'category_id' => $makananCategory->id,
                'price' => 3500,
                'cost_price' => 2500,
                'stock_quantity' => 100,
                'min_stock_alert' => 20,
            ],
            
            // Snack
            [
                'name' => 'Keripik Kentang',
                'description' => 'Keripik kentang rasa original',
                'sku' => 'SNK001',
                'barcode' => '8992761333001',
                'category_id' => $snackCategory->id,
                'price' => 10000,
                'cost_price' => 7000,
                'stock_quantity' => 40,
                'min_stock_alert' => 10,
            ],
            [
                'name' => 'Biskuit Coklat',
                'description' => 'Biskuit rasa coklat',
                'sku' => 'SNK002',
                'barcode' => '8992761333002',
                'category_id' => $snackCategory->id,
                'price' => 5000,
                'cost_price' => 3500,
                'stock_quantity' => 60,
                'min_stock_alert' => 15,
            ],
            [
                'name' => 'Kacang Goreng',
                'description' => 'Kacang goreng renyah',
                'sku' => 'SNK003',
                'barcode' => '8992761333003',
                'category_id' => $snackCategory->id,
                'price' => 8000,
                'cost_price' => 5500,
                'stock_quantity' => 35,
                'min_stock_alert' => 10,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
