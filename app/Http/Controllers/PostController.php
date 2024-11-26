<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

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
            'media_url' => 'required|file|image|mimes:jpeg,png,jpg|max:2048', // Validasi file gambar
        ]);

        // Simpan file gambar ke direktori "uploads/posts" di storage
        $filePath = $request->file('media_url')->store('uploads/posts', 'public');

        // Tambahkan path gambar ke kolom media_url
        $validated['media_url'] = $filePath;

        $post = Post::create($validated);

        return response()->json($post, 201);
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        // Validasi hanya untuk caption
        $validated = $request->validate([
            'caption' => 'nullable|string|max:255',
        ]);

        $post->update($validated);

        return response()->json($post, 200);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // Hapus file gambar terkait dari storage
        if ($post->media_url && Storage::exists('public/' . $post->media_url)) {
            Storage::delete('public/' . $post->media_url);
        }

        $post->delete();

        return response()->json(['message' => 'Post deleted'], 200);
    }
}
