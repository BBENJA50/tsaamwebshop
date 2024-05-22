<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AcademicYear extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
    ];

    public function campus(): BelongsToMany
    {
        return $this->belongsToMany(Campus::class, 'academic_year_campus_pivot');
    }

    public function studiekeuzes(): HasMany
    {
        return $this->hasMany(Studiekeuze::class);
    }
}
