<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        Category::create([
            'name' => 'Tree',
        ]);
        Category::create([
            'name' => 'Flowers',
        ]);
        Category::create([
            'name' => 'Mushrooms',
        ]);
        Category::create([
            'name' => 'Vegetable plants',
        ]);
        Category::create([
            'name' => 'House plants',
        ]);
        Category::create([
            'name' => 'bushes',
        ]);
    }
}
