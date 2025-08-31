<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Classification
 */
class Classification extends Model
{

    public $timestamps = true;

    protected $fillable = [
        'name',
    ];

    // Removed guarded, getName, setName for Laravel 11 conventions

    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }
}
