@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow rounded-lg">
        <div class="p-4 sm:p-6">
            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
                <div class="flex-1 min-w-0">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-900 truncate">
                        Rekap Kehadiran {{ auth()->user()->is_admin && $user->id !== auth()->id() ? $user->name : '' }}
                    </h2>
                </div>

                <!-- Filters Section -->
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                    <!-- Month/Year Filter -->
                    <form action="{{ route('presence.recap') }}" method="GET" 
                          class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2">
                        @if(request('user_id'))
                            <input type="hidden" name="user_id" value="{{ request('user_id') }}">
                        @endif
                        
                        <select name="month" 
                                class="w-full sm:w-auto pl-3 pr-10 py-2 text-base border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            @foreach(range(1, 12) as $m)
                                <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                                    {{ Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                                </option>
                            @endforeach
                        </select>

                        <select name="year" 
                                class="w-full sm:w-auto pl-3 pr-10 py-2 text-base border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            @foreach(range(date('Y'), date('Y')-5) as $y)
                                <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>
                                    {{ $y }}
                                </option>
                            @endforeach
                        </select>

                        <button type="submit" 
                                class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4v16M8 4v16M15 4v16M21 4v16" />
                            </svg>
                            Filter
                        </button>
                    </form>

                    <!-- Admin User Selection -->
                    @if(auth()->user()->is_admin)
                    <div class="w-full sm:w-auto">
                        <form action="{{ route('presence.recap') }}" method="GET">
                            <select name="user_id" 
                                    onchange="this.form.submit()"
                                    class="w-full block pl-3 pr-10 py-2 text-base border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="">Pilih Karyawan</option>
                                @foreach($users as $u)
                                    <option value="{{ $u->id }}" {{ $user->id === $u->id ? 'selected' : '' }}>
                                        {{ $u->name }} ({{ $u->employee_id }})
                                    </option>
                                @endforeach
                            </select>
                            <input type="hidden" name="month" value="{{ $month }}">
                            <input type="hidden" name="year" value="{{ $year }}">
                        </form>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Tables Section -->
            <div class="mt-8 space-y-8">
                <!-- Presence Table -->
                <div class="overflow-hidden">
                    <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Kehadiran</h3>
                    <div class="-mx-4 sm:-mx-6 lg:-mx-8 overflow-x-auto">
                        <div class="inline-block min-w-full align-middle">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tanggal
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Jam Masuk
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Jam Pulang
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($presences as $presence)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $presence->created_at->translatedFormat('l, d F Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $presence->check_in->format('H:i') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $presence->check_out ? $presence->check_out->format('H:i') : '-' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    {{ $presence->status === 'present' ? 'bg-green-100 text-green-800' : 
                                                       ($presence->status === 'late' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                                    {{ $presence->status === 'present' ? 'Tepat Waktu' : 
                                                       ($presence->status === 'late' ? 'Terlambat' : 'Tidak Hadir') }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                                                Tidak ada data presensi untuk bulan ini
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mt-4 px-4 sm:px-0">
                        {{ $presences->appends(['month' => $month, 'year' => $year])->links() }}
                    </div>
                </div>

                <!-- Leave Requests Table -->
                <div class="overflow-hidden">
                    <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Izin/Cuti</h3>
                    <div class="-mx-4 sm:-mx-6 lg:-mx-8 overflow-x-auto">
                        <div class="inline-block min-w-full align-middle">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tanggal
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Jenis
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Alasan
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($leaveRequests as $leave)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $leave->start_date->translatedFormat('d F Y') }} -
                                                {{ $leave->end_date->translatedFormat('d F Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $leave->type === 'sick' ? 'Sakit' : 
                                                   ($leave->type === 'personal' ? 'Keperluan Pribadi' : 'Lainnya') }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-900">{{ $leave->reason }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    {{ $leave->status === 'approved' ? 'bg-green-100 text-green-800' : 
                                                       ($leave->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                                    {{ $leave->status === 'approved' ? 'Disetujui' : 
                                                       ($leave->status === 'pending' ? 'Menunggu' : 'Ditolak') }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                                                Tidak ada pengajuan izin untuk bulan ini
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mt-4 px-4 sm:px-0">
                        {{ $leaveRequests->appends(['month' => $month, 'year' => $year])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    @media (max-width: 640px) {
        .min-w-full {
            min-width: 640px;
        }
    }
</style>
@endpush
@endsection
