@if ($pendingLeaves->isEmpty())
    <div class="bg-gray-50 rounded-lg p-8 text-center border border-gray-200">
        <x-icons.clipboard-check class="h-12 w-12 text-gray-400 mx-auto mb-4" />
        <p class="text-gray-600 font-medium">Tidak ada pengajuan yang menunggu</p>
        <p class="text-gray-500 text-sm mt-1">Semua pengajuan izin telah diproses</p>
    </div>
@else
    <table class="hidden sm:table min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th
                    class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-100">
                    Nama
                </th>
                <th
                    class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-100">
                    Tanggal
                </th>
                <th
                    class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-100">
                    Jenis
                </th>
                <th
                    class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-r border-gray-100">
                    Alasan
                </th>
                <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Aksi
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($pendingLeaves as $leave)
                <tr>
                    <td class="px-3 sm:px-6 py-4 text-sm font-medium text-gray-900 border-r border-gray-100">
                        {{ $leave->user->name }}
                    </td>
                    <td class="px-3 sm:px-6 py-4 text-sm text-gray-900 border-r border-gray-100">
                        {{ $leave->start_date->format('d/m/Y') }}
                        @if ($leave->start_date->format('d/m/Y') !== $leave->end_date->format('d/m/Y'))
                            - {{ $leave->end_date->format('d/m/Y') }}
                        @endif
                    </td>
                    <td class="px-3 sm:px-6 py-4 text-sm text-gray-900 border-r border-gray-100">
                        {{ $leave->type === 'sick' ? 'Sakit' : ($leave->type === 'personal' ? 'Pribadi' : 'Lainnya') }}
                    </td>
                    <td class="px-3 sm:px-6 py-4 text-sm text-gray-900 border-r border-gray-100">
                        {{ $leave->reason }}
                    </td>
                    <td class="px-3 sm:px-6 py-4 text-sm text-gray-900">
                        <x-leave-action-buttons :leave="$leave" />
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
