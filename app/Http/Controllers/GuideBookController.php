<?php

namespace App\Http\Controllers;

use App\Models\GuideBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GuideBookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('pakar')->except(['index', 'show']);
    }

    public function index()
    {
        $guideBooks = GuideBook::all();
        return view('guide_books.index', compact('guideBooks'));
    }

    public function show($id)
    {
        $guideBook = GuideBook::findOrFail($id);
        return view('guide_books.show', compact('guideBook'));
    }

    public function create()
    {
        return view('guide_books.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'video' => 'mimetypes:video/mp4|max:20000',
        ]);

        $guideBook = new GuideBook($validatedData);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('guide_book_images', 'public');
            $guideBook->image_path = $imagePath;
        }

        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('guide_book_videos', 'public');
            $guideBook->video_path = $videoPath;
        }

        $guideBook->save();

        return redirect()->route('guide-books.index')->with('success', 'Panduan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $guideBook = GuideBook::findOrFail($id);
        return view('guide_books.edit', compact('guideBook'));
    }

    public function update(Request $request, $id)
    {
        $guideBook = GuideBook::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'video' => 'mimetypes:video/mp4|max:20000',
        ]);

        $guideBook->fill($validatedData);

        if ($request->hasFile('image')) {
            if ($guideBook->image_path) {
                Storage::disk('public')->delete($guideBook->image_path);
            }
            $imagePath = $request->file('image')->store('guide_book_images', 'public');
            $guideBook->image_path = $imagePath;
        }

        if ($request->hasFile('video')) {
            if ($guideBook->video_path) {
                Storage::disk('public')->delete($guideBook->video_path);
            }
            $videoPath = $request->file('video')->store('guide_book_videos', 'public');
            $guideBook->video_path = $videoPath;
        }

        $guideBook->save();

        return redirect()->route('guide-books.show', $guideBook->id)->with('success', 'Panduan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $guideBook = GuideBook::findOrFail($id);

        if ($guideBook->image_path) {
            Storage::disk('public')->delete($guideBook->image_path);
        }

        if ($guideBook->video_path) {
            Storage::disk('public')->delete($guideBook->video_path);
        }

        $guideBook->delete();

        return redirect()->route('guide-books.index')->with('success', 'Panduan berhasil dihapus.');
    }
}
