<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cookbook
 */
class Cookbook extends Model
{

    public $timestamps = true;

    protected $fillable = [
        'name',
        'description',
    ];

    // Removed guarded, getName, setName for Laravel 11 conventions

    public function recipes()
    {
        //return $this->belongsToMany('App\Models\Recipe', 'cookbook_recipes')->orderBy('recipes.classification_id')->orderBy('recipes.name');
        return $this->belongsToMany('App\Models\Recipe', 'cookbook_recipes')->leftJoin('classifications', 'recipes.classification_id', '=', 'classifications.id')->orderBy('classifications.name')->orderBy('recipes.name');
//         $recipeList = $this->belongsToMany('App\Models\Recipe', 'cookbook_recipes')->orderBy('recipes.classification_id')->orderBy('recipes.name');
//         $recipeList->sort(function($a, $b)
//         {
//         $fa = $a->getClassification->name;
//         $fb = $b->getClassification->name;
//         // same classification, then sort on recipe name
//         if ($fa === $fb)
//         {
//             // since name is unique they can't be equal
//             return ($a->name > $b->name) ? 1 : -1;
//         }
//     return ($fa > $fb) ? 1 : -1;
// });
//         return($recipeList);
    }

}