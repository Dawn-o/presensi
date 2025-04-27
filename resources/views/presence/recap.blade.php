@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-4 sm:py-6 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-lg">
            <div class="p-4 sm:p-6">
                <!-- Header Section -->
                <div class="flex flex-col space-y-4">
                    <div class="flex-1 min-w-0">
                        <h2 class="text-xl sm:text-2xl font-bold text-gray-900">
                            Rekap Kehadiran
                        </h2>
                        @if (auth()->user()->is_admin && $user->id !== auth()->id())
                            <div class="mt-2 flex flex-wrap items-center gap-2">
                                <span class="text-base sm:text-lg text-gray-600 truncate">{{ $user->name }}</span>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                    {{ $user->employee_id }}
                                </span>
                            </div>
                        @endif
                    </div>

                    <!-- Filters Section -->
                    <div class="flex flex-col space-y-3">

                        @if (auth()->user()->is_admin)
                            <div class="relative">
                                <select name="user_id"
                                    onchange="window.location.href='{{ route('presence.recap') }}?user_id=' + this.value + '&month={{ $month }}&year={{ $year }}&tab={{ request('tab', 'attendance') }}'"
                                    class="appearance-none w-full pl-3 pr-10 py-2 text-sm border border-gray-300 bg-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">Pilih Karyawan</option>
                                    @foreach ($users as $u)
                                        <option value="{{ $u->id }}"
                                            {{ request('user_id') == $u->id ? 'selected' : '' }}>
                                            {{ $u->name }} ({{ $u->employee_id }})
                                        </option>
                                    @endforeach
                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        @endif

                        <form action="{{ route('presence.recap') }}" method="GET"
                            class="grid grid-cols-2 gap-2 sm:flex sm:flex-row sm:gap-4">
                            @if (request('user_id'))
                                <input type="hidden" name="user_id" value="{{ request('user_id') }}">
                            @endif
                            <input type="hidden" name="tab" value="{{ request('tab', 'attendance') }}">

                            <div class="relative">
                                <select name="month" onchange="this.form.submit()"
                                    class="appearance-none w-full pl-3 pr-10 py-2 text-sm border border-gray-300 bg-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    @foreach (range(1, 12) as $m)
                                        <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                                            {{ Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                                        </option>
                                    @endforeach
                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>

                            <div class="relative">
                                <select name="year" onchange="this.form.submit()"
                                    class="appearance-none w-full pl-3 pr-10 py-2 text-sm border border-gray-300 bg-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    @foreach (range(date('Y'), date('Y') - 5) as $y)
                                        <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>
                                            {{ $y }}
                                        </option>
                                    @endforeach
                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Tabs Navigation -->
                <div class="mt-6 border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8 overflow-x-auto" aria-label="Tabs">
                        <a href="{{ route('presence.recap', ['tab' => 'attendance', 'month' => $month, 'year' => $year, 'user_id' => request('user_id')]) }}"
                            class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm hover:text-gray-700 hover:border-gray-300
                            {{ request('tab', 'attendance') === 'attendance'
                                ? 'border-indigo-500 text-indigo-600'
                                : 'border-transparent text-gray-500' }}">
                            Rekap Kehadiran
                        </a>
                        <a href="{{ route('presence.recap', ['tab' => 'leave', 'month' => $month, 'year' => $year, 'user_id' => request('user_id')]) }}"
                            class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm hover:text-gray-700 hover:border-gray-300
                            {{ request('tab') === 'leave' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500' }}">
                            Riwayat Izin/Cuti
                        </a>
                    </nav>
                </div>

                <!-- Content Section -->
                <div class="mt-6">
                    <!-- Attendance Content -->
                    <div id="attendance-content"
                        class="{{ request('tab', 'attendance') === 'attendance' ? 'block' : 'hidden' }}">
                        <!-- Mobile View -->
                        <div class="block sm:hidden">
                            <div class="space-y-3">
                                @foreach ($monthlyCalendar as $day)
                                    <div class="bg-gray-50 rounded-lg p-3">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <div class="font-medium text-gray-900">
                                                    {{ $day['date']->translatedFormat('l') }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ $day['date']->format('d/m/Y') }}
                                                </div>
                                                @if (!$day['date']->isWeekend() && !$day['date']->isFuture() && $day['presence'])
                                                    <div class="mt-2 grid grid-cols-2 gap-2 text-sm text-gray-600">
                                                        <div>M: {{ $day['presence']->check_in?->format('H:i') ?? '-' }}
                                                        </div>
                                                        <div>P: {{ $day['presence']->check_out?->format('H:i') ?? '-' }}
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                @if ($day['date']->isWeekend())
                                                    <span
                                                        class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Libur</span>
                                                @elseif($day['date']->isToday())
                                                    <span
                                                        class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Hari
                                                        Ini</span>
                                                @elseif($day['date']->isFuture())
                                                    <span
                                                        class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">-</span>
                                                @elseif(!$day['presence'])
                                                    <span
                                                        class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Absen</span>
                                                @else
                                                    <span
                                                        class="px-2 py-1 text-xs font-semibold rounded-full 
                                                        {{ $day['presence']->status === 'present' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                        {{ $day['presence']->status === 'present' ? 'Tepat' : 'Telat' }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Desktop View -->
                        <div class="hidden sm:block">
                            <!-- Calendar Table -->
                            <div class="mt-8 overflow-x-auto">
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
                                                        {{ $day['date']->translatedFormat('l') }}
                                                    </div>
                                                </td>
                                                <td class="px-3 sm:px-6 py-4 text-xs sm:text-sm text-gray-900">
                                                    <div>M: {{ $day['presence']?->check_in?->format('H:i') ?? '-' }}</div>
                                                    <div>P: {{ $day['presence']?->check_out?->format('H:i') ?? '-' }}</div>
                                                </td>
                                                <td class="px-3 sm:px-6 py-4">
                                                    @if ($day['date']->isWeekend())
                                                        <span
                                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                            Libur
                                                        </span>
                                                    @elseif($day['date']->isToday())
                                                        <span
                                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                            Hari Ini
                                                        </span>
                                                    @elseif($day['date']->isFuture())
                                                        <span
                                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                            -
                                                        </span>
                                                    @elseif(!$day['presence'])
                                                        <span
                                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                            Absen
                                                        </span>
                                                    @else
                                                        <span
                                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
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

                    <!-- Leave Content -->
                    <div id="leave-content" class="{{ request('tab') === 'leave' ? 'block' : 'hidden' }}">
                        <!-- Leave Requests Table -->
                        <div class="mt-8">
                            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">
                                Riwayat Izin/Cuti
                            </h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th
                                                class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                Tanggal
                                            </th>
                                            <th
                                                class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                Jenis
                                            </th>
                                            <th
                                                class="hidden sm:table-cell px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                Alasan
                                            </th>
                                            <th
                                                class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                                Status
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse ($leaveRequests as $leave)
                                            <tr>
                                                <td class="px-3 sm:px-6 py-4">
                                                    <div class="text-sm text-gray-900">
                                                        {{ $leave->start_date->format('d/m/y') }}
                                                    </div>
                                                    @if ($leave->start_date->format('d/m/y') !== $leave->end_date->format('d/m/y'))
                                                        <div class="text-xs text-gray-500">
                                                            s/d {{ $leave->end_date->format('d/m/y') }}
                                                        </div>
                                                    @endif
                                                </td>
                                                <td class="px-3 sm:px-6 py-4 text-sm text-gray-900">
                                                    {{ $leave->type === 'sick' ? 'Sakit' : ($leave->type === 'personal' ? 'Pribadi' : 'Lainnya') }}
                                                    <div class="sm:hidden text-xs text-gray-500 mt-1">
                                                        {{ \Str::limit($leave->reason, 50) }}
                                                    </div>
                                                </td>
                                                <td class="hidden sm:table-cell px-3 sm:px-6 py-4 text-sm text-gray-900">
                                                    {{ $leave->reason }}
                                                </td>
                                                <td class="px-3 sm:px-6 py-4">
                                                    <span
                                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                        {{ $leave->status === 'approved'
                                                            ? 'bg-green-100 text-green-800'
                                                            : ($leave->status === 'pending'
                                                                ? 'bg-yellow-100 text-yellow-800'
                                                                : 'bg-red-100 text-red-800') }}">
                                                        {{ $leave->status === 'approved' ? 'Disetujui' : ($leave->status === 'pending' ? 'Menunggu' : 'Ditolak') }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4"
                                                    class="px-3 sm:px-6 py-4 text-center text-sm text-gray-500">
                                                    Belum ada riwayat pengajuan izin
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            @if ($leaveRequests->hasPages())
                                <div class="mt-4 px-4 sm:px-0">
                                    {{ $leaveRequests->appends(['month' => $month, 'year' => $year, 'user_id' => request('user_id')])->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            /* Hide scrollbar for Chrome, Safari and Opera */
            nav::-webkit-scrollbar {
                display: none;
            }

            /* Hide scrollbar for IE, Edge and Firefox */
            nav {
                -ms-overflow-style: none;
                /* IE and Edge */
                scrollbar-width: none;
                /* Firefox */
            }
        </style>
    @endpush
@endsection
