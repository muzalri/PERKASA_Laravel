@extends('layout.master')
@section('title', 'Profile')

@section('content')


@if (session('success'))
<div style="color:green;">
    {{ session('success') }}
</div>
@endif
<div class="page-heading">
    <h3>Profile</h3>
</div>

<p>Selamat datang, {{ Auth::user()->name }}!</p>
<p>Email: {{ Auth::user()->email }}</p>
<p>No HP: {{ Auth::user()->no_hp }}</p>
<p>Alamat: {{ Auth::user()->alamat }}</p>

<form method="POST" action="{{ route('logout') }}">
@csrf
<button type="submit">Logout</button>
</form>
<form method="get" action="{{ route('profile.edit') }}">
    @csrf
    <button type="submit">edit</button>
</form>
@endsection