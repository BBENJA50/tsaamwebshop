<?php

namespace Database\Factories;

use App\Models\AcademicYear;
use App\Models\Campus;
use App\Models\Grade;
use App\Models\StudyField;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Studiekeuze>
 */
class StudiekeuzeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $academicYearIds=AcademicYear::pluck('id')->toArray();
        $campusIds=Campus::pluck('id')->toArray();
        $gradeIds=Grade::pluck('id')->toArray();
        $studyFieldIds=StudyField::pluck('id')->toArray();
        return [
            'name' => fake()->word(),
            'academic_year_id' => fake()->randomElement($academicYearIds),
            'campus_id' => fake()->randomElement($campusIds),
            'grade_id' => fake()->randomElement($gradeIds),
            'study_field_id' => fake()->randomElement($studyFieldIds),
        ];
    }
}
