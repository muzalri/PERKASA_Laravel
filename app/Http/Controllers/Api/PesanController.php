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
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $konsultasi->pesans()
            ->where('user_id', '!=', auth()->id())
            ->where('status', '!=', 'dibalas')
            ->update(['status' => 'dibalas']);

        $data = [
            'konsultasi_id' => $konsultasi->id,
            'user_id' => auth()->id(),
            'isi' => $request->isi,
            'status' => 'belum_dibaca',
            'created_at' => now(),
        ];

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('pesan_gambar', 'public');
            $data['gambar'] = $path;
        }

        $pesan = Pesan::create($data);
        $konsultasi->touch();

        return response()->json([
            'success' => true,
            'message' => 'Pesan berhasil dikirim',
            'data' => $pesan
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
