<?php

namespace App\Http\Controllers;

use App\Models\GuideBook;
use App\Models\KomunitasCategory;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class GuideBookController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $guideBooks = GuideBook::latest()->get();
        return view('guide-books.index', compact('guideBooks'));
    }

    public function show(GuideBook $guideBook)
    {
        return view('guide_books.show', compact('guideBook'));
    }

    public function create()
    {
        $categories = KomunitasCategory::all();
        dd($categories);
        return view('guide_books.create', compact('categories'));
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

    public function edit(GuideBook $guideBook)
    {
        return view('guide_books.edit', compact('guideBook'));
    }

    public function update(Request $request, GuideBook $guideBook)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:komunitas_categories,id',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'video' => 'mimes:mp4,mov,ogg,qt|max:20000',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('guide_book_images', 'public');
            $validatedData['image_path'] = $imagePath;
        }

        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('guide_book_videos', 'public');
            $validatedData['video_path'] = $videoPath;
        }

        $guideBook->update($validatedData);

        return redirect()->route('guide-books.index')->with('success', 'Guide book berhasil diperbarui.');
    }

    public function destroy(GuideBook $guideBook)
    {
        $guideBook->delete();

        return redirect()->route('guide-books.index')->with('success', 'Guide book berhasil dihapus.');
    }
}
