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
        $data = Komunitas::with(['user', 'category', 'likes', 'komentars'])
            ->where('id', $komunitas->id)
            ->first();
        
        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Data komunitas tidak ditemukan'
            ], 404);
        }

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
        $request->validate([
            'title' => 'required|max:255',
            'komunitas_category_id' => 'required|exists:komunitas_categories,id',
            'body' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public'); // Menyimpan gambar di storage/app/public/images
        }

        $komunitas = Komunitas::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'komunitas_category_id' => $request->komunitas_category_id,
            'body' => $request->body,
            'image' => $imagePath, // Simpan path gambar di database
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Artikel berhasil dibuat',
            'data' => $komunitas
        ], 201);
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
        // Pastikan hanya pemilik yang bisa menghapus
        if ($komunitas->user_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $komunitas->delete();
        return response()->json(['success' => true, 'message' => 'Artikel berhasil dihapus']);
    }
}