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

        Pesan::create($data);

        $konsultasi->touch();

        return redirect()->route('konsultasi.show', $konsultasi)
            ->with('success', 'Pesan berhasil dikirim');
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
