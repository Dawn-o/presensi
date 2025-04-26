@extends('layouts.app')

@section('content')
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Absensi Hari Ini</h3>

            @if (session('error'))
                <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mt-5">
                @if (!$today || !$today->check_out)
                    <form action="{{ route('presence.store') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white {{ $today && $today->check_in ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }}">
                            {{ $today && $today->check_in ? 'Presensi Pulang' : 'Presensi Masuk' }}
                        </button>
                    </form>
                @endif

                @if ($today)
                    <div class="mt-4 space-y-2">
                        <p class="text-sm text-gray-600">
                            Jam Masuk: {{ $today->check_in ? $today->check_in->format('H:i') : '-' }}
                        </p>
                        @if ($today->check_out)
                            <p class="text-sm text-gray-600">
                                Jam Pulang: {{ $today->check_out->format('H:i') }}
                            </p>
                        @endif
                        <p class="text-sm text-gray-600">
                            Status:
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $today->status === 'present'
                                ? 'bg-green-100 text-green-800'
                                : ($today->status === 'late'
                                    ? 'bg-yellow-100 text-yellow-800'
                                    : 'bg-red-100 text-red-800') }}">
                                {{ $today->status === 'present' ? 'Tepat Waktu' : ($today->status === 'late' ? 'Terlambat' : 'Tidak Hadir') }}
                            </span>
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
