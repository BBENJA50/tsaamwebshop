<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CampusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('campuses')->insert([
            ['name' => 'Cardijn'],
            ['name' => 'Aloysius'],
        ]);

        // Now we populate the pivot table with 2 campuses for each year we add both campusses
        foreach (DB::table('academic_years')->get() as $academic_year) {
            DB::table('academic_year_campus_pivot')->insert([
                ['academic_year_id' => $academic_year->id, 'campus_id' => 1],
                ['academic_year_id' => $academic_year->id, 'campus_id' => 2],
            ]);
        }

    }
}
