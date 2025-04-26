@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto">
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900">
                    Rekap Absensi - {{ Carbon\Carbon::create(null, $month)->translatedFormat('F') }} {{ $year }}
                </h3>
            </div>

            <div class="px-4 py-5 sm:p-6">
                <form class="mb-6">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                        <div>
                            <select name="month"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}" {{ $i == $month ? 'selected' : '' }}>
                                        {{ Carbon\Carbon::create(null, $i)->translatedFormat('F') }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div>
                            <select name="year"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                @for ($i = 2023; $i <= date('Y'); $i++)
                                    <option value="{{ $i }}" {{ $i == $year ? 'selected' : '' }}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div>
                            <button type="submit"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Tampilkan
                            </button>
                        </div>
                    </div>
                </form>

                <div class="space-y-8">
                    <div>
                        <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Kehadiran</h3>
                        <div class="overflow-x-auto">
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
                            <div class="mt-4">
                                {{ $presences->appends(['month' => $month, 'year' => $year])->links() }}
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Izin/Cuti</h3>
                        <div class="overflow-x-auto">
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
                            <div class="mt-4">
                                {{ $leaveRequests->appends(['month' => $month, 'year' => $year])->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
