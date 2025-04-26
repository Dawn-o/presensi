@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-lg">
            <div class="p-4 sm:p-6">
                <!-- Header Section -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
                    <div class="flex-1 min-w-0">
                        <div class="flex flex-col space-y-2">
                            <h2 class="text-xl sm:text-2xl font-bold text-gray-900">
                                Rekap Kehadiran
                            </h2>
                            @if (auth()->user()->is_admin && $user->id !== auth()->id())
                                <div class="flex items-center space-x-2">
                                    <span class="text-lg text-gray-600">{{ $user->name }}</span>
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                        {{ $user->employee_id }}
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Filters Section -->
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                        <form action="{{ route('presence.recap') }}" method="GET"
                            class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2">
                            @if (request('user_id'))
                                <input type="hidden" name="user_id" value="{{ request('user_id') }}">
                            @endif
                            <input type="hidden" name="tab" value="{{ request('tab', 'attendance') }}">
                            <select name="month" onchange="this.form.submit()"
                                class="w-full sm:w-auto pl-3 pr-10 py-2 text-base border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                @foreach (range(1, 12) as $m)
                                    <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                                        {{ Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                                    </option>
                                @endforeach
                            </select>

                            <select name="year" onchange="this.form.submit()"
                                class="w-full sm:w-auto pl-3 pr-10 py-2 text-base border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                @foreach (range(date('Y'), date('Y') - 5) as $y)
                                    <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>
                                        {{ $y }}
                                    </option>
                                @endforeach
                            </select>
                        </form>

                        @if (auth()->user()->is_admin)
                            <select name="user_id"
                                onchange="window.location.href='{{ route('presence.recap') }}?user_id=' + this.value + '&month={{ $month }}&year={{ $year }}&tab={{ request('tab', 'attendance') }}'"
                                class="w-full sm:w-auto pl-3 pr-10 py-2 text-base border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="">Pilih Karyawan</option>
                                @foreach ($users as $u)
                                    <option value="{{ $u->id }}"
                                        {{ request('user_id') == $u->id ? 'selected' : '' }}>
                                        {{ $u->name }} ({{ $u->employee_id }})
                                    </option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                </div>

                <!-- Tabs Navigation -->
                <div class="mt-8 border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                        <a href="{{ route('presence.recap', ['tab' => 'attendance', 'month' => $month, 'year' => $year, 'user_id' => request('user_id')]) }}"
                            class="tab-btn whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm cursor-pointer attendance-tab {{ request('tab', 'attendance') === 'attendance' ? 'active-tab' : '' }}">
                            Rekap Kehadiran
                        </a>
                        <a href="{{ route('presence.recap', ['tab' => 'leave', 'month' => $month, 'year' => $year, 'user_id' => request('user_id')]) }}"
                            class="tab-btn whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm cursor-pointer leave-tab {{ request('tab') === 'leave' ? 'active-tab' : '' }}">
                            Riwayat Izin/Cuti
                        </a>
                    </nav>
                </div>

                <!-- Attendance Content -->
                <div id="attendance-content"
                    class="tab-content {{ request('tab', 'attendance') === 'attendance' ? '' : 'hidden' }}">
                    <!-- Calendar Table -->
                    <div class="mt-8 overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Hari
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tanggal
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Jam Masuk
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Jam Pulang
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($monthlyCalendar as $day)
                                    <tr class="{{ $day['date']->isWeekend() ? 'bg-gray-50' : '' }}">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $day['date']->translatedFormat('l') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $day['date']->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $day['presence']?->check_in?->format('H:i') ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $day['presence']?->check_out?->format('H:i') ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($day['date']->isWeekend())
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                    Hari Libur
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
                                                    Tidak Hadir
                                                </span>
                                            @else
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $day['presence']->status === 'present' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                    {{ $day['presence']->status === 'present' ? 'Tepat Waktu' : 'Terlambat' }}
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Leave Content -->
                <div id="leave-content" class="tab-content {{ request('tab') === 'leave' ? '' : 'hidden' }}">
                    <!-- Leave Requests Table -->
                    <div class="mt-8">
                        <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">
                            Riwayat Izin/Cuti
                        </h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tanggal Mulai
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tanggal Selesai
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Jenis
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Keterangan
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($leaveRequests as $leave)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $leave->start_date->translatedFormat('d F Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $leave->end_date->translatedFormat('d F Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $leave->type === 'sick' ? 'Sakit' : 'Cuti' }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-900">
                                                {{ $leave->description }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
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
                                            <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                                Tidak ada data izin/cuti untuk periode ini
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

    @push('styles')
        <style>
            .tab-btn {
                color: #6B7280;
                border-color: transparent;
            }

            .tab-btn:hover {
                color: #4B5563;
                border-color: #E5E7EB;
            }

            .active-tab {
                color: #4F46E5;
                border-color: #4F46E5;
            }

            .hidden {
                display: none;
            }
        </style>
    @endpush
@endsection
