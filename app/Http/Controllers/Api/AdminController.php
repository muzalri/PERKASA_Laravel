<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User; 
use App\Models\KomunitasCategory; // Import model KomunitasCategory
use App\Models\Komunitas; // Import model Komunitas
use App\Models\GuideBook; // Import model GuideBook
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // Fungsi login admin
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Mencari user dengan role admin berdasarkan email
        $admin = User::where('email', $request->email)
                     ->where('role', 'admin')
                     ->first();

        // Memeriksa apakah admin ditemukan
        if ($admin && Hash::check($request->password, $admin->password)) {
            // Buat token
            $token = $admin->createToken('AdminToken')->plainTextToken;

            return response()->json([
                'success' => true,
                'data' => [
                    'admin' => $admin,
                    'token' => $token,
                ],
                'message' => 'Login berhasil!',
            ], 200);
        }

        // Kredensial tidak valid
        return response()->json([
            'success' => false,
            'message' => 'Email atau password tidak valid.',
        ], 401);
    }

    // Fungsi untuk melihat semua kategori komunitas
    public function index()
    {
        $categories = KomunitasCategory::all();
        return response()->json([
            'success' => true,
            'data' => $categories,
        ]);
    }

    // Fungsi untuk membuat kategori komunitas
    public function createCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = KomunitasCategory::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'success' => true,
            'data' => $category,
            'message' => 'Kategori berhasil dibuat!',
        ], 201);
    }

    // Fungsi untuk menghapus kategori komunitas
    public function deleteCategory($id)
    {
        $category = KomunitasCategory::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Kategori tidak ditemukan.',
            ], 404);
        }

        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil dihapus!',
        ]);
    }

    // Fungsi untuk menghapus artikel
    public function deleteArticle(Komunitas $komunitas)
    {
        $komunitas->delete();
        return response()->json(['success' => true, 'message' => 'Artikel berhasil dihapus']);
    }

    public function showArticle(Komunitas $komunitas){

        $komunitas = Komunitas::with(['user', 'category','likes','komentars'])->latest()->paginate(10);
        return response()->json([
            'success' => true,
            'data' => $komunitas
        ]);

    }

    public function indexGuideBooks()
    {
        $guideBooks = GuideBook::latest()->paginate(10);
        return response()->json([
            'success' => true,
            'data' => $guideBooks
        ]);
    }

    public function storeGuideBook(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' =>'required|exists:komunitas_categories,id',
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

    public function showGuideBook(GuideBook $guideBook)
    {
        return response()->json([
            'success' => true,
            'data' => $guideBook
        ]);
    }

    public function updateGuideBook(Request $request, GuideBook $guideBook)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category' => 'required',
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

    public function destroyGuideBook(GuideBook $guideBook)
    {
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
}