<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Category::factory(5)->create();
        \App\Models\Product::factory(50)->create();

    }
}