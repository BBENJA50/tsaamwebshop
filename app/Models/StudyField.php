<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudyField extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'study_field_subjects');
    }

    public function studiekeuzes(): HasMany
    {
        return $this->hasMany(Studiekeuze::class);
    }

}
