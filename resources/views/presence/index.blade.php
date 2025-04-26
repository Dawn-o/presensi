@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-4 sm:py-6 px-4 sm:px-6 lg:px-8">
        <!-- Time and Presence Grid -->
        <div class="md:grid md:grid-cols-3 md:gap-6 space-y-4 md:space-y-0">
            <!-- Time and Date Display -->
            <div class="md:col-span-1">
                <div class="bg-white shadow rounded-lg p-4 sm:p-6">
                    <div class="text-center">
                        <div id="clock" class="text-3xl sm:text-4xl font-bold text-gray-800"></div>
                        <div id="date" class="mt-2 text-base sm:text-lg text-gray-600"></div>
                    </div>
                </div>
            </div>

            <!-- Presence Card -->
            <div class="md:col-span-2">
                <div class="bg-white shadow rounded-lg">
                    <div class="p-4 sm:p-6">
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Absensi Hari Ini</h3>
                            @if(auth()->user()->is_admin)
                                <a href="{{ route('employees.index') }}"
                                    class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <svg class="sm:-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    Daftar Karyawan
                                </a>
                            @endif
                        </div>

                        <!-- Status and Check In/Out Section -->
                        <div class="mt-6">
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between space-y-4 sm:space-y-0">
                                    <div class="space-y-1">
                                        <p class="text-sm font-medium text-gray-600">Status Kehadiran</p>
                                        @if ($today)
                                            <span
                                                class="px-3 py-1 text-sm rounded-full 
                                            {{ $today->status === 'present'
                                                ? 'bg-green-100 text-green-800'
                                                : ($today->status === 'late'
                                                    ? 'bg-yellow-100 text-yellow-800'
                                                    : 'bg-red-100 text-red-800') }}">
                                                {{ $today->status === 'present' ? 'Tepat Waktu' : ($today->status === 'late' ? 'Terlambat' : 'Tidak Hadir') }}
                                            </span>
                                        @else
                                            <span class="px-3 py-1 text-sm rounded-full bg-gray-100 text-gray-800">
                                                Belum Absen
                                            </span>
                                        @endif
                                    </div>
                                    @if (!$today || !$today->check_out)
                                        <form action="{{ route('presence.store') }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white {{ $today && $today->check_in ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }} transition-colors duration-200">
                                                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                                </svg>
                                                {{ $today && $today->check_in ? 'Presensi Pulang' : 'Presensi Masuk' }}
                                            </button>
                                        </form>
                                    @endif
                                </div>

                                @if ($today)
                                    <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <div class="bg-white p-4 rounded-lg shadow-sm">
                                            <p class="text-sm font-medium text-gray-500">Jam Masuk</p>
                                            <p class="mt-1 text-xl font-semibold text-gray-900">
                                                {{ $today->check_in ? $today->check_in->format('H:i') : '-' }}
                                            </p>
                                        </div>
                                        <div class="bg-white p-4 rounded-lg shadow-sm">
                                            <p class="text-sm font-medium text-gray-500">Jam Pulang</p>
                                            <p class="mt-1 text-xl font-semibold text-gray-900">
                                                {{ $today->check_out ? $today->check_out->format('H:i') : '-' }}
                                            </p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Monthly Attendance Table -->
        <div class="mt-8">
            <div class="bg-white shadow rounded-lg">
                <div class="p-4 sm:p-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">
                        Kehadiran Bulan {{ now()->translatedFormat('F Y') }}
                    </h3>
                    <div class="overflow-hidden">
                        <div class="w-full">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="hidden sm:table-cell px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Hari
                                        </th>
                                        <th scope="col" class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tanggal
                                        </th>
                                        <th scope="col" class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Jam
                                        </th>
                                        <th scope="col" class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($monthlyCalendar as $day)
                                        <tr class="{{ $day['date']->isWeekend() ? 'bg-gray-50' : '' }}">
                                            <td class="hidden sm:table-cell px-3 sm:px-6 py-4 whitespace-nowrap text-xs sm:text-sm text-gray-900">
                                                {{ $day['date']->translatedFormat('l') }}
                                            </td>
                                            <td class="px-3 sm:px-6 py-4 text-xs sm:text-sm text-gray-900">
                                                <div>{{ $day['date']->format('d/m/y') }}</div>
                                                <div class="sm:hidden text-gray-500">{{ $day['date']->translatedFormat('l') }}</div>
                                            </td>
                                            <td class="px-3 sm:px-6 py-4 text-xs sm:text-sm text-gray-900">
                                                <div>M: {{ $day['presence']?->check_in?->format('H:i') ?? '-' }}</div>
                                                <div>P: {{ $day['presence']?->check_out?->format('H:i') ?? '-' }}</div>
                                            </td>
                                            <td class="px-3 sm:px-6 py-4">
                                                @if ($day['date']->isWeekend())
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                        Libur
                                                    </span>
                                                @elseif($day['date']->isToday())
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                        Hari Ini
                                                    </span>
                                                @elseif($day['date']->isFuture())
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                        -
                                                    </span>
                                                @elseif(!$day['presence'])
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                        Absen
                                                    </span>
                                                @else
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
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

    @push('scripts')
        <script>
            function updateClock() {
                const now = new Date();
                const clock = document.getElementById('clock');
                const date = document.getElementById('date');

                // Update time
                clock.textContent = now.toLocaleTimeString('id-ID', {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit',
                    hour12: false
                });

                // Update date
                const options = {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                };
                date.textContent = now.toLocaleDateString('id-ID', options);
            }

            // Update clock every second
            updateClock();
            setInterval(updateClock, 1000);
        </script>
    @endpush
@endsection
