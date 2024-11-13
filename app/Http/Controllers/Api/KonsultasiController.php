<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Konsultasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KonsultasiController extends Controller
{
    public function index()
    {
        $konsultasi = Konsultasi::with(['user', 'pakar', 'pesans'])->latest()->paginate(10);
        return response()->json([
            'success' => true,
            'data' => $konsultasi
        ]);
    }

    public function show(Konsultasi $konsultasi)
    {
        $konsultasi->load(['user', 'pakar', 'pesans.user']);
        return response()->json([
            'success' => true,
            'data' => $konsultasi
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'pakar_id' => 'required|exists:users,id',
        ]);

        $konsultasi = Konsultasi::create([
            'user_id' => Auth::id(),
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'pakar_id' => $request->pakar_id,
            'status' => 'pending'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Konsultasi berhasil dibuat',
            'data' => $konsultasi
        ], 201);
    }

    public function storePesan(Request $request, Konsultasi $konsultasi)
    {
        $request->validate([
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = [
            'user_id' => Auth::id(),
            'konsultasi_id' => $konsultasi->id,
            'isi' => $request->isi,
            'status' => 'terkirim'
        ];

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('pesan-images', 'public');
            $data['gambar'] = $path;
        }

        $pesan = Pesan::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Pesan berhasil dikirim',
            'data' => $pesan
        ], 201);
    }

    public function updateStatus(Request $request, Pesan $pesan, $status)
    {
        if (!in_array($status, ['terkirim', 'dibaca', 'dibalas'])) {
            return response()->json([
                'success' => false,
                'message' => 'Status tidak valid'
            ], 422);
        }

        $pesan->update(['status' => $status]);

        return response()->json([
            'success' => true,
            'message' => 'Status pesan berhasil diupdate',
            'data' => $pesan
        ]);
    }

    public function getMessagesStatus(Konsultasi $konsultasi)
    {
        $messages = $konsultasi->pesan()->select('id', 'status')->get();
        
        return response()->json([
            'success' => true,
            'data' => $messages
        ]);
    }
} 