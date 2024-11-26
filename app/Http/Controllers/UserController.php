<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        return User::all(); // Mengembalikan semua data user
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        
        // Sertakan URL foto profil di response
        $user->profile_photo_url = $user->profile_photo 
            ? asset('storage/' . $user->profile_photo)
            : asset('images/default-profile.png');
        
        return response()->json($user, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'profile_photo' => 'nullable|file|image|mimes:jpeg,png,jpg|max:2048', // Validasi file foto
        ]);

        // Hash password
        $validated['password'] = bcrypt($validated['password']);

        // Simpan foto profil jika diunggah
        if ($request->hasFile('profile_photo')) {
            $filePath = $request->file('profile_photo')->store('uploads/profile_photos', 'public');
            $validated['profile_photo'] = $filePath;
        }

        $user = User::create($validated);

        return response()->json($user, 201);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'username' => 'nullable|string|max:255|unique:users,username,' . $id,
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
            'profile_photo' => 'nullable|file|image|mimes:jpeg,png,jpg|max:2048', // Validasi file foto
        ]);

        // Hash password jika diperbarui
        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        }

        // Hapus foto lama dan simpan yang baru jika ada
        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo && Storage::exists('public/' . $user->profile_photo)) {
                Storage::delete('public/' . $user->profile_photo);
            }
            $filePath = $request->file('profile_photo')->store('uploads/profile_photos', 'public');
            $validated['profile_photo'] = $filePath;
        }

        $user->update($validated);

        return response()->json($user, 200);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Hapus foto profil jika ada
        if ($user->profile_photo && Storage::exists('public/' . $user->profile_photo)) {
            Storage::delete('public/' . $user->profile_photo);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted'], 200);
    }
}
