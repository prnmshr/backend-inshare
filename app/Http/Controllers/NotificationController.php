<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        return Notification::all(); // Mengembalikan semua data notifikasi
    }

    public function show($id)
    {
        return Notification::findOrFail($id); // Mengembalikan data notifikasi berdasarkan id
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'message' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $notification = Notification::create($validated);
        return response()->json($notification, 201);
    }

    public function update(Request $request, $id)
    {
        $notification = Notification::findOrFail($id);
        $validated = $request->validate([
            'status' => 'required|boolean',
        ]);

        $notification->update($validated);
        return response()->json($notification, 200);
    }

    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();
        return response()->json(['message' => 'Notification deleted'], 200);
    }
}
