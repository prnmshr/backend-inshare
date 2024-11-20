<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index()
    {
        return Comment::all(); // Mengembalikan semua data komentar
    }

    public function show($id)
    {
        return Comment::findOrFail($id); // Mengembalikan data komentar berdasarkan id
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'user_id' => 'required|exists:users,id',
            'comment' => 'required|string|max:255',
        ]);

        $comment = Comment::create($validated);
        return response()->json($comment, 201);
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $validated = $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        $comment->update($validated);
        return response()->json($comment, 200);
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return response()->json(['message' => 'Comment deleted'], 200);
    }
}
