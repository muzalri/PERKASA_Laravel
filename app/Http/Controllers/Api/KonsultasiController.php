<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Konsultasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Pesan;

class KonsultasiController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $konsultasis = Konsultasi::with(['user', 'pakar', 'pesans' => function($query) {
            $query->latest();
        }]);

        // Filter berdasarkan role
        if ($user->role === 'pakar') {
            $konsultasis->where('pakar_id', $user->id)
                       ->where('status_pakar', 'active');
        } else {
            $konsultasis->where('user_id', $user->id)
                       ->where('status_user', 'active');
        }

        // Hitung pesan yang belum dibaca
        $konsultasis = $konsultasis->withCount(['pesans as unread_count' => function($query) use ($user) {
            $query->where('user_id', '!=', $user->id)
                  ->where('status', 'belum_dibaca');
        }])
        ->latest()
        ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $konsultasis
        ]);
    }

    public function show(Konsultasi $konsultasi)
    {
        $user = auth()->user();
        
        // Tambahkan logging
        \Log::info('Konsultasi access check', [
            'user_id' => $user->id,
            'konsultasi_user_id' => $konsultasi->user_id,
            'konsultasi_pakar_id' => $konsultasi->pakar_id,
            'user_role' => $user->role
        ]);
        
        // Verifikasi akses
        if ($user->id === $konsultasi->user_id || $user->id === $konsultasi->pakar_id) {
            // Update status pesan menjadi dibaca
            $konsultasi->pesans()
                ->where('user_id', '!=', $user->id)
                ->where('status', 'belum_dibaca')
                ->update(['status' => 'dibaca']);

            $konsultasi->load(['pesans.user', 'user', 'pakar']);
            
            return response()->json([
                'success' => true,
                'data' => $konsultasi
            ]);
        }

        // Tambahkan detail error
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized access',
            'debug' => [
                'user_id' => $user->id,
                'konsultasi_user_id' => $konsultasi->user_id,
                'konsultasi_pakar_id' => $konsultasi->pakar_id
            ]
        ], 403);
    }

    public function create()
    {
        $pakars = User::where('role', 'pakar')->get(); // Mengambil semua pengguna dengan role pakar
        return response()->json([
            'success' => true,
            'data' => $pakars
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'judul' => 'required',
                'pakar_id' => 'required|exists:users,id',
                'isi' => 'required|string' // tambahan validasi untuk isi pesan
            ]);

            // Buat konsultasi baru
            $konsultasi = Konsultasi::create([
                'user_id' => auth()->id(),
                'pakar_id' => $request->pakar_id,
                'judul' => $request->judul
            ]);

            // Buat pesan pertama
            $pesan = Pesan::create([
                'konsultasi_id' => $konsultasi->id,
                'user_id' => auth()->id(),
                'isi' => $request->isi,
                'status' => 'belum_dibaca'
            ]);

            // Load relasi yang diperlukan
            $konsultasi->load(['user', 'pakar', 'pesans.user']);

            return response()->json([
                'success' => true,
                'message' => 'Konsultasi berhasil dibuat',
                'data' => $konsultasi
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat konsultasi',
                'error' => $e->getMessage()
            ], 500);
        }
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

    public function destroy(Konsultasi $konsultasi)
    {
        $user = auth()->user();
        
        // Verifikasi akses
        if ($user->role === 'pakar') {
            if ($konsultasi->pakar_id !== $user->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak memiliki akses untuk menghapus konsultasi ini.'
                ], 403);
            }
            // Update status hanya untuk pakar
            $konsultasi->update(['status_pakar' => 'deleted']);
        } else {
            if ($konsultasi->user_id !== $user->id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak memiliki akses untuk menghapus konsultasi ini.'
                ], 403);
            }
            // Update status hanya untuk user
            $konsultasi->update(['status_user' => 'deleted']);
        }

        // Cek apakah kedua status sudah dihapus
        if ($konsultasi->status_user === 'deleted' && $konsultasi->status_pakar === 'deleted') {
            // Hapus semua pesan terkait
            Pesan::where('konsultasi_id', $konsultasi->id)->delete();
            $konsultasi->forceDelete();
            
            return response()->json([
                'success' => true,
                'message' => 'Konsultasi dan semua pesan terkait berhasil dihapus.'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Konsultasi berhasil dihapus dari daftar Anda.'
        ]);
    }
} 