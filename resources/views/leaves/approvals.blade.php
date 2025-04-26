@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-5 sm:px-6 bg-white shadow-sm rounded-lg">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Daftar Pengajuan Izin Menunggu</h3>

            @if (session('success'))
                <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mt-6 overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Alasan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($pendingLeaves as $leave)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $leave->user->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $leave->start_date->format('d/m/Y') }} - {{ $leave->end_date->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $leave->type === 'sick' ? 'Sakit' : ($leave->type === 'personal' ? 'Keperluan Pribadi' : 'Lainnya') }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    {{ $leave->reason }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <div class="flex space-x-2">
                                        <form action="{{ route('leaves.approve', $leave) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold
                                               hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-green-500">
                                                Setujui
                                            </button>
                                        </form>
                                        <form action="{{ route('leaves.reject', $leave) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs font-semibold
                                               hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-red-500">
                                                Tolak
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                    Tidak ada pengajuan izin yang menunggu persetujuan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $pendingLeaves->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
