<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\TransactionItem;
use App\Models\StockMovement;
use App\Models\Restock;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClearProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Delete all related data first
        TransactionItem::truncate();
        StockMovement::truncate();
        Restock::truncate();
        
        // Delete all products
        Product::truncate();
        
        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $this->command->info('All products and related data have been deleted successfully!');
    }
}
