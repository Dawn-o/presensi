@extends('layouts.app')

@section('content')
    @php
        $serverTime = now()->setTimezone('Asia/Makassar');
        $timestamp = $serverTime->timestamp * 1000; // Convert to milliseconds for JavaScript
    @endphp

    <div class="max-w-7xl mx-auto py-4 sm:py-6 px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
                <h1 class="text-2xl font-bold text-gray-900">Presensi</h1>
                <div class="w-full sm:w-auto">
                    <a href="{{ route('employees.index') }}"
                        class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 border border-gray-300 sm:rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        Daftar Karyawan
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Grid Layout -->
        <div class="grid grid-cols-12 gap-6">
            <!-- Left Sidebar -->
            <div class="col-span-12 lg:col-span-4 space-y-6">
                <!-- Clock Card -->
                <div class="bg-white shadow sm:rounded-lg p-6">
                    <div class="text-center">
                        <div id="clock" class="text-4xl font-bold text-gray-800"></div>
                        <div id="date" class="mt-2 text-lg text-gray-600"></div>
                    </div>
                </div>

                <!-- Location Status Card -->
                <div class="bg-white shadow sm:rounded-lg overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                @if (App\Helpers\IpHelper::isAllowedIp(request()->ip()))
                                    <div class="p-2 bg-green-100 sm:rounded-full">
                                        <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                @else
                                    <div class="p-2 bg-red-100 sm:rounded-full">
                                        <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="ml-4 flex-1">
                                <h3 class="text-lg font-medium text-gray-900">Status Lokasi</h3>
                                <div class="mt-2">
                                    @if (App\Helpers\IpHelper::isAllowedIp(request()->ip()))
                                        <p class="text-sm font-medium text-green-600">
                                            Anda berada di lingkungan kantor
                                        </p>
                                        <p class="mt-1 text-sm text-gray-500">
                                            IP Address terdeteksi di jaringan kantor
                                        </p>
                                    @else
                                        <p class="text-sm font-medium text-red-600">
                                            Anda berada di luar lingkungan kantor
                                        </p>
                                        <p class="mt-1 text-sm text-gray-500">
                                            Silakan gunakan WiFi kantor untuk melakukan presensi
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (!App\Helpers\IpHelper::isAllowedIp(request()->ip()))
                        <div class="bg-red-50 px-6 py-4 border-t border-red-100">
                            <div class="flex items-center">
                                <svg class="h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="ml-3 text-sm text-red-700">
                                    Presensi hanya dapat dilakukan di lingkungan kantor
                                </p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Add this after the Location Status Card -->
                <div class="bg-white shadow sm:rounded-lg overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900">Informasi Jam Kerja</h3>
                        <dl class="mt-4 space-y-4">
                            <div class="flex justify-between">
                                <dt class="text-sm font-medium text-gray-500">Jam Masuk</dt>
                                <dd class="text-sm text-gray-900">07.00 - 08.00 WITA</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-sm font-medium text-gray-500">Jam Pulang</dt>
                                <dd class="text-sm text-gray-900">16.00 WITA</dd>
                            </div>
                            <div class="pt-4 border-t border-gray-200">
                                <dt class="text-sm font-medium text-gray-500 mb-2">Ketentuan</dt>
                                <dd class="text-sm text-gray-600 space-y-2">
                                    <p class="flex items-center">
                                        <svg class="h-4 w-4 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Terlambat jika presensi di atas jam 08.00
                                    </p>
                                    <p class="flex items-center">
                                        <svg class="h-4 w-4 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Wajib presensi di lingkungan kantor
                                    </p>
                                    <p class="flex items-center">
                                        <svg class="h-4 w-4 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Presensi pulang setelah jam 16.00
                                    </p>
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="col-span-12 lg:col-span-8 space-y-6">
                <!-- Presence Card -->
                <div class="bg-white shadow sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between">
                            <h2 class="text-xl font-semibold text-gray-900">Absensi Hari Ini</h2>
                            @if ($today)
                                <span
                                    class="px-3 py-1 text-sm sm:rounded-full 
                                    {{ $today->status === 'present'
                                        ? 'bg-green-100 text-green-800'
                                        : ($today->status === 'late'
                                            ? 'bg-yellow-100 text-yellow-800'
                                            : 'bg-red-100 text-red-800') }}">
                                    {{ $today->status === 'present' ? 'Tepat Waktu' : ($today->status === 'late' ? 'Terlambat' : 'Tidak Hadir') }}
                                </span>
                            @else
                                <span class="px-3 py-1 text-sm sm:rounded-full bg-gray-100 text-gray-800">
                                    Belum Absen
                                </span>
                            @endif
                        </div>

                        <!-- Add presence messages here -->
                        @if (session('success'))
                            <div class="mt-4 bg-green-50 border border-green-200 sm:rounded-md p-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-green-400" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-green-800">
                                            {{ session('success') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="mt-4 bg-red-50 border border-red-200 sm:rounded-md p-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-red-800">
                                            {{ session('error') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="mt-6">
                            <div class="grid grid-cols-2 gap-6">
                                <div class="bg-gray-50 sm:rounded-lg p-4">
                                    <div class="text-sm font-medium text-gray-500">Jam Masuk</div>
                                    <div class="mt-1 text-2xl font-semibold text-gray-900">
                                        {{ $today?->check_in?->format('H:i') ?? '-' }}
                                    </div>
                                </div>
                                <div class="bg-gray-50 sm:rounded-lg p-4">
                                    <div class="text-sm font-medium text-gray-500">Jam Pulang</div>
                                    <div class="mt-1 text-2xl font-semibold text-gray-900">
                                        {{ $today?->check_out?->format('H:i') ?? '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if (!$today || !$today->check_out)
                            <div class="mt-6 md:flex md:justify-end">
                                <form action="{{ route('presence.store') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium sm:rounded-md text-white {{ $today && $today->check_in ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }} transition-colors duration-200">
                                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                        </svg>
                                        {{ $today && $today->check_in ? 'Presensi Pulang' : 'Presensi Masuk' }}
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Monthly Calendar -->
                <div class="bg-white shadow sm:rounded-lg overflow-hidden">
                    <div class="p-4 sm:p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">
                            Kehadiran Bulan {{ now()->translatedFormat('F Y') }}
                        </h3>

                        <!-- Mobile Calendar View -->
                        <div class="block sm:hidden">
                            <div class="space-y-3">
                                @foreach ($monthlyCalendar as $day)
                                    <div class="bg-gray-50 sm:sm:rounded-lg p-3">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <div class="font-medium text-gray-900">
                                                    {{ $day['date']->translatedFormat('l') }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ $day['date']->format('d/m/Y') }}
                                                </div>
                                            </div>
                                            @include('partials.attendance-status-badge', ['day' => $day])
                                        </div>
                                        @if (!$day['date']->isWeekend() && !$day['date']->isFuture() && $day['presence'])
                                            <div class="mt-2 text-sm text-gray-600">
                                                <div class="grid grid-cols-2 gap-2">
                                                    <div>Masuk: {{ $day['presence']->check_in?->format('H:i') ?? '-' }}
                                                    </div>
                                                    <div>Pulang: {{ $day['presence']->check_out?->format('H:i') ?? '-' }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Desktop Table View -->
                        <div class="hidden sm:block">
                            <div class="overflow-hidden">
                                <div class="w-full">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th scope="col"
                                                    class="hidden sm:table-cell px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Hari
                                                </th>
                                                <th scope="col"
                                                    class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Tanggal
                                                </th>
                                                <th scope="col"
                                                    class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Jam
                                                </th>
                                                <th scope="col"
                                                    class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Status
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach ($monthlyCalendar as $day)
                                                <tr class="{{ $day['date']->isWeekend() ? 'bg-gray-50' : '' }}">
                                                    <td
                                                        class="hidden sm:table-cell px-3 sm:px-6 py-4 whitespace-nowrap text-xs sm:text-sm text-gray-900">
                                                        {{ $day['date']->translatedFormat('l') }}
                                                    </td>
                                                    <td class="px-3 sm:px-6 py-4 text-xs sm:text-sm text-gray-900">
                                                        <div>{{ $day['date']->format('d/m/y') }}</div>
                                                        <div class="sm:hidden text-gray-500">
                                                            {{ $day['date']->translatedFormat('l') }}</div>
                                                    </td>
                                                    <td class="px-3 sm:px-6 py-4 text-xs sm:text-sm text-gray-900">
                                                        <div>M: {{ $day['presence']?->check_in?->format('H:i') ?? '-' }}
                                                        </div>
                                                        <div>P: {{ $day['presence']?->check_out?->format('H:i') ?? '-' }}
                                                        </div>
                                                    </td>
                                                    <td class="px-3 sm:px-6 py-4">
                                                        @if ($day['date']->isWeekend())
                                                            <span
                                                                class="px-2 inline-flex text-xs leading-5 font-semibold sm:sm:rounded-full bg-gray-100 text-gray-800">
                                                                Libur
                                                            </span>
                                                        @elseif($day['date']->isToday())
                                                            <span
                                                                class="px-2 inline-flex text-xs leading-5 font-semibold sm:sm:rounded-full bg-blue-100 text-blue-800">
                                                                Hari Ini
                                                            </span>
                                                        @elseif($day['date']->isFuture())
                                                            <span
                                                                class="px-2 inline-flex text-xs leading-5 font-semibold sm:sm:rounded-full bg-gray-100 text-gray-800">
                                                                -
                                                            </span>
                                                        @elseif(!$day['presence'])
                                                            <span
                                                                class="px-2 inline-flex text-xs leading-5 font-semibold sm:sm:rounded-full bg-red-100 text-red-800">
                                                                Absen
                                                            </span>
                                                        @else
                                                            <span
                                                                class="px-2 inline-flex text-xs leading-5 font-semibold sm:sm:rounded-full 
                                                                {{ $day['presence']->status === 'present' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                                {{ $day['presence']->status === 'present' ? 'Tepat' : 'Telat' }}
                                                            </span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Initialize with server time
            let serverTime = new Date({{ $timestamp }});
            let timeDiff = serverTime - new Date();

            function updateClock() {
                // Use server time + elapsed time since page load
                const now = new Date(Date.now() + timeDiff);

                // Update clock with WITA timezone (using colon separator)
                const clockElement = document.getElementById('clock');
                const timeOptions = {
                    timeZone: 'Asia/Makassar',
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit',
                    hour12: false
                };

                // Format time manually to ensure colon separator
                const formatter = new Intl.DateTimeFormat('id-ID', timeOptions);
                const parts = formatter.formatToParts(now);
                const time = parts
                    .map(p => p.type === 'literal' ? ':' : p.value)
                    .join('')
                    .replace(/\./g, ':');

                clockElement.textContent = time;

                // Update date with WITA timezone (unchanged)
                const dateElement = document.getElementById('date');
                dateElement.textContent = now.toLocaleDateString('id-ID', {
                    timeZone: 'Asia/Makassar',
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });
            }

            // Update immediately and then every second
            updateClock();
            setInterval(updateClock, 1000);
        </script>
    @endpush
@endsection
