<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GuideBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\KomunitasCategory;

class GuideBookController extends Controller
{
    public function index()
    {
        $guideBooks = GuideBook::latest()->paginate(10);
        return response()->json([
            'success' => true,
            'data' => $guideBooks
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:komunitas_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video' => 'nullable|mimes:mp4,mov,ogg,qt|max:20000',
        ]);

        $validatedData['user_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('guide_book_images', 'public');
            $validatedData['image_path'] = $imagePath;
        }

        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('guide_book_videos', 'public');
            $validatedData['video_path'] = $videoPath;
        }

        $guideBook = GuideBook::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Guide book berhasil dibuat',
            'data' => $guideBook
        ], 201);
    }

    public function show(GuideBook $guideBook)
    {
        return response()->json([
            'success' => true,
            'data' => $guideBook
        ]);
    }

    public function update(Request $request, GuideBook $guideBook)
    {
        if ($guideBook->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:komunitas_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video' => 'nullable|mimes:mp4,mov,ogg,qt|max:20000',
        ]);

        if ($request->hasFile('image')) {
            if ($guideBook->image_path) {
                Storage::disk('public')->delete($guideBook->image_path);
            }
            $imagePath = $request->file('image')->store('guide_book_images', 'public');
            $validatedData['image_path'] = $imagePath;
        }

        if ($request->hasFile('video')) {
            if ($guideBook->video_path) {
                Storage::disk('public')->delete($guideBook->video_path);
            }
            $videoPath = $request->file('video')->store('guide_book_videos', 'public');
            $validatedData['video_path'] = $videoPath;
        }

        $guideBook->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Guide book berhasil diupdate',
            'data' => $guideBook
        ]);
    }

    public function destroy(GuideBook $guideBook)
    {
        if ($guideBook->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        if ($guideBook->image_path) {
            Storage::disk('public')->delete($guideBook->image_path);
        }
        if ($guideBook->video_path) {
            Storage::disk('public')->delete($guideBook->video_path);
        }

        $guideBook->delete();

        return response()->json([
            'success' => true,
            'message' => 'Guide book berhasil dihapus'
        ]);
    }

    public function create()
    {
        $categories = KomunitasCategory::all(); // Ambil semua kategori
        return view('guide_books.create', compact('categories'));
    }

    public function edit(GuideBook $guideBook)
    {
        $categories = KomunitasCategory::all(); // Ambil semua kategori
        return view('guide_books.edit', compact('guideBook', 'categories'));
    }
} 