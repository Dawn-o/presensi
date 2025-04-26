@extends('layouts.app')

@section('content')
<div class="mt-64 flex items-center justify-center">
    <div class="max-w-xl w-full px-4">
        <div class="text-center">
            <h1 class="text-9xl font-bold text-indigo-600">404</h1>
            <p class="mt-4 text-3xl font-bold text-gray-900">Halaman Tidak Ditemukan</p>
            <p class="mt-4 text-gray-600">Maaf, halaman yang Anda cari tidak dapat ditemukan.</p>
            
            <div class="mt-8">
                <a href="{{ url('/') }}" 
                   class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>
@endsection