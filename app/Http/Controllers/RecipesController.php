<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;
use App\Ingredient;
use App\User;
use Auth;

class RecipesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Recipe $recipe)
    {
        $id = Auth::id();
        
        $recipes = $recipe->select('*')->where('user_id', $id)->get();
    
        return view('recipes.main')->withRecipes($recipes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Ingredient $ingredient)
    {
        $id = Auth::id();
        
        $ingredients = $ingredient->select('name')->where('user_id', $id)->get();
        
        return view('recipes.edit')->withIngredients($ingredients)->withMethod('POST')->withLink('/recipes');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Recipe $recipe, Ingredient $ingredient)
    {
        $id = Auth::id();
        
        $request->validate([
            'name' => 'required|string|min:1|max:255',
            'description' => 'required|string',
            'inredients' => 'array'
        ]);
        
        if ($request->has('ingredients')){
            $result = $recipe->validateIngredients($request->ingredients, $request->ammounts);
        }

        $recipe->create([
            'name' => $request->name,
            'description' => $request->description,
            'ingredients' => $request->has('ingredients') ? $result : '',
            'user_id' => $id
        ]);


        return redirect('/recipes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe)
    {
        $recipe->ingredients = json_decode($recipe->ingredients);

        return view('recipes.show')->withRecipe($recipe);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Recipe $recipe, Ingredient $ingredient)
    {
        $id = Auth::id();

        $ingredients = $ingredient->select('name')->where('user_id', $id)->get();

        $recipe->ingredients = json_decode($recipe->ingredients);
    
        return view('recipes.edit')->withRecipe($recipe)->withIngredients($ingredients)->withMethod('PATCH')->withLink('/recipes/'.$recipe->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Recipe $recipe, Request $request, Ingredient $ingredient)
    {
        $request->validate([
            'name' => 'required|string|min:1|max:255',
            'description' => 'required|string',
            'inredients' => 'array'
        ]);
        
        if ($request->has('ingredients')){
            $result = $recipe->validateIngredients($request->ingredients, $request->ammounts);
        }

        $recipe->update([
            'name' => $request->name,
            'description' => $request->description,
            'ingredients' => $request->has('ingredients') ? $result : ''
        ]);

        return redirect('/recipes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipe $recipe)
    {
        $recipe->delete();
        
        return redirect('/recipes');
    }
}
