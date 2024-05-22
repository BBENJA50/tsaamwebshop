<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Campus extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function grades(): BelongsToMany
    {
        return $this->belongsToMany(Grade::class,);
    }

    public function studiekeuzes(): HasMany
    {
        return $this->hasMany(Studiekeuze::class);
    }
}
