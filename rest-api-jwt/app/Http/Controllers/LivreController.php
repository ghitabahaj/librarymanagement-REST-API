<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Livre;
use Illuminate\Http\Request;
use App\Http\Requests\StoreLivreRequest;
use App\Http\Requests\UpdateLivreRequest;


class LivreController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $livres = Livre::with('genres')->get();

        return response()->json([
            'status' => 'success',
            'livres' => $livres
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $genres = $request->input('genres', []); // get the genres from the request;
        $livre = new livre();
        $livre->title =$request->title;
        $livre->collection= $request->collection;
        $livre->isbn =$request->isbn;
        $livre->page_numbers =$request->page_numbers;
        $livre->released_date =$request->released_date;
        $livre->emplacement =$request->emplacement;
        $livre->statut =$request->statut;
        $livre->save();
        try {

         $livre->genres()->attach($genres);
    

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => "Failed to attache genres to livre: " . $e->getMessage()
            ], 500);
        }
        return response()->json([
            'status' => true,
            'message' => "Livre created successfully!",
            'Livre' => $livre
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Livre  $livre
     * @return \Illuminate\Http\Response
     */
    public function show(Livre $livre)
    {
        $livre->find($livre->id);

        if (!$livre) {
            return response()->json(['message' => 'Livre not found'], 404);
        }
        return response()->json($livre, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Livre  $livre
     * @return \Illuminate\Http\Response
     */
    public function edit(Livre $livre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Livre  $livre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $livre = Livre::find($id);
        if (!$livre) {
            return response()->json(['message' => 'Livre not found'], 404);
        }
        $genres = $request->input('genres', []);
        try {
            $livre->update($request->all());
            $livre->genres()->sync($genres);
        } catch (\Exception) {
            return response()->json(['message' => 'Failed to update livre'], 405);
        }

        return response()->json([
            'status' => true,
            'message' => "Livre Updated successfully!",
            'Livre' => $livre
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Livre  $livre
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $livre = Livre::find($id);
        $livre->genres()->detach();
        $livre->delete();

        if (!$livre) {
            return response()->json([
                'message' => 'Livre not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Livre deleted successfully'
        ], 200);
    }
    
}

