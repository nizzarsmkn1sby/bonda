<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CompleteProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan kategori ada
        $minuman = Category::firstOrCreate(['name' => 'Minuman'], ['description' => 'Minuman segar', 'color' => '#3B82F6']);
        $makanan = Category::firstOrCreate(['name' => 'Makanan'], ['description' => 'Makanan berat', 'color' => '#EF4444']);
        $snack = Category::firstOrCreate(['name' => 'Snack'], ['description' => 'Camilan', 'color' => '#F59E0B']);
        $atk = Category::firstOrCreate(['name' => 'Alat Tulis'], ['description' => 'Perlengkapan sekolah/kantor', 'color' => '#10B981']);
        $elektronik = Category::firstOrCreate(['name' => 'Elektronik'], ['description' => 'Aksesoris elektronik', 'color' => '#8B5CF6']);

        $products = [
            // Minuman
            [
                'name' => 'Air Mineral Aqua 600ml',
                'description' => 'Air mineral pegunungan berkualitas',
                'sku' => 'MIN001',
                'price' => 3500,
                'cost_price' => 2500,
                'stock_quantity' => 100,
                'category_id' => $minuman->id,
                'image_url' => 'products/aqua-600.png'
            ],
            [
                'name' => 'Teh Pucuk Harum 350ml',
                'description' => 'Teh manis harum menyegarkan',
                'sku' => 'MIN002',
                'price' => 4000,
                'cost_price' => 3000,
                'stock_quantity' => 80,
                'category_id' => $minuman->id,
                'image_url' => 'products/teh-pucuk.png'
            ],
            [
                'name' => 'Pocari Sweat 500ml',
                'description' => 'Minuman isotonik pengganti ion tubuh',
                'sku' => 'MIN003',
                'price' => 7500,
                'cost_price' => 6000,
                'stock_quantity' => 50,
                'category_id' => $minuman->id,
                'image_url' => 'products/pocari-sweat.png'
            ],
            [
                'name' => 'Kopi Good Day Cappuccino',
                'description' => 'Kopi instan rasa cappuccino',
                'sku' => 'MIN004',
                'price' => 7000,
                'cost_price' => 5500,
                'stock_quantity' => 40,
                'category_id' => $minuman->id,
                'image_url' => 'products/good-day.png'
            ],
            [
                'name' => 'Susu Bear Brand',
                'description' => 'Susu steril murni',
                'sku' => 'MIN005',
                'price' => 11000,
                'cost_price' => 9500,
                'stock_quantity' => 60,
                'category_id' => $minuman->id,
                'image_url' => 'products/bear-brand.png'
            ],

            // Makanan
            [
                'name' => 'Indomie Goreng Original',
                'description' => 'Mie instan goreng paling enak',
                'sku' => 'MAK001',
                'price' => 3500,
                'cost_price' => 2800,
                'stock_quantity' => 200,
                'category_id' => $makanan->id,
                'image_url' => 'products/indomie-goreng.png'
            ],
            [
                'name' => 'Pop Mie Rasa Ayam Bawang',
                'description' => 'Mie cup praktis rasa ayam bawang',
                'sku' => 'MAK002',
                'price' => 5500,
                'cost_price' => 4500,
                'stock_quantity' => 100,
                'category_id' => $makanan->id,
                'image_url' => 'products/pop-mie.png'
            ],
            [
                'name' => 'Sari Roti Tawar Kupas',
                'description' => 'Roti tawar lembut tanpa kulit',
                'sku' => 'MAK003',
                'price' => 16000,
                'cost_price' => 14000,
                'stock_quantity' => 20,
                'category_id' => $makanan->id,
                'image_url' => 'products/sari-roti.png'
            ],
            [
                'name' => 'Sosis So Nice Siap Makan',
                'description' => 'Sosis sapi siap makan toples',
                'sku' => 'MAK004',
                'price' => 1000,
                'cost_price' => 700,
                'stock_quantity' => 150,
                'category_id' => $makanan->id,
                'image_url' => 'products/sosis-so-nice.png'
            ],
            [
                'name' => 'Silverqueen Chunky Bar',
                'description' => 'Coklat batang dengan kacang mede',
                'sku' => 'MAK005',
                'price' => 25000,
                'cost_price' => 21000,
                'stock_quantity' => 30,
                'category_id' => $makanan->id,
                'image_url' => 'products/silverqueen.png'
            ],

            // Snack
            [
                'name' => 'Chitato Rasa Sapi Panggang',
                'description' => 'Keripik kentang rasa sapi panggang',
                'sku' => 'SNK001',
                'price' => 12000,
                'cost_price' => 10000,
                'stock_quantity' => 40,
                'category_id' => $snack->id,
                'image_url' => 'products/chitato.png'
            ],
            [
                'name' => 'Taro Net Seaweed',
                'description' => 'Snack jaring rasa rumput laut',
                'sku' => 'SNK002',
                'price' => 5000,
                'cost_price' => 4000,
                'stock_quantity' => 50,
                'category_id' => $snack->id,
                'image_url' => 'products/taro.png'
            ],
            [
                'name' => 'Oreo Vanilla 137g',
                'description' => 'Biskuit sandwich coklat krim vanilla',
                'sku' => 'SNK003',
                'price' => 9500,
                'cost_price' => 8000,
                'stock_quantity' => 60,
                'category_id' => $snack->id,
                'image_url' => 'products/oreo.png'
            ],
            [
                'name' => 'Beng-Beng Wafer Coklat',
                'description' => 'Wafer karamel krispi berlapis coklat',
                'sku' => 'SNK004',
                'price' => 2500,
                'cost_price' => 2000,
                'stock_quantity' => 100,
                'category_id' => $snack->id,
                'image_url' => 'products/beng-beng.png'
            ],
            [
                'name' => 'Better Sandwich Biscuit',
                'description' => 'Biskuit sandwich lapis coklat',
                'sku' => 'SNK005',
                'price' => 2500,
                'cost_price' => 2000,
                'stock_quantity' => 100,
                'category_id' => $snack->id,
                'image_url' => 'products/better.png'
            ],

            // Alat Tulis
            [
                'name' => 'Buku Tulis Sidu 38 Lembar',
                'description' => 'Buku tulis sekolah standar',
                'sku' => 'ATK001',
                'price' => 4000,
                'cost_price' => 2500,
                'stock_quantity' => 200,
                'category_id' => $atk->id,
                'image_url' => 'products/buku-sidu.png'
            ],
            [
                'name' => 'Pulpen Standard AE7 Hitam',
                'description' => 'Pulpen tinta hitam lancar',
                'sku' => 'ATK002',
                'price' => 2500,
                'cost_price' => 1500,
                'stock_quantity' => 150,
                'category_id' => $atk->id,
                'image_url' => 'products/pulpen-ae7.png'
            ],
            [
                'name' => 'Pensil 2B Faber Castell',
                'description' => 'Pensil ujian standar komputer',
                'sku' => 'ATK003',
                'price' => 5000,
                'cost_price' => 3500,
                'stock_quantity' => 100,
                'category_id' => $atk->id,
                'image_url' => 'products/pensil-2b.png'
            ],
            [
                'name' => 'Penghapus Joyko Kecil',
                'description' => 'Penghapus karet bersih',
                'sku' => 'ATK004',
                'price' => 1500,
                'cost_price' => 800,
                'stock_quantity' => 80,
                'category_id' => $atk->id,
                'image_url' => 'products/penghapus-joyko.png'
            ],
            [
                'name' => 'Tipe-X Kenko Cair',
                'description' => 'Cairan pengoreksi tulisan',
                'sku' => 'ATK005',
                'price' => 5000,
                'cost_price' => 3500,
                'stock_quantity' => 60,
                'category_id' => $atk->id,
                'image_url' => 'products/tipex.png'
            ],

            // Elektronik
            [
                'name' => 'Kabel Data Type-C',
                'description' => 'Kabel data charging fast charging',
                'sku' => 'ELK001',
                'price' => 25000,
                'cost_price' => 15000,
                'stock_quantity' => 30,
                'category_id' => $elektronik->id,
                'image_url' => 'products/kabel-typec.png'
            ],
            [
                'name' => 'Earphone Robot',
                'description' => 'Earphone bass jernih',
                'sku' => 'ELK002',
                'price' => 35000,
                'cost_price' => 25000,
                'stock_quantity' => 20,
                'category_id' => $elektronik->id,
                'image_url' => 'products/earphone.png'
            ],
            [
                'name' => 'Mouse Wireless Logitech',
                'description' => 'Mouse tanpa kabel awet',
                'sku' => 'ELK003',
                'price' => 150000,
                'cost_price' => 120000,
                'stock_quantity' => 10,
                'category_id' => $elektronik->id,
                'image_url' => 'products/mouse.png'
            ],
            [
                'name' => 'Flashdisk Sandisk 32GB',
                'description' => 'Penyimpanan data portable',
                'sku' => 'ELK004',
                'price' => 65000,
                'cost_price' => 50000,
                'stock_quantity' => 25,
                'category_id' => $elektronik->id,
                'image_url' => 'products/flashdisk.png'
            ],
            [
                'name' => 'Baterai ABC Alkaline AA',
                'description' => 'Baterai tahan lama isi 2',
                'sku' => 'ELK005',
                'price' => 15000,
                'cost_price' => 11000,
                'stock_quantity' => 50,
                'category_id' => $elektronik->id,
                'image_url' => 'products/baterai.png'
            ],
        ];

        foreach ($products as $product) {
            Product::create(array_merge($product, [
                'min_stock_alert' => 10,
                'is_active' => true
            ]));
        }
    }
}
