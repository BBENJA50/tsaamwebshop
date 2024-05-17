<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('subjects')->insert([
            ['name' => 'Nederlands'],
            ['name' => 'Engels'],
            ['name' => 'Wiskunde'],
            ['name' => 'Latijn'],
            ['name' => 'Aardrijkskunde'],
            ['name' => 'Geschiendenis'],
            ['name' => 'Godsdienst'],
            ['name' => 'Lichamelijke opvoeding'],
            ['name' => 'Chemie'],
            ['name' => 'Fysica'],
        ]);
    }
}
