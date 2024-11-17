<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Cek role user
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        
        // Untuk user biasa
        return view('dashboard');
    }
}
