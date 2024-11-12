<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin; // Pastikan model Admin di-import
use App\Models\KomunitasCategory; // Import model KomunitasCategory
use App\Models\Komunitas; // Import model Komunitas
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Fungsi login admin
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Mencari admin berdasarkan username
        $admin = Admin::where('username', $request->username)->first();

        // Memeriksa apakah admin ditemukan
        if ($admin) {
            // Memeriksa apakah password cocok
            if (Hash::check($request->password, $admin->password)) {
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
            } else {
                // Password tidak cocok
                return response()->json([
                    'success' => false,
                    'message' => 'Kredensial tidak valid.',
                ], 401);
            }
        } else {
            // Admin tidak ditemukan
            return response()->json([
                'success' => false,
                'message' => 'Kredensial tidak valid.',
            ], 401);
        }
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
}