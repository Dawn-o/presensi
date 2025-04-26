@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center">
    <div class="max-w-md w-full space-y-8">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Buat Akun Baru
            </h2>
        </div>
        <form class="mt-8 space-y-6" method="POST" action="{{ route('register') }}">
            @csrf
            
            <!-- Name field -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">
                    Nama
                </label>
                <div class="mt-1">
                    <input id="name" 
                           name="name" 
                           type="text" 
                           required 
                           placeholder="Masukkan nama lengkap"
                           value="{{ old('name') }}"
                           class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                           autofocus>
                </div>
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Employee ID field -->
            <div>
                <label for="employee_id" class="block text-sm font-medium text-gray-700">
                    NIP/NIK
                </label>
                <div class="mt-1">
                    <input id="employee_id" 
                           name="employee_id" 
                           type="text" 
                           required 
                           placeholder="Masukkan NIP/NIK"
                           value="{{ old('employee_id') }}"
                           class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                @error('employee_id')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email field -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">
                    Email
                </label>
                <div class="mt-1">
                    <input id="email" 
                           name="email" 
                           type="email" 
                           required 
                           placeholder="Masukkan alamat email"
                           value="{{ old('email') }}"
                           class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password field -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">
                    Password
                </label>
                <div class="mt-1">
                    <input id="password" 
                           name="password" 
                           type="password" 
                           required
                           placeholder="Masukkan password"
                           class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password field -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                    Konfirmasi Password
                </label>
                <div class="mt-1">
                    <input id="password_confirmation" 
                           name="password_confirmation" 
                           type="password" 
                           required
                           placeholder="Konfirmasi password"
                           class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <div>
                <button type="submit" 
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Daftar
                </button>
            </div>

            <div class="text-sm text-center">
                <p class="text-gray-600">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                        Masuk disini
                    </a>
                </p>
            </div>
        </form>
    </div>
</div>
@endsection