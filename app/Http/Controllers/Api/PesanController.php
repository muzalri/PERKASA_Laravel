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
        try {
            $request->validate([
                'isi' => 'required_without:gambar',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
    
            // Pastikan direktori ada
            if (!file_exists(public_path('imagedb/konsultasi'))) {
                mkdir(public_path('imagedb/konsultasi'), 0775, true);
            }
    
            $data = [
                'konsultasi_id' => $konsultasi->id,
                'user_id' => auth()->id(),
                'isi' => $request->isi,
                'status' => 'belum_dibaca'
            ];
    
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('imagedb/konsultasi'), $fileName);
                $data['gambar'] = $fileName;
            }
    
            $pesan = Pesan::create($data);
    
            // Load relasi user
            $pesan->load('user');
            
            // Transform response untuk menambahkan URL gambar
            $responseData = $pesan->toArray();
            if ($pesan->gambar) {
                $responseData['gambar_url'] = url('imagedb/konsultasi/' . $pesan->gambar);
            }
    
            return response()->json([
                'success' => true,
                'message' => 'Pesan berhasil dikirim',
                'data' => $responseData
            ], 201);
    
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengirim pesan',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateStatus(Request $request, Pesan $pesan, $status)
    {
        if (!in_array($status, ['dibaca', 'dibalas'])) {
            return response()->json(['error' => 'Invalid status'], 400);
        }

        $pesan->update(['status' => $status]);
        return response()->json(['success' => true]);
    }

    protected $appends = ['gambar_url'];

    public function getGambarUrlAttribute()
    {
        return $this->gambar ? url('imagedb/konsultasi/' . $this->gambar) : null;
    }

}
