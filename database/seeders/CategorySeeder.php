<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Minuman', 'description' => 'Berbagai jenis minuman', 'color' => '#3B82F6'],
            ['name' => 'Makanan', 'description' => 'Makanan ringan dan berat', 'color' => '#EF4444'],
            ['name' => 'Snack', 'description' => 'Camilan dan snack', 'color' => '#F59E0B'],
            ['name' => 'Alat Tulis', 'description' => 'Perlengkapan alat tulis', 'color' => '#10B981'],
            ['name' => 'Elektronik', 'description' => 'Barang elektronik kecil', 'color' => '#8B5CF6'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
