<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Preparation
 */
class Preparation extends Model
{

    public $timestamps = true;

    protected $fillable = [
        'description',
    ];

    // Removed guarded, getDescription, setDescription for Laravel 11 conventions

}
