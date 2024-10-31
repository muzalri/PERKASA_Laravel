<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048' // max 2MB
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('chat-images', 'public');
            
            // Simpan ke database
            $message = new ChatMessage();
            $message->image = $path;
            // ... set other fields ...
            $message->save();
            
            return response()->json(['success' => true, 'path' => $path]);
        }
        
        return response()->json(['success' => false]);
    }
} 