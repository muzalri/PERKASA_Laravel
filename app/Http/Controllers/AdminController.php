<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{

    // Halaman Dashboard
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // Halaman Guide Books
    public function indexGuideBooks()
    {
        return view('admin.guide-books.index');
    }

    public function createGuideBook()
    {
        return view('admin.guide-books.create');
    }

    public function editGuideBook($id)
    {
        return view('admin.guide-books.edit', ['id' => $id]);
    }

    public function showGuideBook($id)
    {
        return view('admin.guide-books.show', ['id' => $id]);
    }

    // Halaman Categories
    public function indexCategories()
    {
        return view('admin.categories.index');
    }

    // Halaman Articles
    public function indexArticles()
    {
        return view('admin.articles.index');
    }

    public function showArticle($id)
    {
        return view('admin.articles.show', ['id' => $id]);
    }
}
