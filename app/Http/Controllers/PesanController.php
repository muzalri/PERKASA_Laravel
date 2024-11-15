<?php

namespace App\Http\Controllers;

use App\Models\Konsultasi;
use App\Models\Pesan;
use Illuminate\Http\Request;

class PesanController extends Controller
{
    public function store(Request $request, Konsultasi $konsultasi)
    {
        $request->validate([
            'isi' => 'required_without:image',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = [
            'konsultasi_id' => $konsultasi->id,
            'user_id' => auth()->id(),
            'isi' => $request->isi,
            'status' => 'terkirim'
        ];

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('pesan_images', 'public');
            $data['image_path'] = $imagePath;
        }

        $pesan = Pesan::create($data);
        $pesan->load('user');

        return response()->json([
            'success' => true,
            'message' => 'Pesan berhasil dikirim',
            'data' => $pesan
        ]);
    }

    public function updateStatus(Pesan $pesan, $status)
    {
        if (!in_array($status, ['dibaca', 'dibalas'])) {
            return response()->json(['error' => 'Invalid status'], 400);
        }

        $pesan->update(['status' => $status]);
        return response()->json(['success' => true]);
    }
}
