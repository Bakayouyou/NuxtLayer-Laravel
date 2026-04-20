<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Create the 12 catalogue products via factory (cycles through fixtures)
        Product::factory(12)->create();
    }
}
