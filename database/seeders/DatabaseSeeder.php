<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeOption;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use function Laravel\Prompts\password;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'first_name' => 'Benjamin',
            'last_name' => 'Migom',
            'email' => 'migom@hotmail.be',
            'gsm_number' => '0471234567',
            'password' => '12345678',
        ]);
        User::factory(50)->create();

        $categories = [
            ['name' => 'Boeken'],
            ['name' => 'Gereedschap'],
            ['name' => 'Turnkledij'],
            ['name' => 'Stagekledij'],
            ['name' => 'Veiligheidskledij'],
            ['name' => 'Werkkledij'],
            ['name' => 'Kluisjes']
        ];
        foreach ($categories as $category) {
            Category::create($category);
        }

        $attributes = [
            ['name' => 'Geen'],
            ['name' => 'Schoenmaten'],
            ['name' => 'Kledingmaten'],
            ['name' => 'broekmaten'],

        ];
        foreach ($attributes as $attribute) {
            Attribute::create($attribute);
        }

        $attribute_options = [];
        for ($i=36; $i<=47; $i++) {
            $schoenmaten=[ 'value' => $i, 'attribute_id' => 2];
            $attribute_options[] = $schoenmaten;
        }
        for ($i=36; $i<=54; $i+=2) {
            $broekmaten=[ 'value' => $i, 'attribute_id' => 4];
            $attribute_options[] = $broekmaten;
        }
        $attribute_options[] = [ 'value' => 'XS', 'attribute_id' => 3];
        $attribute_options[] = [ 'value' => 'S', 'attribute_id' => 3];
        $attribute_options[] = [ 'value' => 'M', 'attribute_id' => 3];
        $attribute_options[] = [ 'value' => 'L', 'attribute_id' => 3];
        $attribute_options[] = [ 'value' => 'XL', 'attribute_id' => 3];
        $attribute_options[] = [ 'value' => 'XXL', 'attribute_id' => 3];
        foreach ($attribute_options as $attribute_option) {
            AttributeOption::create($attribute_option);
        }

        Product::factory(300)->create();
    }
}
