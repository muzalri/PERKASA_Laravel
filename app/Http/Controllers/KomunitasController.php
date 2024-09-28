<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Komunitas;
use App\Models\KomunitasCategory;
use App\Models\KomunitasLike;

class KomunitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     return view('komunitas');
    // }


    public function index()
    {
        $komunitas = Komunitas::with(['user', 'category'])->latest()->paginate(10);
        return view('komunitas.index', compact('komunitas'));
    }


    public function articlecreate()
    {
        $categories = Category::all();
        return view('komunitas.create', compact('categories'));
    }

    public function articlestore(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'komunitas_category_id' => 'required|exists:categories,id',
            'body' => 'required',
        ]);

        $komunitas = Komunitas::create([
            'user_id' => Auth::id(),
            'komunitas_category_id' => $request->komunitas_category_id,
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return redirect()->route('komunitas.show', $komunitas)->with('success', 'Artikel berhasil diposting!');


    }

    public function articleshow(Komunitas $komunitas)
    {
        $komunitas->load(['user', 'category', 'likes']);
        return view('articles.show', compact('komunitas'));
    }

    public function articleedit(Komunitas $komunitas)
    {
        // Pastikan hanya pemilik yang bisa mengedit
        if ($komunitas->user_id !== Auth::id()) {
            abort(403);
        }

        $categories = Category::all();
        return view('articles.edit', compact('komunitas', 'categories'));
    }

    public function articleupdate(Request $request, Komunitas $komunitas)
    {
        // Pastikan hanya pemilik yang bisa mengupdate
        if ($komunitas->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|max:255',
            'komunitas_category_id' => 'required|exists:categories,id',
            'body' => 'required',
        ]);

        $komunitas->update([
            'komunitas_category_id' => $request->komunitas_category_id,
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return redirect()->route('komunitas.show', $komunitas)->with('success', 'Artikel berhasil diperbarui!');
    }
    public function articledestroy(Komunitas $komunitas)
    {
        // Pastikan hanya pemilik yang bisa menghapus
        if ($komunitas->user_id !== Auth::id()) {
            abort(403);
        }

        $komunitas->delete();
        return redirect()->route('komunitas.index')->with('success', 'Artikel berhasil dihapus!');
    }




    // Menangani like atau dislike
    public function toggleLike(Request $request, komunitas $komunitas)
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
            'status' => 'success',
            'likes_count' => $komunitas->likesCount(),
            'dislikes_count' => $komunitas->dislikesCount(),
        ]);
    }

}