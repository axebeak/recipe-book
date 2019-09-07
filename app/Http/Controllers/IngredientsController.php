<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;
use App\Ingredient;
use App\User;
use Auth;

class IngredientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Ingredient $ingredient)
    {
        $id = Auth::id();
        
        $ingredients = $ingredient->select('*')->where('user_id', $id)->get();
    
        return view('ingredients.main')->withIngredients($ingredients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('ingredients.edit')->withMethod('POST')->withLink('/ingredients');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Ingredient $ingredient, Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:1|max:255|unique:ingredients'
        ]);
        
        $ingredient->create([
            'name' => $request->name,
            'user_id' => Auth::id()
        ]);
        
        return redirect('/ingredients');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return redirect('/ingredients');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Ingredient $ingredient)
    {
        
        return view('ingredients.edit')->withMethod('PATCH')->withLink('/ingredients/'.$ingredient->id)->withIngredient($ingredient);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ingredient $ingredient)
    {

        $request->validate([
            'name' => 'required|string|min:1|max:255'    
        ]);
        $ingredient->where('id', $ingredient->id)->where('user_id', Auth::id())->update(['name' => $request->name]);
        
        return redirect('/ingredients');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Ingredient::where('id', $id)->delete();
        
        return redirect('/ingredients');
    }
}
