@props(['calendar'])

<div class="bg-white shadow sm:rounded-lg overflow-hidden">
    <div class="p-4 sm:p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">
            Kehadiran Bulan {{ now()->translatedFormat('F Y') }}
        </h3>

        <!-- Mobile Calendar View -->
        <div class="block sm:hidden">
            <div class="space-y-2">
                @foreach ($calendar as $day)
                    <div class="bg-white border border-gray-200 overflow-hidden">
                        <div class="flex items-center justify-between px-4 py-3 bg-gray-50 border-b border-gray-200">
                            <div class="flex items-center">
                                @if ($day['date']->isWeekend())
                                    <span class="h-3 w-3 mr-2 rounded-full bg-gray-300"></span>
                                @elseif($day['date']->isToday())
                                    <span class="h-3 w-3 mr-2 rounded-full bg-blue-500"></span>
                                @elseif($day['date']->isFuture())
                                    <span class="h-3 w-3 mr-2 rounded-full bg-gray-300"></span>
                                @elseif(!$day['presence'])
                                    <span class="h-3 w-3 mr-2 rounded-full bg-red-500"></span>
                                @elseif($day['presence']->status === 'present')
                                    <span class="h-3 w-3 mr-2 rounded-full bg-green-500"></span>
                                @else
                                    <span class="h-3 w-3 mr-2 rounded-full bg-yellow-500"></span>
                                @endif
                                <div>
                                    <div class="text-base font-medium text-gray-900">
                                        {{ $day['date']->format('d') }} {{ $day['date']->translatedFormat('M') }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ $day['date']->translatedFormat('l') }}
                                    </div>
                                </div>
                            </div>
                            <div>
                                @include('partials.attendance-status-badge', ['day' => $day])
                            </div>
                        </div>

                        @if (!$day['date']->isWeekend() && !$day['date']->isFuture())
                            <div class="px-4 py-3">
                                @if ($day['presence'])
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <div class="text-xs font-medium text-gray-500 mb-1">Jam Masuk</div>
                                            <div
                                                class="text-sm font-medium {{ $day['presence']->check_in ? 'text-gray-900' : 'text-gray-400' }}">
                                                {{ $day['presence']->check_in?->format('H:i') ?? '-' }}
                                            </div>
                                        </div>
                                        <div>
                                            <div class="text-xs font-medium text-gray-500 mb-1">Jam Pulang</div>
                                            <div
                                                class="text-sm font-medium {{ $day['presence']->check_out ? 'text-gray-900' : 'text-gray-400' }}">
                                                {{ $day['presence']->check_out?->format('H:i') ?? '-' }}
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="text-sm text-center text-gray-500 py-1">
                                        @if ($day['date']->isFuture())
                                            Belum waktunya
                                        @else
                                            Tidak ada data presensi
                                        @endif
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="px-4 py-3 text-sm text-center text-gray-500">
                                {{ $day['date']->isWeekend() ? 'Akhir pekan' : 'Belum waktunya' }}
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Desktop Table View - Improved Design -->
        <div class="hidden sm:block">
            <div class="overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th scope="col"
                                class="hidden sm:table-cell px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-r border-gray-100">
                                Hari
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-r border-gray-100">
                                Tanggal
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-r border-gray-100">
                                Jam
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b border-r border-gray-100">
                                Status
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($calendar as $day)
                            <tr class="{{ $day['date']->isWeekend() ? 'bg-gray-50' : '' }}">
                                <td
                                    class="hidden sm:table-cell px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-r border-gray-100">
                                    {{ $day['date']->translatedFormat('l') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 border-r border-gray-100">
                                    <div>{{ $day['date']->format('d/m/Y') }}</div>
                                    <div class="sm:hidden text-xs text-gray-500">
                                        {{ $day['date']->translatedFormat('l') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 border-r border-gray-100">
                                    <div class="flex items-center">
                                        <span class="text-xs font-medium text-gray-500 w-6">M:</span>
                                        <span
                                            class="ml-1 {{ $day['presence']?->check_in ? 'font-medium' : 'text-gray-500' }}">
                                            {{ $day['presence']?->check_in?->format('H:i') ?? '-' }}
                                        </span>
                                    </div>
                                    <div class="flex items-center mt-1">
                                        <span class="text-xs font-medium text-gray-500 w-6">P:</span>
                                        <span
                                            class="ml-1 {{ $day['presence']?->check_out ? 'font-medium' : 'text-gray-500' }}">
                                            {{ $day['presence']?->check_out?->format('H:i') ?? '-' }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <div class="flex items-center">
                                        @if ($day['date']->isWeekend())
                                            <span class="h-2 w-2 mr-2 rounded-full bg-gray-300"></span>
                                        @elseif($day['date']->isToday())
                                            <span class="h-2 w-2 mr-2 rounded-full bg-blue-500"></span>
                                        @elseif($day['date']->isFuture())
                                            <span class="h-2 w-2 mr-2 rounded-full bg-gray-300"></span>
                                        @elseif(!$day['presence'])
                                            <span class="h-2 w-2 mr-2 rounded-full bg-red-500"></span>
                                        @elseif($day['presence']->status === 'present')
                                            <span class="h-2 w-2 mr-2 rounded-full bg-green-500"></span>
                                        @else
                                            <span class="h-2 w-2 mr-2 rounded-full bg-yellow-500"></span>
                                        @endif
                                        @include('partials.attendance-status-badge', ['day' => $day])
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
