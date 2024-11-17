<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Komunitas;
use App\Models\KomunitasCategory;
use App\Models\KomunitasLike;
use App\Models\Komentar;

class KomunitasController extends Controller
{
    // Menampilkan daftar komunitas
    public function index()
    {
        $komunitas = Komunitas::with(['user', 'category','likes','komentars'])->latest()->paginate(10);
        return response()->json([
            'success' => true,
            'data' => $komunitas
        ]);
    }

    // Menampilkan detail komunitas
    public function show(Komunitas $komunitas)
    {
        $data = Komunitas::with(['user', 'category', 'likes', 'komentars.user'])
            ->where('id', $komunitas->id)
            ->first();
        
        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Data komunitas tidak ditemukan'
            ], 404);
        }

        // Transform response untuk menambahkan photo_url pada setiap komentar


        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    // Mengambil semua kategori
    public function getCategories()
    {
        $categories = KomunitasCategory::all();
        return response()->json([
            'success' => true,
            'data' => $categories
        ]);
    }

    // Menyimpan artikel baru
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|max:255',
                'komunitas_category_id' => 'required|exists:komunitas_categories,id',
                'body' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Pastikan direktori ada
            if (!file_exists(public_path('imagedb/komunitas'))) {
                mkdir(public_path('imagedb/komunitas'), 0775, true);
            }

            $imagePath = null;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('imagedb/komunitas'), $fileName);
                $imagePath = $fileName;
            }

            $komunitas = Komunitas::create([
                'user_id' => Auth::id(),
                'title' => $request->title,
                'komunitas_category_id' => $request->komunitas_category_id,
                'body' => $request->body,
                'image' => $imagePath,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Artikel berhasil dibuat',
                'data' => $komunitas
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat artikel',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Menangani like atau dislike
    public function toggleLike(Komunitas $komunitas)
    {
        $user = auth()->user();
        $like = $komunitas->likes()->where('user_id', $user->id)->first();

        if ($like) {
            $like->delete();
            $status = false;
        } else {
            $komunitas->likes()->create([
                'user_id' => $user->id,
                'is_like' => true
            ]);
            $status = true;
        }

        return response()->json([
            'success' => true,
            'message' => $status ? 'Berhasil menyukai postingan' : 'Berhasil membatalkan suka',
            'is_liked' => $status,
            'total_likes' => $komunitas->likes()->where('is_like', true)->count()
        ]);
    }

    // Menyimpan komentar baru
    public function komentarStore(Request $request, Komunitas $komunitas)
    {
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $komentar = $komunitas->komentars()->create([
            'user_id' => Auth::id(),
            'body' => $request->body,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Komentar berhasil ditambahkan',
            'data' => $komentar
        ], 201);
    }

    // Menghapus komentar
    public function destroyKomentar(Komentar $komentar)
    {
        $this->authorize('delete', $komentar);
        $komentar->delete();

        return response()->json([
            'success' => true,
            'message' => 'Komentar berhasil dihapus'
        ]);
    }

    public function destroy(Komunitas $komunitas)
    {
        try {
            if ($komunitas->user_id !== Auth::id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 403);
            }

            // Hapus gambar jika ada
            if ($komunitas->image) {
                if (file_exists(public_path('imagedb/komunitas/' . $komunitas->image))) {
                    unlink(public_path('imagedb/komunitas/' . $komunitas->image));
                }
            }

            $komunitas->delete();

            return response()->json([
                'success' => true,
                'message' => 'Artikel berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus artikel',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}