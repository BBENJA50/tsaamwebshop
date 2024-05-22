<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function studyFields(): BelongsToMany
    {
        return $this->belongsToMany(StudyField::class, 'study_field_grades');
    }

    public function campus(): BelongsToMany
    {
        return $this->belongsToMany(Campus::class, 'campus_grade_pivot');
    }

    public function academicYears(): BelongsToMany
    {
        return $this->belongsToMany(AcademicYear::class, 'academic_year_grade_pivot');
    }

    public function studiekeuzes(): HasMany
    {
        return $this->hasMany(Studiekeuze::class);
    }
}
