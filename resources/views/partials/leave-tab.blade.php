<div id="leave-content" class="{{ request('tab') === 'leave' ? 'block' : 'hidden' }}">
    <!-- Mobile View -->
    <div class="block sm:hidden">
        <div class="space-y-3">
            @foreach ($leaveRequests as $leave)
                <div class="bg-white sm:rounded-lg overflow-hidden shadow-sm border border-gray-100">
                    <div class="p-4">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <div class="flex items-center mb-2">
                                    <div class="p-1.5 rounded-md {{ $leave->type === 'sick' ? 'bg-red-100' : 'bg-blue-100' }} mr-3">
                                        @if ($leave->type === 'sick')
                                            <x-icons.info class="h-4 w-4 text-red-500" />
                                        @else
                                            <x-icons.calendar-days class="h-4 w-4 text-blue-500" />
                                        @endif
                                    </div>
                                    <span class="font-medium text-gray-900">
                                        {{ $leave->type === 'sick' ? 'Sakit' : ($leave->type === 'personal' ? 'Pribadi' : 'Lainnya') }}
                                    </span>
                                </div>
                                <div class="text-sm text-gray-600 mb-2">{{ $leave->reason }}</div>
                                <div class="flex items-center text-xs text-gray-500">
                                    <span class="font-medium">{{ $leave->start_date->format('d/m/Y') }}</span>
                                    @if ($leave->start_date->format('d/m/y') !== $leave->end_date->format('d/m/y'))
                                        <span class="mx-1.5">→</span>
                                        <span class="font-medium">{{ $leave->end_date->format('d/m/Y') }}</span>
                                    @endif
                                </div>
                            </div>
                            <x-leave-status-badge :status="$leave->status" class="ml-2 px-2.5 py-1" />
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        @if ($leaveRequests->hasPages())
            <div class="mt-6 px-1">
                {{ $leaveRequests->appends(['month' => $month, 'year' => $year, 'user_id' => request('user_id'), 'tab' => 'leave'])->links() }}
            </div>
        @endif
    </div>

    <!-- Desktop Table - Styled like monthly-calendar component -->
    <div class="hidden sm:block mt-4">
        @if ($leaveRequests->isEmpty())
            <div class="bg-gray-50 rounded-lg p-8 text-center">
                <p class="text-gray-500">Belum ada riwayat pengajuan izin</p>
            </div>
        @else
            <div class="overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide border-r border-gray-100">
                                Tanggal
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide border-r border-gray-100">
                                Jenis
                            </th>
                            <th class="hidden sm:table-cell px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide border-r border-gray-100">
                                Alasan
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wide border-gray-100">
                                Status
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($leaveRequests as $leave)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 border-r border-gray-100">
                                    <div>{{ $leave->start_date->format('d/m/Y') }}</div>
                                    @if ($leave->start_date->format('d/m/Y') !== $leave->end_date->format('d/m/Y'))
                                        <div class="text-xs text-gray-500">
                                            s/d {{ $leave->end_date->format('d/m/Y') }}
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 border-r border-gray-100">
                                    <div>{{ $leave->type === 'sick' ? 'Sakit' : ($leave->type === 'personal' ? 'Pribadi' : 'Lainnya') }}</div>
                                </td>
                                <td class="hidden sm:table-cell px-6 py-4 text-sm text-gray-900 border-r border-gray-100">
                                    <div class="max-w-xs break-words">{{ $leave->reason }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="h-2 w-2 mr-2 rounded-full 
                                            {{ $leave->status === 'approved' ? 'bg-green-500' : 
                                              ($leave->status === 'pending' ? 'bg-yellow-500' : 'bg-red-500') }}"></span>
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $leave->status === 'approved' ? 'bg-green-100 text-green-800' : 
                                              ($leave->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                            {{ $leave->status === 'approved' ? 'Disetujui' : ($leave->status === 'pending' ? 'Menunggu' : 'Ditolak') }}
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if ($leaveRequests->hasPages())
                <div class="mt-4">
                    {{ $leaveRequests->appends(['month' => $month, 'year' => $year, 'user_id' => request('user_id'), 'tab' => 'leave'])->links() }}
                </div>
            @endif
        @endif
    </div>
</div>
