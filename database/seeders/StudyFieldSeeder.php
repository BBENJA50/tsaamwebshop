<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudyFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('study_fields')->insert([
            ['name' => 'A'],
            ['name' => 'A Latijn'],
            ['name' => 'B'],
            ['name' => 'Latijn - Wiskunde'],
            ['name' => 'Economie - Moderne talen'],
            ['name' => 'Elektrische installatietechnieken'],
            ['name' => 'Houttechnieken'],
            ['name' => 'Bedrijf en organisatie'],
            ['name' => 'Bedrijfswetenschappen'],
            ['name' => 'Biotechnieken'],
            ['name' => 'humane wetenschappen'],
            ['name' => 'Elektromechanische technieken'],
            ['name' => 'Lassen-constructie'],

        ]);


    }
}
