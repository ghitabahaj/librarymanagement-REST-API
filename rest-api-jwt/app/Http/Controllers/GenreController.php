<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $genres=Genre::all();
        return response()->json($genres);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $genre=new Genre;
        $genre->name=$request->input('name');
        $genre->save();
        return response()->json($genre);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $genre= Genre::find($id);
        return response()->json($genre);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $genre = Genre::find($id);
        $genre->name= $request->input('name');
        $genre->save();
        return response()->json($genre);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $genre =  Genre::find($id);
        $genre->delete();
        return response()->json(['message','Genre Deleted']);
    }
}