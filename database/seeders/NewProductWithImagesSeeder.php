<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class NewProductWithImagesSeeder extends Seeder
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
                'description' => 'Air mineral kemasan botol 600ml, segar dan menyehatkan',
                'sku' => 'MIN001',
                'barcode' => '8992761111001',
                'category_id' => $minumanCategory->id,
                'price' => 3000,
                'cost_price' => 2000,
                'stock_quantity' => 100,
                'min_stock_alert' => 20,
                'image_url' => 'products/air-mineral.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Teh Botol Sosro 450ml',
                'description' => 'Teh botol sosro original, minuman teh khas Indonesia',
                'sku' => 'MIN002',
                'barcode' => '8992761111002',
                'category_id' => $minumanCategory->id,
                'price' => 5000,
                'cost_price' => 3500,
                'stock_quantity' => 80,
                'min_stock_alert' => 15,
                'image_url' => 'products/teh-botol.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Kopi Kaleng ABC',
                'description' => 'Kopi kaleng siap minum rasa original',
                'sku' => 'MIN003',
                'barcode' => '8992761111003',
                'category_id' => $minumanCategory->id,
                'price' => 7000,
                'cost_price' => 5000,
                'stock_quantity' => 60,
                'min_stock_alert' => 12,
                'image_url' => 'products/kopi-kaleng.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Coca Cola 330ml',
                'description' => 'Minuman bersoda Coca Cola kaleng 330ml',
                'sku' => 'MIN004',
                'barcode' => '8992761111004',
                'category_id' => $minumanCategory->id,
                'price' => 8000,
                'cost_price' => 6000,
                'stock_quantity' => 75,
                'min_stock_alert' => 15,
                'image_url' => 'products/coca-cola.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Fanta Orange 330ml',
                'description' => 'Minuman bersoda rasa jeruk kaleng 330ml',
                'sku' => 'MIN005',
                'barcode' => '8992761111005',
                'category_id' => $minumanCategory->id,
                'price' => 8000,
                'cost_price' => 6000,
                'stock_quantity' => 70,
                'min_stock_alert' => 15,
                'image_url' => 'products/fanta.jpg',
                'is_active' => true,
            ],
            
            // Makanan
            [
                'name' => 'Nasi Goreng Spesial',
                'description' => 'Nasi goreng spesial dengan telur, ayam, dan sayuran',
                'sku' => 'MAK001',
                'category_id' => $makananCategory->id,
                'price' => 15000,
                'cost_price' => 8000,
                'stock_quantity' => 30,
                'min_stock_alert' => 5,
                'image_url' => 'products/nasi-goreng.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Mie Goreng Indomie',
                'description' => 'Mie instant goreng Indomie rasa original',
                'sku' => 'MAK002',
                'barcode' => '8992761222001',
                'category_id' => $makananCategory->id,
                'price' => 3500,
                'cost_price' => 2500,
                'stock_quantity' => 150,
                'min_stock_alert' => 30,
                'image_url' => 'products/indomie-goreng.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Mie Kuah Indomie',
                'description' => 'Mie instant kuah Indomie rasa soto',
                'sku' => 'MAK003',
                'barcode' => '8992761222002',
                'category_id' => $makananCategory->id,
                'price' => 3500,
                'cost_price' => 2500,
                'stock_quantity' => 150,
                'min_stock_alert' => 30,
                'image_url' => 'products/indomie-kuah.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Nasi Uduk',
                'description' => 'Nasi uduk dengan lauk lengkap',
                'sku' => 'MAK004',
                'category_id' => $makananCategory->id,
                'price' => 12000,
                'cost_price' => 7000,
                'stock_quantity' => 25,
                'min_stock_alert' => 5,
                'image_url' => 'products/nasi-uduk.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Roti Tawar Sari Roti',
                'description' => 'Roti tawar putih kemasan 10 lembar',
                'sku' => 'MAK005',
                'barcode' => '8992761222003',
                'category_id' => $makananCategory->id,
                'price' => 12000,
                'cost_price' => 9000,
                'stock_quantity' => 40,
                'min_stock_alert' => 10,
                'image_url' => 'products/roti-tawar.jpg',
                'is_active' => true,
            ],
            
            // Snack
            [
                'name' => 'Chitato Rasa Sapi Panggang',
                'description' => 'Keripik kentang Chitato rasa sapi panggang 68g',
                'sku' => 'SNK001',
                'barcode' => '8992761333001',
                'category_id' => $snackCategory->id,
                'price' => 10000,
                'cost_price' => 7000,
                'stock_quantity' => 60,
                'min_stock_alert' => 15,
                'image_url' => 'products/chitato.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Oreo Original',
                'description' => 'Biskuit sandwich coklat Oreo original 137g',
                'sku' => 'SNK002',
                'barcode' => '8992761333002',
                'category_id' => $snackCategory->id,
                'price' => 8000,
                'cost_price' => 6000,
                'stock_quantity' => 80,
                'min_stock_alert' => 20,
                'image_url' => 'products/oreo.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Kacang Garuda',
                'description' => 'Kacang kulit garuda rasa original 200g',
                'sku' => 'SNK003',
                'barcode' => '8992761333003',
                'category_id' => $snackCategory->id,
                'price' => 12000,
                'cost_price' => 8500,
                'stock_quantity' => 50,
                'min_stock_alert' => 12,
                'image_url' => 'products/kacang-garuda.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Taro Net 160g',
                'description' => 'Snack kentang Taro rasa rumput laut 160g',
                'sku' => 'SNK004',
                'barcode' => '8992761333004',
                'category_id' => $snackCategory->id,
                'price' => 15000,
                'cost_price' => 11000,
                'stock_quantity' => 45,
                'min_stock_alert' => 10,
                'image_url' => 'products/taro.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Wafer Tango',
                'description' => 'Wafer coklat Tango 47g',
                'sku' => 'SNK005',
                'barcode' => '8992761333005',
                'category_id' => $snackCategory->id,
                'price' => 3000,
                'cost_price' => 2000,
                'stock_quantity' => 100,
                'min_stock_alert' => 25,
                'image_url' => 'products/wafer-tango.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Permen Kopiko',
                'description' => 'Permen kopi Kopiko isi 24 butir',
                'sku' => 'SNK006',
                'barcode' => '8992761333006',
                'category_id' => $snackCategory->id,
                'price' => 6000,
                'cost_price' => 4000,
                'stock_quantity' => 70,
                'min_stock_alert' => 15,
                'image_url' => 'products/kopiko.jpg',
                'is_active' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
        
        $this->command->info('Products with images have been created successfully!');
    }
}
