@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-4 sm:py-6 px-4 sm:px-6 lg:px-8">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
        <h2 class="text-xl sm:text-2xl font-semibold text-gray-900">Daftar Karyawan</h2>
        <div class="flex flex-col sm:flex-row w-full sm:w-auto space-y-2 sm:space-y-0 sm:space-x-4">
            <!-- Recap Button -->
            <a href="{{ route('presence.recap') }}" 
               class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Rekap Kehadiran
            </a>

            <!-- Presence Page Button -->
            <a href="{{ route('presence.index') }}" 
               class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Halaman Presensi
            </a>
        </div>
    </div>
    
    <!-- Mobile View -->
    <div class="mt-6 sm:hidden">
        @foreach($employees as $employee)
            <div class="bg-white shadow rounded-lg mb-4 p-4">
                <div class="flex justify-between items-start space-x-2">
                    <div class="min-w-0 flex-1"> <!-- Added min-w-0 and flex-1 -->
                        <h3 class="text-sm font-medium text-gray-900 break-words">{{ $employee->name }}</h3>
                        <p class="text-xs text-gray-500 mt-1">{{ $employee->employee_id }}</p>
                    </div>
                    <div class="flex-shrink-0"> <!-- Added flex-shrink-0 -->
                        @if($employee->presences->first())
                            <span class="whitespace-nowrap px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $employee->presences->first()->status === 'present' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $employee->presences->first()->status === 'present' ? 'Tepat Waktu' : 'Terlambat' }}
                            </span>
                        @else
                            <span class="whitespace-nowrap px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                Belum Hadir
                            </span>
                        @endif
                    </div>
                </div>
                <div class="mt-3 grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-500">Jam Masuk</p>
                        <p class="font-medium">{{ $employee->presences->first()?->check_in?->format('H:i') ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Jam Pulang</p>
                        <p class="font-medium">{{ $employee->presences->first()?->check_out?->format('H:i') ?? '-' }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Desktop View -->
    <div class="hidden sm:block mt-8">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            NIP/NIK
                        </th>
                        <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nama
                        </th>
                        <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Jam Masuk
                        </th>
                        <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Jam Pulang
                        </th>
                        <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($employees as $employee)
                        <tr>
                            <td class="px-4 sm:px-6 py-4 text-sm text-gray-900">
                                {{ $employee->employee_id }}
                            </td>
                            <td class="px-4 sm:px-6 py-4 text-sm text-gray-900">
                                <div class="max-w-xs break-words">{{ $employee->name }}</div>
                            </td>
                            <td class="px-4 sm:px-6 py-4 text-sm text-gray-900">
                                {{ $employee->presences->first()?->check_in?->format('H:i') ?? '-' }}
                            </td>
                            <td class="px-4 sm:px-6 py-4 text-sm text-gray-900">
                                {{ $employee->presences->first()?->check_out?->format('H:i') ?? '-' }}
                            </td>
                            <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                @if($employee->presences->first())
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $employee->presences->first()->status === 'present' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ $employee->presences->first()->status === 'present' ? 'Tepat Waktu' : 'Terlambat' }}
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Belum Hadir
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
@endsection