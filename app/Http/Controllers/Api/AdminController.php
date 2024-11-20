<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User; 
use App\Models\KomunitasCategory; // Import model KomunitasCategory
use App\Models\Komunitas; // Import model Komunitas
use App\Models\GuideBook; // Import model GuideBook
use App\Models\Komentar; // Import model Komentar
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

    public function showArticle(Komunitas $komunitas)
    {
        $article = Komunitas::with(['user', 'category', 'likes', 'komentars.user'])
                    ->findOrFail($komunitas->id);
        
        return response()->json([
            'success' => true,
            'data' => $article
        ]);
    }

    public function indexGuideBooks()
    {
        $guideBooks = GuideBook::with('category_id','user_id')->latest()->paginate(10);
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


        $validatedData['user_id'] = auth()->id();
        $guideBook = GuideBook::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Guide book berhasil dibuat',
            'data' => $guideBook
        ], 201);
    }

    public function showGuideBook(GuideBook $guideBook)
    {
        $guideBook = GuideBook::with(['category_id', 'user_id'])
            ->findOrFail($guideBook->id);

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
            'category_id' => 'required',
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


        $validatedData['user_id'] = auth()->id();
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

    public function indexArticles()
    {
        $articles = Komunitas::with('category', 'user',)->latest()->paginate(10);
        return response()->json([
            'success' => true,
            'data' => $articles
        ]);
    }

    public function deleteKomentar(Komunitas $komunitas, Komentar $komentar)
    {
        try {
            // Cek apakah komentar ada
            if (!$komentar) {
                return response()->json([
                    'success' => false,
                    'message' => 'Komentar tidak ditemukan'
                ], 404);
            }

            // Hapus komentar
            $komentar->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Komentar berhasil dihapus'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus komentar',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getDashboardStats()
    {
        try {
            $stats = [
                'totalArticles' => Komunitas::count(),
                'totalCategories' => KomunitasCategory::count(),
                'totalGuideBooks' => GuideBook::count()
            ];

            return response()->json([
                'success' => true,
                'data' => $stats
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data statistik',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function verifyToken(Request $request)
    {
        try {
            $user = $request->user();
            
            if (!$user || $user->role !== 'admin') {
                return response()->json([
                    'success' => false,
                    'message' => 'Token tidak valid atau bukan admin'
                ], 401);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'user' => $user
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Token tidak valid'
            ], 401);
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Berhasil logout'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal logout'
            ], 500);
        }
    }

}