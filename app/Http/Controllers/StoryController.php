<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;
use Illuminate\Support\Facades\Storage;

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
            'media_url' => 'required|file|image|mimes:jpeg,png,jpg|max:2048', // Validasi file gambar
        ]);

        // Simpan file gambar ke direktori "uploads/stories" di storage
        $filePath = $request->file('media_url')->store('uploads/stories', 'public');

        // Tambahkan path gambar ke kolom media_url
        $validated['media_url'] = $filePath;

        $story = Story::create($validated);

        return response()->json($story, 201);
    }

    public function destroy($id)
    {
        $story = Story::findOrFail($id);

        // Hapus file gambar terkait dari storage
        if ($story->media_url && Storage::exists('public/' . $story->media_url)) {
            Storage::delete('public/' . $story->media_url);
        }

        $story->delete();

        return response()->json(['message' => 'Story deleted'], 200);
    }
}
