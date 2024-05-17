<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('grades')->insert([
            ['name' => '1e jaar'],
            ['name' => '2e jaar'],
            ['name' => '3e jaar'],
            ['name' => '4e jaar'],
            ['name' => '5e jaar'],
            ['name' => '6e jaar'],
            ['name' => '7e jaar'],
        ]);
    }
}
