<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class CatalogController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $catalog = Movie::all();
        return view('catalog.index', ['catalog' => $catalog]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('catalog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'year' => ['required', 'numeric'],
            'director' => ['required', 'string', 'max:255'],
            'poster' => ['required', 'string', 'max:255'],
            'synopsis' => ['required', 'string']
        ]);

        $movie = new Movie();
        $movie->title = $request->get('title');
        $movie->year = $request->get('year');
        $movie->director = $request->get('director');
        $movie->poster = $request->get('poster');
        $movie->rented = false;
        $movie->synopsis = $request->get('synopsis');
        $success = $movie->save() ? 'Movie updated successfully' : 'Movie update failed';

        return redirect()->route('catalog')->with('success', $success);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id = null)
    {
        //
        $movie = Movie::find($id);
        return view('catalog.show', ['id' => $id, 'movie' => $movie] );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id = null)
    {
        //
        $movie = Movie::find($id);
        return view('catalog.edit', ['id' => $id, 'movie' => $movie]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'year' => ['required', 'numeric'],
            'director' => ['required', 'string', 'max:255'],
            'poster' => ['required', 'string', 'max:255'],
            'synopsis' => ['required', 'string']
        ]);

        $movie = Movie::find($id);
        $movie->title = $request->get('title');
        $movie->year = $request->get('year');
        $movie->director = $request->get('director');
        $movie->poster = $request->get('poster');
        $movie->rented = $request->get('rented') ?? $movie->rented;
        $movie->synopsis = $request->get('synopsis');
        $success = $movie->save() ? 'Movie updated successfully' : 'Movie update failed';

        return redirect()->route('catalog')->with('success', $success);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $success = Movie::find($id)->delete() ? 'Movie deleted successfully' : 'Movie delete failed';
        return redirect()->route('catalog')->with('success', $success);
    }

    public function return(Request $request, string $id){
        $movie = Movie::find($id);
        $movie->rented = false;
        $success = $movie->save() ? 'Movie updated successfully' : 'Movie update failed';

        return redirect()->route('catalog')->with('success', $success);
    }

    public function rent(Request $request, string $id){
        $movie = Movie::find($id);
        $movie->rented = true;
        $success = $movie->save() ? 'Movie updated successfully' : 'Movie update failed';

        return redirect()->route('catalog')->with('success', $success);
    }
}
