<?php

namespace App\Http\Controllers;

use App\Models\Cookbook;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CookbookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $pageTitle = 'Cookbook listing';
        $titleDetail = 'A list of all the cookbooks';
        $cookbooks = Cookbook::all();
        return view('cookbook.index', compact('cookbooks', 'titleDetail', 'pageTitle'));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): View
    {
        $cookbook = Cookbook::findOrFail($id);
        return view('cookbook.show', compact('cookbook'));
    }
}

