<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;

class StoryController extends Controller
{
    public function index()
    {
        return Story::all(); // Mengembalikan semua data story
    }

    public function show($id)
    {
        return Story::findOrFail($id); // Mengembalikan data story berdasarkan id
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'media_url' => 'required|string',
        ]);

        $story = Story::create($validated);
        return response()->json($story, 201);
    }

    public function destroy($id)
    {
        $story = Story::findOrFail($id);
        $story->delete();
        return response()->json(['message' => 'Story deleted'], 200);
    }
}
