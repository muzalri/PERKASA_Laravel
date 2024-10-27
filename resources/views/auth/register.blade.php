@extends('layout.auth')

@section('title', 'Register')

@section('content')

@if ($errors->any())
<div>
    <ul>
        @foreach ($errors->all() as $error)
            <li class="text-red-500">{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="flex flex-col lg:flex-row min-h-screen">
    <!-- Left Section -->
    <div class="w-full lg:w-5/12 flex items-center justify-center p-4 lg:p-0 bg-sky-100">
        <div class="w-full max-w-md px-4 sm:px-6 lg:px-8 bg-white rounded-xl shadow-lg py-8">
            <div class="mb-6 lg:mb-8 text-center">
                <a href="">
                    <img src="assets/images/logo/logo.png" alt="Logo" class="h-10 lg:h-12 mx-auto">
                </a>
            </div>
            <h1 class="text-2xl lg:text-3xl font-bold mb-2 text-center">Sign Up</h1>
            <p class="text-sm lg:text-base text-gray-600 mb-6 lg:mb-8 text-center">Input your data to register to our website.</p>

            <form action="{{ route('register') }}" method="POST">
                @csrf
                <!-- Error Messages -->
                @if ($errors->any())
                <div class="mb-4">
                    <ul class="bg-red-50 p-4 rounded-lg">
                        @foreach ($errors->all() as $error)
                            <li class="text-red-500 text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Form Fields -->
                <div class="space-y-4 lg:space-y-6">
                    <div class="relative">
                        <input type="text" 
                               class="w-full px-5 py-3 lg:py-4 pl-14 border-2 border-gray-200 rounded-lg 
                                      focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500
                                      text-sm lg:text-base bg-gray-50 hover:bg-gray-100 transition-colors
                                      shadow-sm" 
                               placeholder="Email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required>
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="bi bi-envelope text-sky-500 text-lg lg:text-xl"></i>
                        </div>
                    </div>

                    <div class="relative">
                        <input type="text" 
                               class="w-full px-5 py-3 lg:py-4 pl-14 border-2 border-gray-200 rounded-lg 
                                      focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500
                                      text-sm lg:text-base bg-gray-50 hover:bg-gray-100 transition-colors
                                      shadow-sm" 
                               placeholder="Name" 
                               name="name" 
                               value="{{ old('name') }}" 
                               required>
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="bi bi-person text-sky-500 text-lg lg:text-xl"></i>
                        </div>
                    </div>

                    <div class="relative">
                        <input type="password" 
                               class="w-full px-5 py-3 lg:py-4 pl-14 border-2 border-gray-200 rounded-lg 
                                      focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500
                                      text-sm lg:text-base bg-gray-50 hover:bg-gray-100 transition-colors
                                      shadow-sm" 
                               placeholder="Password" 
                               name="password" 
                               required>
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="bi bi-shield-lock text-sky-500 text-lg lg:text-xl"></i>
                        </div>
                    </div>

                    <div class="relative">
                        <input type="password" 
                               class="w-full px-5 py-3 lg:py-4 pl-14 border-2 border-gray-200 rounded-lg 
                                      focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500
                                      text-sm lg:text-base bg-gray-50 hover:bg-gray-100 transition-colors
                                      shadow-sm" 
                               placeholder="Confirm Password" 
                               name="password_confirmation" 
                               required>
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="bi bi-shield-lock text-sky-500 text-lg lg:text-xl"></i>
                        </div>
                    </div>

                    <div class="relative">
                        <input type="text" 
                               class="w-full px-5 py-3 lg:py-4 pl-14 border-2 border-gray-200 rounded-lg 
                                      focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500
                                      text-sm lg:text-base bg-gray-50 hover:bg-gray-100 transition-colors
                                      shadow-sm" 
                               placeholder="Number Handphone" 
                               name="no_hp" 
                               value="{{ old('no_hp') }}" 
                               required>
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="bi bi-phone text-sky-500 text-lg lg:text-xl"></i>
                        </div>
                    </div>

                    <div class="relative">
                        <input type="text" 
                               class="w-full px-5 py-3 lg:py-4 pl-14 border-2 border-gray-200 rounded-lg 
                                      focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500
                                      text-sm lg:text-base bg-gray-50 hover:bg-gray-100 transition-colors
                                      shadow-sm" 
                               placeholder="Alamat" 
                               name="alamat" 
                               value="{{ old('alamat') }}" 
                               required>
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="bi bi-geo-alt text-sky-500 text-lg lg:text-xl"></i>
                        </div>
                    </div>
                </div>

                <button class="w-full py-3 lg:py-4 bg-teal-600 text-white rounded-lg font-bold 
                             hover:bg-teal-700 active:bg-teal-800 
                             transition-all duration-300 transform hover:scale-[1.02]
                             shadow-lg hover:shadow-xl text-sm lg:text-base
                             mt-8 lg:mt-10">
                    Sign Up
                </button>
            </form>

            <div class="text-center mt-6 lg:mt-8">
                <p class="text-gray-600 text-sm lg:text-base">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="font-bold text-teal-600 hover:text-teal-800 transition-colors">Log in</a>
                </p>
            </div>
        </div>
    </div>

    <!-- Right Section -->
    <div class="hidden lg:block lg:w-7/12 bg-teal-600">
    </div>
</div>

@endSection
