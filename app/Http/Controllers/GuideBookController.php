<?php

namespace App\Http\Controllers;

use App\Models\GuideBook;
use Illuminate\Http\Request;

class GuideBookController extends Controller
{
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

    // Tambahkan metode lain seperti create, store, edit, update, dan delete sesuai kebutuhan
}
