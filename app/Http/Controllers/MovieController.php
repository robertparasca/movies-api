<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index() {
        return Movie::all(); // select * from 'movies';
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'rating' => 'required|integer',
            'image' => 'required|max:255'
        ]);

        $movie = new Movie();

        $movie->name = $validated['name'];
        $movie->description = $validated['description'];
        $movie->rating = $validated['rating'];
        $movie->image = $validated['image'];

        $movie->save();

        return response()->json($movie);
    }

    public function destroy(Request $request, $id) {
        $movie = Movie::find($id);
        if (!$movie) {
            return response()->json('No data found', 404);
        }

        Movie::destroy([$id]);

        return response()->json('Success');
    }
}
