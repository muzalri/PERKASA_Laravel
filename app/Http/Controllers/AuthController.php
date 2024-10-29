<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{

    //REGISTRASI
    public function showRegistrationForm()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        // Validasi data input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string|max:500',
        ]);

        // Buat pengguna baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        
        Auth::login($user);

        // Redirect ke dashboard atau halaman lain
        return redirect()->route('dashboard')->with('success', 'Registrasi berhasil!');

    }



    //LOGIN
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        // Validasi data input
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Coba otentikasi
        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard')->with('success', 'Login berhasil!');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }


    //LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return view('/')->with('success', 'Logout berhasil!');
    }




    //PROFILE
    public function showProfile()
    {
        return view('profile');
    }

    public function edit()
    {
        return view('auth.profile', ['user' => Auth::user()]);
    }
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi data input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|confirmed|min:8',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string|max:500',
        ]);

        // Update data pengguna
        $user->name = $request->name;
        $user->email = $request->email;
        $user->no_hp = $request->no_hp;
        $user->alamat = $request->alamat;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('dashboard')->with('success', 'Profil berhasil diperbarui!');
    }

    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $user = Auth::user();

        if ($request->hasFile('profile_photo')) {
            // Hapus foto lama jika ada
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            // Simpan foto baru
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $user->profile_photo = $path;
            $user->save();
        }

        return redirect()->route('profile')->with('success', 'Foto profil berhasil diperbarui!');
    }

    public function deletePhoto()
    {
        $user = Auth::user();
        
        if ($user->profile_photo) {
            // Hapus file foto dari storage
            Storage::disk('public')->delete($user->profile_photo);
            
            // Hapus referensi foto dari database
            $user->profile_photo = null;
            $user->save();
            
            return redirect()->route('profile')->with('success', 'Foto profil berhasil dihapus!');
        }
        
        return redirect()->route('profile')->with('error', 'Tidak ada foto profil untuk dihapus.');
    }

}
