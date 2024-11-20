<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        return Post::all(); // Mengembalikan semua data post
    }

    public function show($id)
    {
        return Post::findOrFail($id); // Mengembalikan data post berdasarkan id
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'caption' => 'nullable|string|max:255',
            'media_url' => 'nullable|string',
        ]);

        $post = Post::create($validated);
        return response()->json($post, 201);
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $validated = $request->validate([
            'caption' => 'nullable|string|max:255',
            'media_url' => 'nullable|string',
        ]);

        $post->update($validated);
        return response()->json($post, 200);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return response()->json(['message' => 'Post deleted'], 200);
    }
}
