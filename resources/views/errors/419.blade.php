@extends('layouts.app')

@section('content')
    <div class="mt-64 flex items-center justify-center">
        <div class="max-w-xl w-full px-4">
            <div class="text-center">
                <h1 class="text-9xl font-bold text-red-600">419</h1>
                <p class="mt-4 text-3xl font-bold text-gray-900">Sesi Telah Berakhir</p>
                <p class="mt-4 text-gray-600">Maaf, sesi Anda telah berakhir. Silakan muat ulang halaman.</p>

                <div class="mt-8 space-y-4">
                    <button onclick="window.location.reload()"
                        class="inline-flex items-center px-4 py-2 border border-transparent sm:rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Muat Ulang Halaman
                    </button>

                    <div class="inline-flex items-center">
                        <span class="mr-2 text-sm text-gray-500">atau</span>
                        <a href="{{ url('/') }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 sm:rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            <svg class="h-5 w-5 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
