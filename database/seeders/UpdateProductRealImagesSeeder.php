<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class UpdateProductRealImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Updating product images with real food images...');
        
        // Get products with specific keywords for better image matching
        $foodKeywords = [
            'nasi' => 'rice',
            'mie' => 'noodles',
            'ayam' => 'chicken',
            'soto' => 'soup',
            'bakso' => 'meatball',
            'gado' => 'salad',
            'pecel' => 'fish',
            'rendang' => 'beef',
            'sate' => 'satay',
            'uduk' => 'rice',
            'bubur' => 'porridge',
            'kuning' => 'rice',
            'bakar' => 'grilled',
            'ikan' => 'fish',
            'capcay' => 'vegetables',
            'kwetiau' => 'noodles',
            'bihun' => 'noodles',
            'rawon' => 'soup',
            'gulai' => 'curry',
            'sop' => 'soup',
            'liwet' => 'rice',
            'penyet' => 'chicken',
            'tahu' => 'tofu',
            'lontong' => 'rice cake',
            'ketoprak' => 'tofu',
            'campur' => 'mixed',
            'bebek' => 'duck',
            'pepes' => 'fish',
            'kremes' => 'chicken',
            'timbel' => 'rice',
            'betawi' => 'soup',
            'padang' => 'curry',
            'pop' => 'chicken',
            'iga' => 'ribs',
            'seafood' => 'seafood',
            
            // Minuman
            'teh' => 'tea',
            'jeruk' => 'orange juice',
            'jus' => 'juice',
            'alpukat' => 'avocado',
            'mangga' => 'mango',
            'strawberry' => 'strawberry',
            'es campur' => 'dessert',
            'kelapa' => 'coconut',
            'kopi' => 'coffee',
            'cappuccino' => 'cappuccino',
            'latte' => 'latte',
            'americano' => 'americano',
            'tarik' => 'tea',
            'chocolate' => 'chocolate',
            'vanilla' => 'vanilla',
            'smoothie' => 'smoothie',
            'cincau' => 'grass jelly',
            'dawet' => 'dessert',
            'jahe' => 'ginger',
            'bajigur' => 'drink',
            'bandrek' => 'drink',
            'thai tea' => 'thai tea',
            'green tea' => 'green tea',
            'red velvet' => 'red velvet',
            'lemon' => 'lemon',
            'peach' => 'peach',
            'mineral' => 'water',
            'soft drink' => 'soda',
            'energy' => 'energy drink',
            'coconut' => 'coconut',
            
            // Snack
            'keripik' => 'chips',
            'singkong' => 'cassava',
            'pisang' => 'banana',
            'kacang' => 'peanuts',
            'tempe' => 'tempeh',
            'makaroni' => 'macaroni',
            'nastar' => 'cookies',
            'kastengel' => 'cookies',
            'brownies' => 'brownies',
            'bolu' => 'cake',
            'risoles' => 'spring roll',
            'pastel' => 'pastry',
            'lemper' => 'rice cake',
            'onde' => 'sesame ball',
            'klepon' => 'rice cake',
            'lapis' => 'layer cake',
            'martabak' => 'pancake',
            'donat' => 'donut',
            'croissant' => 'croissant',
            'roti' => 'bread',
            'cubit' => 'pancake',
            'pancake' => 'pancake',
            'waffle' => 'waffle',
            'churros' => 'churros',
            'pukis' => 'cake',
            'lumpur' => 'cake',
            'sus' => 'cream puff',
            'eclair' => 'eclair',
            'gulung' => 'roll cake',
            'pie' => 'pie',
        ];
        
        $products = Product::all();
        $progressBar = $this->command->getOutput()->createProgressBar($products->count());
        $progressBar->start();
        
        foreach ($products as $product) {
            // Find keyword in product name
            $searchTerm = 'food'; // default
            $productNameLower = strtolower($product->name);
            
            foreach ($foodKeywords as $indonesian => $english) {
                if (str_contains($productNameLower, $indonesian)) {
                    $searchTerm = $english;
                    break;
                }
            }
            
            try {
                // Use Unsplash API (free, no key needed for basic usage)
                $imageUrl = "https://source.unsplash.com/400x400/?{$searchTerm},food";
                
                // Download image
                $imageContent = Http::timeout(10)->get($imageUrl)->body();
                
                // Save image
                $imageName = 'products/food_' . $product->id . '_' . time() . '.jpg';
                Storage::disk('public')->put($imageName, $imageContent);
                
                // Update product
                $product->update(['image' => $imageName]);
                
            } catch (\Exception $e) {
                // If download fails, skip
                $this->command->warn("Failed to download image for: {$product->name}");
            }
            
            $progressBar->advance();
            usleep(200000); // 0.2 second delay to avoid rate limiting
        }
        
        $progressBar->finish();
        $this->command->newLine();
        $this->command->info('Successfully updated product images!');
    }
}
