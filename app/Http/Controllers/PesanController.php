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
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'konsultasi_id' => $konsultasi->id,
            'user_id' => auth()->id(),
            'isi' => $request->isi,
        ];

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('pesan_gambar', 'public');
            $data['gambar'] = $path;
        }

        Pesan::create($data);

        return redirect()->route('konsultasi.show', $konsultasi)->with('success', 'Pesan berhasil dikirim');
    }
}
