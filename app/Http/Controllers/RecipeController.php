<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $sortField = $request->input('sortField');
        $sortOrder = $request->input('sortOrder');
        $displayCount = $request->input('displayCount');
        $pageTitle = 'Recipe listing';
        $pageText = '';
        $viewAllLink = '';

        if ($sortField === 'search') {
            $sortLabel = 'search results';
            $pageTitle = 'Search Results';
        } else {
            if ($sortOrder !== 'desc') {
                $sortOrder = 'asc';
                $orderLabel = 'Ascending';
            } else {
                $orderLabel = 'Descending';
            }
            if ($sortField !== 'date_added') {
                $sortField = 'name';
                $sortLabel = 'sorted by recipe name';
            } else {
                $sortLabel = 'sorted by date added';
                $pageTitle = 'Recent recipes';
            }
        }

        if ($displayCount !== 'all') {
            $displayCount = intval($displayCount, 10);
            if ($displayCount < 20) {
                $displayCount = 20;
            }
            if ($sortField === 'search') {
                $recipes = Recipe::search($sortOrder)->paginate($displayCount);
            } else {
                $recipes = Recipe::orderBy($sortField, $sortOrder)->paginate($displayCount);
            }
            if ($recipes->lastPage() > 1) {
                $pageText = ' (page ' . $recipes->currentPage() . ' of ' . $recipes->lastPage() . ')';
                $viewAllLink = $request->path() . '?sortOrder=' . $sortOrder . '&sortField=' . $sortField;
            }
        } else {
            if ($sortField === 'search') {
                $recipes = Recipe::search($sortOrder)->get();
            } else {
                $recipes = Recipe::orderBy($sortField, $sortOrder)->get();
            }
        }

        $titleDetail = $sortLabel . $pageText;
        return view('recipe.index', compact('recipes', 'sortField', 'sortOrder', 'displayCount', 'titleDetail', 'pageTitle', 'viewAllLink'));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): View
    {
        $recipe = Recipe::findOrFail($id);
        return view('recipe.show', compact('recipe'));
    }
}

