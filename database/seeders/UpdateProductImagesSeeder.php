<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class UpdateProductImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Updating product images...');
        
        // Get all products
        $products = Product::all();
        
        $progressBar = $this->command->getOutput()->createProgressBar($products->count());
        $progressBar->start();
        
        foreach ($products as $index => $product) {
            // Generate placeholder image path
            // Using a simple pattern: products/placeholder_{category}_{id}.jpg
            $imagePath = "products/placeholder_{$product->category_id}_{$product->id}.jpg";
            
            $product->update([
                'image' => $imagePath
            ]);
            
            $progressBar->advance();
        }
        
        $progressBar->finish();
        $this->command->newLine();
        $this->command->info('Successfully updated ' . $products->count() . ' product images!');
        $this->command->info('Note: Images are placeholder paths. Actual images will be generated on-the-fly.');
    }
}
