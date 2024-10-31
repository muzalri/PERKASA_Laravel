<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Komunitas;
use App\Models\KomunitasCategory;
use App\Models\KomunitasLike;
use App\Models\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KomunitasController extends Controller
{
    public function index()
    {
        $komunitas = Komunitas::with(['user', 'category'])->latest()->paginate(10);
        return response()->json([
            'success' => true,
            'data' => $komunitas
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'komunitas_category_id' => 'required|exists:komunitas_categories,id',
            'body' => 'required',
        ]);

        $komunitas = Komunitas::create([
            'user_id' => Auth::id(),
            'komunitas_category_id' => $request->komunitas_category_id,
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Artikel berhasil dibuat',
            'data' => $komunitas
        ], 201);
    }

    public function show(Komunitas $komunitas)
    {
        $komunitas->load(['user', 'category', 'likes']);
        return response()->json([
            'success' => true,
            'data' => $komunitas
        ]);
    }

    public function update(Request $request, Komunitas $komunitas)
    {
        if ($komunitas->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        $request->validate([
            'title' => 'required|max:255',
            'komunitas_category_id' => 'required|exists:komunitas_categories,id',
            'body' => 'required',
        ]);

        $komunitas->update([
            'komunitas_category_id' => $request->komunitas_category_id,
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Artikel berhasil diupdate',
            'data' => $komunitas
        ]);
    }

    public function destroy(Komunitas $komunitas)
    {
        if ($komunitas->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        $komunitas->delete();

        return response()->json([
            'success' => true,
            'message' => 'Artikel berhasil dihapus'
        ]);
    }

    public function toggleLike(Request $request, Komunitas $komunitas)
    {
        $request->validate([
            'is_like' => 'required|boolean',
        ]);

        $like = KomunitasLike::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'komunitas_id' => $komunitas->id,
            ],
            [
                'is_like' => $request->is_like,
            ]
        );

        return response()->json([
            'success' => true,
            'data' => [
                'likes_count' => $komunitas->likesCount(),
                'dislikes_count' => $komunitas->dislikesCount(),
            ]
        ]);
    }

    public function storeKomentar(Request $request, Komunitas $komunitas)
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

    public function destroyKomentar(Komentar $komentar)
    {
        $this->authorize('delete', $komentar);
        
        $komentar->delete();

        return response()->json([
            'success' => true,
            'message' => 'Komentar berhasil dihapus'
        ]);
    }
} 