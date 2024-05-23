<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Studiekeuze;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory(300)->create();

        //Now we populate the pivot table with vor each studiekeuze we add a random amount of products
        $studiekeuzes = Studiekeuze::all();

        foreach ($studiekeuzes as $studiekeuze) {
            // Get a random number of products to associate with this studiekeuze
            $products = Product::inRandomOrder()->take(rand(1, 20))->pluck('id');

            // Attach the products to the studiekeuze
            $studiekeuze->products()->attach($products);
        }
    }
}
