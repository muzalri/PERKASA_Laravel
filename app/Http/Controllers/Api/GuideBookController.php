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
        $guideBooks = GuideBook::with('category_id','user_id')->latest()->paginate(10);
        return response()->json([
            'success' => true,
            'data' => $guideBooks
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required|max:255',
                'content' => 'required',
                'category_id' => 'required|exists:komunitas_categories,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'video' => 'nullable|mimes:mp4,mov,ogg,qt|max:20000',
            ]);
    
            $validatedData['user_id'] = auth()->id();
    
            // Pastikan direktori ada
            if (!file_exists(public_path('imagedb/guide_book/images'))) {
                mkdir(public_path('imagedb/guide_book/images'), 0775, true);
            }
            if (!file_exists(public_path('imagedb/guide_book/videos'))) {
                mkdir(public_path('imagedb/guide_book/videos'), 0775, true);
            }
    
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('imagedb/guide_book/images'), $fileName);
                $validatedData['image_path'] = $fileName;
            }
    
            if ($request->hasFile('video')) {
                $file = $request->file('video');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('imagedb/guide_book/videos'), $fileName);
                $validatedData['video_path'] = $fileName;
            }
    
            $guideBook = GuideBook::create($validatedData);
    
            return response()->json([
                'success' => true,
                'message' => 'Guide book berhasil dibuat',
                'data' => $guideBook
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat guide book',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show(GuideBook $guideBook)
    {
        $guideBook = GuideBook::with(['category_id', 'user_id'])
            ->findOrFail($guideBook->id);

        return response()->json([
            'success' => true,
            'data' => $guideBook
        ]);
    }


public function update(Request $request, GuideBook $guideBook)
{
    try {
        if ($guideBook->user_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'kamu bukan author dari guide book ini'
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
            // Hapus gambar lama
            if ($guideBook->image_path) {
                if (file_exists(public_path('imagedb/guide_book/images/' . $guideBook->image_path))) {
                    unlink(public_path('imagedb/guide_book/images/' . $guideBook->image_path));
                }
            }
            
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('imagedb/guide_book/images'), $fileName);
            $validatedData['image_path'] = $fileName;
        }

        if ($request->hasFile('video')) {
            // Hapus video lama
            if ($guideBook->video_path) {
                if (file_exists(public_path('imagedb/guide_book/videos/' . $guideBook->video_path))) {
                    unlink(public_path('imagedb/guide_book/videos/' . $guideBook->video_path));
                }
            }
            
            $file = $request->file('video');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('imagedb/guide_book/videos'), $fileName);
            $validatedData['video_path'] = $fileName;
        }

        $guideBook->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Guide book berhasil diupdate',
            'data' => $guideBook
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Gagal mengupdate guide book',
            'error' => $e->getMessage()
        ], 500);
    }
}



public function destroy(GuideBook $guideBook)
{
    try {
        if ($guideBook->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        // Hapus gambar jika ada
        if ($guideBook->image_path) {
            if (file_exists(public_path('imagedb/guide_book/images/' . $guideBook->image_path))) {
                unlink(public_path('imagedb/guide_book/images/' . $guideBook->image_path));
            }
        }

        // Hapus video jika ada
        if ($guideBook->video_path) {
            if (file_exists(public_path('imagedb/guide_book/videos/' . $guideBook->video_path))) {
                unlink(public_path('imagedb/guide_book/videos/' . $guideBook->video_path));
            }
        }

        $guideBook->delete();

        return response()->json([
            'success' => true,
            'message' => 'Guide book berhasil dihapus'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Gagal menghapus guide book',
            'error' => $e->getMessage()
        ], 500);
    }
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