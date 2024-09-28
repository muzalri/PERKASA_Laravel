@extends('layout.auth')

@section('title', 'Login')

@section('content')

@if ($errors->any())
<div>
    <ul>
        @foreach ($errors->all() as $error)
            <li style="color:red;">{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if (session('success'))
<div style="color:green;">
    {{ session('success') }}
</div>
@endif


<div class="row h-100">
    <div class="col-lg-5 col-12">
        <div id="auth-left">
            <div class="auth-logo">
                <a href="index.html"><img src="assets/images/logo/logo.png" alt="Logo"></a>
            </div>
            <h1 class="auth-title">Selamat Datang Di PERKASA</h1>
            <p class="auth-subtitle mb-5">Perkasa adalah platform inovatif yang memberdayakan anak muda Indonesia untuk memulai bisnis budidaya ikan dengan mudah.
                Dengan hanya menyediakan lahan dan tenaga kerja, 
                Anda akan mendapatkan bimbingan lengkap, mulai dari pelatihan hingga pemasaran hasil panen.</p>

      
            <a class="btn btn-primary btn-block btn-lg mt-4" href="{{ route('register') }}" >Belum Punya Akun Registrasi Disini.</a>

            <a class="btn btn-lg btn-outline-primary btn-block btn-lg mt-3" href="{{ route('login') }}" >Sudah Punya Akun Login Disini</a>

        </div>
    </div>
    <div class="col-lg-7 d-none d-lg-block">
        <div id="auth-right">

        </div>
    </div>
</div>

@endSection