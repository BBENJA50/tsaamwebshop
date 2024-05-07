<?php

namespace Database\Seeders;

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
            'name' => 'Benjamin Migom',
            'email' => 'migom@hotmail.be',
            'password' => '12345678',
        ]);
        User::factory(50)->create();

        Product::factory(300)->create();

    }
}
