<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\KomunitasCategory;
use App\Models\Komunitas;
use App\Models\GuideBook;
use App\Models\Komentar;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // Fungsi untuk melihat semua kategori komunitas
    public function indexCategories()
    {
        $categories = KomunitasCategory::all();
        return view('admin.categories.index', compact('categories'));
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

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dibuat!');
    }

    // Fungsi untuk menghapus kategori komunitas
    public function deleteCategory($id)
    {
        $category = KomunitasCategory::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus!');
    }

    // Fungsi untuk menampilkan daftar artikel
    public function indexArticles()
    {
        $articles = Komunitas::with('category', 'user')->latest()->paginate(10);
        return view('admin.articles.index', compact('articles'));
    }

    // Fungsi untuk menampilkan detail artikel
    public function showArticle(Komunitas $komunitas)
    {
        $article = Komunitas::with(['user', 'category', 'likes', 'komentars.user'])
                    ->findOrFail($komunitas->id);
        return view('admin.articles.show', compact('article'));
    }

    // Fungsi untuk menghapus artikel
    public function deleteArticle(Komunitas $komunitas)
    {
        $komunitas->delete();
        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dihapus!');
    }

    // Fungsi untuk menghapus komentar
    public function deleteKomentar(Komunitas $komunitas, Komentar $komentar)
    {
        if ($komentar->komunitas_id !== $komunitas->id) {
            return redirect()->back()->with('error', 'Komentar tidak ditemukan di artikel ini');
        }

        try {
            $komentar->delete();
            return redirect()->back()->with('success', 'Komentar berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus komentar');
        }
    }

    // Fungsi untuk menampilkan daftar guide books
    public function indexGuideBooks()
    {
        $guideBooks = GuideBook::with([
            'category_id:id,name', 
            'user_id:id,name'
        ])->latest()->paginate(10);
        
        return view('admin.guide-books.index', compact('guideBooks'));
    }

    // Fungsi untuk menampilkan detail guide book
    public function showGuideBook(GuideBook $guideBook)
    {
        $guideBook = GuideBook::with(['category_id:id,name', 'user_id:id,name'])
            ->findOrFail($guideBook->id);
        return view('admin.guide-books.show', compact('guideBook'));
    }

    // Fungsi untuk menyimpan guide book baru
    public function storeGuideBook(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:komunitas_categories,id',
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
        GuideBook::create($validatedData);

        return redirect()->route('admin.guide-books.index')->with('success', 'Guide book berhasil dibuat!');
    }

    // Fungsi untuk mengupdate guide book
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

        return redirect()->route('admin.guide-books.show', $guideBook)->with('success', 'Guide book berhasil diupdate!');
    }

    // Fungsi untuk menghapus guide book
    public function destroyGuideBook(GuideBook $guideBook)
    {
        if ($guideBook->image_path) {
            if (file_exists(public_path('imagedb/guide_book/images/' . $guideBook->image_path))) {
                unlink(public_path('imagedb/guide_book/images/' . $guideBook->image_path));
            }
        }
        if ($guideBook->video_path) {
            if (file_exists(public_path('imagedb/guide_book/videos/' . $guideBook->video_path))) {
                unlink(public_path('imagedb/guide_book/videos/' . $guideBook->video_path));
            }
        }

        $guideBook->delete();
        return redirect()->route('admin.guide-books.index')->with('success', 'Guide book berhasil dihapus!');
    }

    public function createGuideBook()
    {
        $categories = KomunitasCategory::all();
        return view('admin.guide-books.create', compact('categories'));
    }

    public function dashboard()
    {
        // Mengambil statistik untuk dashboard
        $totalArticles = Komunitas::count();
        $totalCategories = KomunitasCategory::count();
        $totalGuideBooks = GuideBook::count();
        
        return view('admin.dashboard', compact('totalArticles', 'totalCategories', 'totalGuideBooks'));
    }

    public function index()
    {
        $categories = KomunitasCategory::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function editGuideBook(GuideBook $guideBook)
    {
        $categories = KomunitasCategory::all();
        return view('admin.guide-books.edit', compact('guideBook', 'categories'));
    }
}
