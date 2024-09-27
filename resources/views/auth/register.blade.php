@extends('layout.auth')

@section('title', 'Register')

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



<div class="row h-100">
    <div class="col-lg-5 col-12">
        <div id="auth-left">
            <div class="auth-logo">
                <a href=""><img src="assets/images/logo/logo.png" alt="Logo"></a>
            </div>
            <h1 class="auth-title">Sign Up</h1>
            <p class="auth-subtitle mb-5">Input your data to register to our website.</p>

            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="text" class="form-control form-control-xl" placeholder="Email" name="email" value="{{ old('email') }}" required>
                    <div class="form-control-icon">
                        <i class="bi bi-envelope"></i>
                    </div>
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="text" class="form-control form-control-xl" placeholder="Name" name="name" value="{{ old('name') }}" required autofocus>
                    <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                    </div>
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="password" class="form-control form-control-xl" placeholder="Password" name="password" required>
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="password" class="form-control form-control-xl" placeholder="Confirm Password"  name="password_confirmation" required>
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="text" class="form-control form-control-xl" placeholder="Number Handphone"  name="no_hp" value="{{ old('no_hp') }}" required>
                    <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                    </div>
                </div>
                 <div class="form-group position-relative has-icon-left mb-4">
                    <input type="text" class="form-control form-control-xl" placeholder="Alamat"  name="alamat" value="{{ old('alamat') }}" required>
                    <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                    </div>
                </div>

                <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Sign Up</button>
            </form>
            <div class="text-center mt-5 text-lg fs-4">
                <p class='text-gray-600'>Already have an account? 
                    <a href="{{ route('login') }}" class="font-bold">Log in</a>.</p>
            </div>
        </div>
    </div>
    <div class="col-lg-7 d-none d-lg-block">
        <div id="auth-right">

        </div>
    </div>
</div>

@endSection