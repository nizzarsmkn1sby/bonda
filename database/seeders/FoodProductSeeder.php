<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class FoodProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create food categories
        $makanan = Category::firstOrCreate(['name' => 'Makanan'], ['description' => 'Berbagai jenis makanan']);
        $minuman = Category::firstOrCreate(['name' => 'Minuman'], ['description' => 'Berbagai jenis minuman']);
        $snack = Category::firstOrCreate(['name' => 'Snack'], ['description' => 'Camilan dan snack']);

        // Food products data
        $foodProducts = [
            // Makanan (40 items)
            ['name' => 'Nasi Goreng Spesial', 'category' => $makanan, 'price' => 25000, 'stock' => 50],
            ['name' => 'Mie Goreng Jawa', 'category' => $makanan, 'price' => 20000, 'stock' => 45],
            ['name' => 'Ayam Geprek Sambal Matah', 'category' => $makanan, 'price' => 28000, 'stock' => 40],
            ['name' => 'Soto Ayam Lamongan', 'category' => $makanan, 'price' => 22000, 'stock' => 35],
            ['name' => 'Bakso Urat Jumbo', 'category' => $makanan, 'price' => 23000, 'stock' => 38],
            ['name' => 'Gado-Gado Jakarta', 'category' => $makanan, 'price' => 18000, 'stock' => 42],
            ['name' => 'Pecel Lele Lalapan', 'category' => $makanan, 'price' => 19000, 'stock' => 44],
            ['name' => 'Rendang Daging Sapi', 'category' => $makanan, 'price' => 35000, 'stock' => 30],
            ['name' => 'Sate Ayam Madura', 'category' => $makanan, 'price' => 27000, 'stock' => 36],
            ['name' => 'Nasi Uduk Betawi', 'category' => $makanan, 'price' => 21000, 'stock' => 48],
            ['name' => 'Bubur Ayam Spesial', 'category' => $makanan, 'price' => 15000, 'stock' => 50],
            ['name' => 'Nasi Kuning Komplit', 'category' => $makanan, 'price' => 24000, 'stock' => 40],
            ['name' => 'Ayam Bakar Taliwang', 'category' => $makanan, 'price' => 32000, 'stock' => 28],
            ['name' => 'Ikan Bakar Kecap', 'category' => $makanan, 'price' => 30000, 'stock' => 32],
            ['name' => 'Capcay Seafood', 'category' => $makanan, 'price' => 26000, 'stock' => 35],
            ['name' => 'Kwetiau Goreng', 'category' => $makanan, 'price' => 22000, 'stock' => 40],
            ['name' => 'Bihun Goreng Spesial', 'category' => $makanan, 'price' => 20000, 'stock' => 42],
            ['name' => 'Nasi Rawon Surabaya', 'category' => $makanan, 'price' => 28000, 'stock' => 33],
            ['name' => 'Gulai Kambing', 'category' => $makanan, 'price' => 38000, 'stock' => 25],
            ['name' => 'Sop Buntut', 'category' => $makanan, 'price' => 42000, 'stock' => 22],
            ['name' => 'Nasi Liwet Solo', 'category' => $makanan, 'price' => 23000, 'stock' => 38],
            ['name' => 'Ayam Penyet Sambal Ijo', 'category' => $makanan, 'price' => 26000, 'stock' => 36],
            ['name' => 'Mie Ayam Bakso', 'category' => $makanan, 'price' => 18000, 'stock' => 45],
            ['name' => 'Nasi Pecel Madiun', 'category' => $makanan, 'price' => 17000, 'stock' => 46],
            ['name' => 'Tahu Telor Surabaya', 'category' => $makanan, 'price' => 16000, 'stock' => 48],
            ['name' => 'Lontong Sayur Padang', 'category' => $makanan, 'price' => 19000, 'stock' => 44],
            ['name' => 'Ketoprak Jakarta', 'category' => $makanan, 'price' => 17000, 'stock' => 47],
            ['name' => 'Nasi Campur Bali', 'category' => $makanan, 'price' => 29000, 'stock' => 34],
            ['name' => 'Bebek Goreng Madura', 'category' => $makanan, 'price' => 33000, 'stock' => 28],
            ['name' => 'Ikan Pepes Mas', 'category' => $makanan, 'price' => 27000, 'stock' => 31],
            ['name' => 'Ayam Kremes Jogja', 'category' => $makanan, 'price' => 25000, 'stock' => 37],
            ['name' => 'Nasi Timbel Komplit', 'category' => $makanan, 'price' => 26000, 'stock' => 35],
            ['name' => 'Soto Betawi', 'category' => $makanan, 'price' => 24000, 'stock' => 38],
            ['name' => 'Rawon Daging Sapi', 'category' => $makanan, 'price' => 27000, 'stock' => 33],
            ['name' => 'Nasi Padang Rendang', 'category' => $makanan, 'price' => 32000, 'stock' => 29],
            ['name' => 'Ayam Pop Padang', 'category' => $makanan, 'price' => 28000, 'stock' => 32],
            ['name' => 'Iga Bakar Madu', 'category' => $makanan, 'price' => 45000, 'stock' => 20],
            ['name' => 'Sate Padang', 'category' => $makanan, 'price' => 26000, 'stock' => 34],
            ['name' => 'Nasi Goreng Seafood', 'category' => $makanan, 'price' => 30000, 'stock' => 30],
            ['name' => 'Mie Goreng Seafood', 'category' => $makanan, 'price' => 28000, 'stock' => 32],

            // Minuman (30 items)
            ['name' => 'Es Teh Manis', 'category' => $minuman, 'price' => 5000, 'stock' => 100],
            ['name' => 'Es Jeruk Segar', 'category' => $minuman, 'price' => 8000, 'stock' => 90],
            ['name' => 'Jus Alpukat', 'category' => $minuman, 'price' => 12000, 'stock' => 70],
            ['name' => 'Jus Mangga', 'category' => $minuman, 'price' => 12000, 'stock' => 68],
            ['name' => 'Jus Strawberry', 'category' => $minuman, 'price' => 13000, 'stock' => 65],
            ['name' => 'Es Campur Spesial', 'category' => $minuman, 'price' => 15000, 'stock' => 60],
            ['name' => 'Es Kelapa Muda', 'category' => $minuman, 'price' => 10000, 'stock' => 75],
            ['name' => 'Kopi Susu Gula Aren', 'category' => $minuman, 'price' => 14000, 'stock' => 80],
            ['name' => 'Cappuccino', 'category' => $minuman, 'price' => 18000, 'stock' => 55],
            ['name' => 'Latte', 'category' => $minuman, 'price' => 18000, 'stock' => 55],
            ['name' => 'Americano', 'category' => $minuman, 'price' => 15000, 'stock' => 60],
            ['name' => 'Teh Tarik', 'category' => $minuman, 'price' => 10000, 'stock' => 75],
            ['name' => 'Chocolate Ice Blend', 'category' => $minuman, 'price' => 16000, 'stock' => 58],
            ['name' => 'Vanilla Milkshake', 'category' => $minuman, 'price' => 17000, 'stock' => 52],
            ['name' => 'Strawberry Smoothie', 'category' => $minuman, 'price' => 18000, 'stock' => 50],
            ['name' => 'Mango Smoothie', 'category' => $minuman, 'price' => 18000, 'stock' => 50],
            ['name' => 'Es Cincau Hijau', 'category' => $minuman, 'price' => 8000, 'stock' => 85],
            ['name' => 'Es Dawet Ayu', 'category' => $minuman, 'price' => 9000, 'stock' => 80],
            ['name' => 'Wedang Jahe', 'category' => $minuman, 'price' => 7000, 'stock' => 70],
            ['name' => 'Bajigur', 'category' => $minuman, 'price' => 10000, 'stock' => 65],
            ['name' => 'Bandrek', 'category' => $minuman, 'price' => 10000, 'stock' => 65],
            ['name' => 'Thai Tea', 'category' => $minuman, 'price' => 12000, 'stock' => 72],
            ['name' => 'Green Tea Latte', 'category' => $minuman, 'price' => 16000, 'stock' => 58],
            ['name' => 'Red Velvet Latte', 'category' => $minuman, 'price' => 17000, 'stock' => 54],
            ['name' => 'Lemon Tea', 'category' => $minuman, 'price' => 9000, 'stock' => 78],
            ['name' => 'Peach Tea', 'category' => $minuman, 'price' => 10000, 'stock' => 75],
            ['name' => 'Mineral Water', 'category' => $minuman, 'price' => 3000, 'stock' => 150],
            ['name' => 'Soft Drink', 'category' => $minuman, 'price' => 8000, 'stock' => 100],
            ['name' => 'Energy Drink', 'category' => $minuman, 'price' => 12000, 'stock' => 70],
            ['name' => 'Coconut Water', 'category' => $minuman, 'price' => 11000, 'stock' => 68],

            // Snack (30 items)
            ['name' => 'Keripik Singkong Pedas', 'category' => $snack, 'price' => 10000, 'stock' => 80],
            ['name' => 'Keripik Pisang Coklat', 'category' => $snack, 'price' => 12000, 'stock' => 75],
            ['name' => 'Kacang Atom Pedas', 'category' => $snack, 'price' => 8000, 'stock' => 90],
            ['name' => 'Keripik Tempe Original', 'category' => $snack, 'price' => 9000, 'stock' => 85],
            ['name' => 'Makaroni Pedas', 'category' => $snack, 'price' => 7000, 'stock' => 95],
            ['name' => 'Kue Kering Nastar', 'category' => $snack, 'price' => 35000, 'stock' => 40],
            ['name' => 'Kue Kering Kastengel', 'category' => $snack, 'price' => 38000, 'stock' => 38],
            ['name' => 'Brownies Coklat', 'category' => $snack, 'price' => 25000, 'stock' => 50],
            ['name' => 'Bolu Kukus Pandan', 'category' => $snack, 'price' => 20000, 'stock' => 55],
            ['name' => 'Risoles Mayo', 'category' => $snack, 'price' => 15000, 'stock' => 60],
            ['name' => 'Pastel Ayam', 'category' => $snack, 'price' => 12000, 'stock' => 65],
            ['name' => 'Lemper Ayam', 'category' => $snack, 'price' => 10000, 'stock' => 70],
            ['name' => 'Onde-Onde Kacang Hijau', 'category' => $snack, 'price' => 8000, 'stock' => 75],
            ['name' => 'Klepon', 'category' => $snack, 'price' => 8000, 'stock' => 75],
            ['name' => 'Kue Lapis Legit', 'category' => $snack, 'price' => 45000, 'stock' => 30],
            ['name' => 'Martabak Mini Coklat Keju', 'category' => $snack, 'price' => 18000, 'stock' => 55],
            ['name' => 'Donat Gula Halus', 'category' => $snack, 'price' => 5000, 'stock' => 100],
            ['name' => 'Donat Coklat Meses', 'category' => $snack, 'price' => 6000, 'stock' => 95],
            ['name' => 'Croissant Butter', 'category' => $snack, 'price' => 15000, 'stock' => 45],
            ['name' => 'Roti Boy', 'category' => $snack, 'price' => 12000, 'stock' => 60],
            ['name' => 'Kue Cubit Rainbow', 'category' => $snack, 'price' => 10000, 'stock' => 70],
            ['name' => 'Pancake Madu', 'category' => $snack, 'price' => 14000, 'stock' => 58],
            ['name' => 'Waffle Coklat', 'category' => $snack, 'price' => 16000, 'stock' => 52],
            ['name' => 'Churros Gula Kayu Manis', 'category' => $snack, 'price' => 18000, 'stock' => 48],
            ['name' => 'Pukis Coklat Keju', 'category' => $snack, 'price' => 8000, 'stock' => 80],
            ['name' => 'Kue Lumpur Kentang', 'category' => $snack, 'price' => 7000, 'stock' => 85],
            ['name' => 'Sus Kering Vla', 'category' => $snack, 'price' => 20000, 'stock' => 50],
            ['name' => 'Eclair Coklat', 'category' => $snack, 'price' => 22000, 'stock' => 45],
            ['name' => 'Kue Bolu Gulung', 'category' => $snack, 'price' => 25000, 'stock' => 42],
            ['name' => 'Pie Susu Bali', 'category' => $snack, 'price' => 15000, 'stock' => 60],
        ];

        $this->command->info('Starting to create 100 food products...');
        $progressBar = $this->command->getOutput()->createProgressBar(count($foodProducts));
        $progressBar->start();

        foreach ($foodProducts as $index => $productData) {
            // Generate random image from picsum.photos (food category)
            $imageUrl = "https://picsum.photos/seed/food{$index}/400/400";
            
            try {
                // Download image
                $imageContent = Http::timeout(10)->get($imageUrl)->body();
                
                // Save image to storage
                $imageName = 'products/food_' . time() . '_' . $index . '.jpg';
                Storage::disk('public')->put($imageName, $imageContent);
                
                // Create product
                Product::create([
                    'name' => $productData['name'],
                    'description' => 'Produk ' . $productData['name'] . ' berkualitas tinggi dengan cita rasa yang lezat dan menggugah selera.',
                    'category_id' => $productData['category']->id,
                    'price' => $productData['price'],
                    'stock_quantity' => $productData['stock'],
                    'min_stock_alert' => 10,
                    'image' => $imageName,
                ]);
                
            } catch (\Exception $e) {
                // If image download fails, create product without image
                Product::create([
                    'name' => $productData['name'],
                    'description' => 'Produk ' . $productData['name'] . ' berkualitas tinggi dengan cita rasa yang lezat dan menggugah selera.',
                    'category_id' => $productData['category']->id,
                    'price' => $productData['price'],
                    'stock_quantity' => $productData['stock'],
                    'min_stock_alert' => 10,
                ]);
            }
            
            $progressBar->advance();
            
            // Small delay to avoid rate limiting
            usleep(100000); // 0.1 second
        }

        $progressBar->finish();
        $this->command->newLine();
        $this->command->info('Successfully created 100 food products!');
    }
}
