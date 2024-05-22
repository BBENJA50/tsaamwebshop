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

        //now we populate the pivot table with 7 grades for the first campus and 6 grades for the second
        foreach (DB::table('grades')->get() as $grade) {
            DB::table('campus_grade_pivot')->insert([
                ['campus_id' => 1, 'grade_id' => $grade->id],
                ['campus_id' => 2, 'grade_id' => $grade->id],
            ]);
        }
        //now remove tha last grade from the second campus
        DB::table('campus_grade_pivot')->where('campus_id', 2)->where('grade_id', 7)->delete();
    }
}
