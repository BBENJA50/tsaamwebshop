<?php

namespace Database\Seeders;

use App\Models\Studiekeuze;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudiekeuzeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Studiekeuze::factory(10)->create();

    }
}
