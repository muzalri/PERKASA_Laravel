<?php

namespace App\Http\Controllers;

use App\Models\Konsultasi;
use App\Models\User;
use App\Models\PesanKonsultasi;
use Illuminate\Http\Request;

class KonsultasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        
        if ($user->role === 'pakar') {
            $konsultasis = Konsultasi::with(['user', 'pakar', 'pesans' => function($query) {
                $query->latest();
            }])
            ->where('pakar_id', $user->id)
            ->withLastMessageTime()
            ->withCount(['pesans as unread_count' => function($query) {
                $query->where('user_id', '!=', auth()->id())
                      ->where('status', 'belum_dibaca');
            }])
            ->latest()
            ->paginate(10);
        } else {
            $konsultasis = Konsultasi::with(['user', 'pakar', 'pesans' => function($query) {
                $query->latest();
            }])
            ->where('user_id', $user->id)
            ->withLastMessageTime()
            ->withCount(['pesans as unread_count' => function($query) {
                $query->where('user_id', '!=', auth()->id())
                      ->where('status', 'belum_dibaca');
            }])
            ->latest()
            ->paginate(10);
        }

        return view('konsultasi.index', compact('konsultasis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pakars = User::where('role', 'pakar')->get();
        return view('konsultasi.create', compact('pakars'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'pakar_id' => 'required|exists:users,id'
        ]);

        $konsultasi = Konsultasi::create([
            'user_id' => auth()->id(),
            'pakar_id' => $request->pakar_id,
            'judul' => $request->judul
        ]);

        return redirect()->route('konsultasi.show', $konsultasi);
    }

    /**
     * Display the specified resource.
     */
    public function show(Konsultasi $konsultasi)
    {
        if (auth()->user()->id === $konsultasi->pakar_id) {
            $konsultasi->pesans()
                ->where('user_id', '!=', auth()->id())
                ->where('status', 'belum_dibaca')
                ->update(['status' => 'dibaca']);
        }
        
        else if (auth()->user()->id === $konsultasi->user_id) {
            $konsultasi->pesans()
                ->where('user_id', '!=', auth()->id())
                ->where('status', 'belum_dibaca')
                ->update(['status' => 'dibaca']);
        }

        $konsultasi->load(['pesans.user', 'user', 'pakar']);
        return view('konsultasi.show', compact('konsultasi'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Konsultasi $konsultasi)
    {
        $konsultasi->delete();
        return redirect()->route('konsultasi.index');
    }

    public function kirimPesan(Request $request, $id)
    {
        $request->validate([
            'pesan' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $konsultasi = Konsultasi::findOrFail($id);

        $pesan = new PesanKonsultasi();
        $pesan->konsultasi_id = $konsultasi->id;
        $pesan->user_id = auth()->id();
        $pesan->pesan = $request->pesan;

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $namaGambar = time() . '.' . $gambar->getClientOriginalExtension();
            $path = $gambar->storeAs('public/gambar_konsultasi', $namaGambar);
            $pesan->gambar = 'gambar_konsultasi/' . $namaGambar;
        }

        $pesan->save();

        return redirect()->back()->with('success', 'Pesan berhasil dikirim');
    }

    public function getMessagesStatus(Konsultasi $konsultasi)
    {
        $messages = $konsultasi->pesans()
            ->select('id', 'status')
            ->get();
        
        return response()->json($messages);
    }

    public function getStatusUpdates()
    {
        $user = auth()->user();
        
        $konsultasis = Konsultasi::where(function($query) use ($user) {
            $query->where('user_id', $user->id)
                  ->orWhere('pakar_id', $user->id);
        })
        ->withCount(['pesans as unread_count' => function($query) {
            $query->where('user_id', '!=', auth()->id())
                  ->where('status', 'belum_dibaca');
        }])
        ->with(['pesans' => function($query) {
            $query->latest()->first();
        }])
        ->get()
        ->map(function($konsultasi) {
            return [
                'id' => $konsultasi->id,
                'unread_count' => $konsultasi->unread_count,
                'last_message_status' => $konsultasi->pesans->first()?->status
            ];
        });

        return response()->json($konsultasis);
    }
}
