@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-4 sm:py-6 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Daftar Pengajuan Izin Menunggu</h3>
            </div>

            @if (session('success'))
                <div class="mx-4 mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 sm:rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <div class="inline-block min-w-full align-middle">
                    <!-- Mobile View -->
                    <div class="sm:hidden">
                        @forelse($pendingLeaves as $leave)
                            <div class="px-4 py-3 border-b border-gray-200">
                                <div class="space-y-2">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">{{ $leave->user->name }}</p>
                                            <p class="text-xs text-gray-500">
                                                {{ $leave->start_date->format('d/m/Y') }}
                                                @if($leave->start_date->format('d/m/Y') !== $leave->end_date->format('d/m/Y'))
                                                    - {{ $leave->end_date->format('d/m/Y') }}
                                                @endif
                                            </p>
                                        </div>
                                        <span class="inline-flex items-center px-2.5 py-0.5 sm:rounded-full text-xs font-medium 
                                            {{ $leave->type === 'sick' ? 'bg-blue-100 text-blue-800' : 
                                               ($leave->type === 'personal' ? 'bg-yellow-100 text-yellow-800' : 
                                                'bg-gray-100 text-gray-800') }}">
                                            {{ $leave->type === 'sick' ? 'Sakit' : 
                                               ($leave->type === 'personal' ? 'Pribadi' : 'Lainnya') }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-600">{{ $leave->reason }}</p>
                                    <div class="flex space-x-2 pt-2">
                                        <form action="{{ route('leaves.approve', $leave) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="bg-green-100 text-green-800 px-4 py-1.5 sm:rounded-full text-sm font-medium
                                                hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-green-500">
                                                Setujui
                                            </button>
                                        </form>
                                        <form action="{{ route('leaves.reject', $leave) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="bg-red-100 text-red-800 px-4 py-1.5 sm:rounded-full text-sm font-medium
                                                hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-red-500">
                                                Tolak
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="px-4 py-6 text-center text-sm text-gray-500">
                                Tidak ada pengajuan izin yang menunggu persetujuan.
                            </div>
                        @endforelse
                    </div>

                    <!-- Desktop View -->
                    <table class="hidden sm:table min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama
                                </th>
                                <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tanggal
                                </th>
                                <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jenis
                                </th>
                                <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Alasan
                                </th>
                                <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($pendingLeaves as $leave)
                                <tr>
                                    <td class="px-3 sm:px-6 py-4 text-sm font-medium text-gray-900">
                                        {{ $leave->user->name }}
                                    </td>
                                    <td class="px-3 sm:px-6 py-4 text-sm text-gray-900">
                                        {{ $leave->start_date->format('d/m/Y') }}
                                        @if($leave->start_date->format('d/m/Y') !== $leave->end_date->format('d/m/Y'))
                                            - {{ $leave->end_date->format('d/m/Y') }}
                                        @endif
                                    </td>
                                    <td class="px-3 sm:px-6 py-4 text-sm text-gray-900">
                                        {{ $leave->type === 'sick' ? 'Sakit' : ($leave->type === 'personal' ? 'Pribadi' : 'Lainnya') }}
                                    </td>
                                    <td class="px-3 sm:px-6 py-4 text-sm text-gray-900">
                                        {{ $leave->reason }}
                                    </td>
                                    <td class="px-3 sm:px-6 py-4 text-sm text-gray-900">
                                        <div class="flex space-x-2">
                                            <form action="{{ route('leaves.approve', $leave) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="bg-green-100 text-green-800 px-3 py-1 sm:rounded-full text-xs font-medium
                                                    hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-green-500">
                                                    Setujui
                                                </button>
                                            </form>
                                            <form action="{{ route('leaves.reject', $leave) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="bg-red-100 text-red-800 px-3 py-1 sm:rounded-full text-xs font-medium
                                                    hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-red-500">
                                                    Tolak
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-3 sm:px-6 py-4 text-center text-sm text-gray-500">
                                        Tidak ada pengajuan izin yang menunggu persetujuan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="px-4 py-3 border-t border-gray-200">
                {{ $pendingLeaves->links() }}
            </div>
        </div>
    </div>
@endsection
