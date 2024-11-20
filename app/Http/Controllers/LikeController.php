<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;

class LikeController extends Controller
{
    public function index()
    {
        return Like::all(); // Mengembalikan semua data likes
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $like = Like::create($validated);
        return response()->json($like, 201);
    }

    public function destroy($id)
    {
        $like = Like::findOrFail($id);
        $like->delete();
        return response()->json(['message' => 'Like deleted'], 200);
    }
}
