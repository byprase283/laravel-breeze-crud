<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Electronics', 'Books', 'Clothing', 'Home & Kitchen', 'Sports & Outdoors'];
        foreach ($categories as $category) {
            \App\Models\Product::factory()->create([
                'name' => $category . ' Product',
                'description' => 'This is a description for ' . $category . ' product.',
                'price' => 500000,
                'stock' => 10,
            ]);
        }
    }
}
