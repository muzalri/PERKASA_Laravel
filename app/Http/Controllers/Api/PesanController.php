<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Konsultasi;
use App\Models\Pesan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesanController extends Controller
{
    public function store(Request $request, Konsultasi $konsultasi)
{
    $request->validate([
        'isi' => 'required_without:gambar',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $data = [
        'konsultasi_id' => $konsultasi->id,
        'user_id' => auth()->id(),
        'isi' => $request->isi,
        'status' => 'belum_dibaca'
    ];

    if ($request->hasFile('gambar')) {
        $gambarPath = $request->file('gambar')->store('pesan-gambar', 'public');
        $data['gambar'] = $gambarPath;
    }

    $pesan = Pesan::create($data);

    // Load relasi user dan tambahkan data gambar ke response
    $pesan->load('user');
    
    // Transform response untuk menambahkan URL gambar jika ada
    $responseData = $pesan->toArray();
    if ($pesan->gambar) {
        $responseData['gambar_url'] = asset('storage/' . $pesan->gambar);
    }

    return response()->json([
        'success' => true,
        'message' => 'Pesan berhasil dikirim',
        'data' => $responseData
    ], 201);
}

    public function updateStatus(Request $request, Pesan $pesan, $status)
    {
        if (!in_array($status, ['dibaca', 'dibalas'])) {
            return response()->json(['error' => 'Invalid status'], 400);
        }

        $pesan->update(['status' => $status]);
        return response()->json(['success' => true]);
    }
}
