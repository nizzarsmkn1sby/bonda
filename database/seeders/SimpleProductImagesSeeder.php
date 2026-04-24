<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class SimpleProductImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Updating product images...');
        
        // Mapping kategori ke gambar
        $categoryImages = [
            'Makanan' => [
                'https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=400&h=400&fit=crop', // Nasi
                'https://images.unsplash.com/photo-1585032226651-759b368d7246?w=400&h=400&fit=crop', // Ayam
                'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?w=400&h=400&fit=crop', // Mie
                'https://images.unsplash.com/photo-1547592166-23ac45744acd?w=400&h=400&fit=crop', // Soto
                'https://images.unsplash.com/photo-1604908176997-125f25cc6f3d?w=400&h=400&fit=crop', // Bakso
            ],
            'Minuman' => [
                'https://images.unsplash.com/photo-1544145945-f90425340c7e?w=400&h=400&fit=crop', // Kopi
                'https://images.unsplash.com/photo-1556679343-c7306c1976bc?w=400&h=400&fit=crop', // Jus
                'https://images.unsplash.com/photo-1556679343-c7306c1976bc?w=400&h=400&fit=crop', // Teh
                'https://images.unsplash.com/photo-1570831739435-6601aa3fa4fb?w=400&h=400&fit=crop', // Smoothie
            ],
            'Snack' => [
                'https://images.unsplash.com/photo-1599785209796-786432b228bc?w=400&h=400&fit=crop', // Keripik
                'https://images.unsplash.com/photo-1558961363-fa8fdf82db35?w=400&h=400&fit=crop', // Kue
                'https://images.unsplash.com/photo-1486427944299-d1955d23e34d?w=400&h=400&fit=crop', // Donat
                'https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=400&h=400&fit=crop', // Brownies
            ],
        ];
        
        $products = Product::with('category')->get();
        $progressBar = $this->command->getOutput()->createProgressBar($products->count());
        $progressBar->start();
        
        foreach ($products as $index => $product) {
            $categoryName = $product->category->name ?? 'Makanan';
            $images = $categoryImages[$categoryName] ?? $categoryImages['Makanan'];
            
            // Pilih gambar berdasarkan index produk
            $imageIndex = $index % count($images);
            $imageUrl = $images[$imageIndex];
            
            try {
                // Download image
                $imageContent = Http::timeout(15)->get($imageUrl)->body();
                
                // Save image
                $imageName = 'products/product_' . $product->id . '.jpg';
                Storage::disk('public')->put($imageName, $imageContent);
                
                // Update product
                $product->update(['image' => $imageName]);
                
            } catch (\Exception $e) {
                // If download fails, use placeholder path
                $product->update(['image' => null]);
            }
            
            $progressBar->advance();
            usleep(100000); // 0.1 second delay
        }
        
        $progressBar->finish();
        $this->command->newLine();
        $this->command->info('Successfully updated product images!');
    }
}
