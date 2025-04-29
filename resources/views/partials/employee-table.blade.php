<div class="bg-white shadow-sm overflow-hidden rounded-lg">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th scope="col"
                        class="px-6 py-3.5 text-left text-xs font-medium text-gray-500 uppercase tracking-wide border-r border-gray-100">
                        NIP/NIK
                    </th>
                    <th scope="col"
                        class="px-6 py-3.5 text-left text-xs font-medium text-gray-500 uppercase tracking-wide border-r border-gray-100">
                        Nama
                    </th>
                    <th scope="col"
                        class="px-6 py-3.5 text-left text-xs font-medium text-gray-500 uppercase tracking-wide border-r border-gray-100">
                        Jam Masuk
                    </th>
                    <th scope="col"
                        class="px-6 py-3.5 text-left text-xs font-medium text-gray-500 uppercase tracking-wide border-r border-gray-100">
                        Jam Pulang
                    </th>
                    <th scope="col"
                        class="px-6 py-3.5 text-left text-xs font-medium text-gray-500 uppercase tracking-wide border-r border-gray-100">
                        Status
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($employees as $employee)
                    <tr>
                        <td
                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-r border-gray-100">
                            {{ $employee->employee_id }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900 border-r border-gray-100">
                            <div class="font-medium max-w-xs break-words">{{ $employee->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm border-r border-gray-100">
                            @if ($employee->presences->first()?->check_in)
                                <div class="flex items-center">
                                    <div class="mr-2 h-2 w-2 rounded-full bg-green-500"></div>
                                    <span class="font-medium">
                                        {{ $employee->presences->first()->check_in->format('H:i') }}
                                    </span>
                                </div>
                            @else
                                <span class="inline-flex items-center text-gray-400">
                                    <div class="mr-2 h-2 w-2 rounded-full bg-gray-300"></div>
                                    -
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm border-r border-gray-100">
                            @if ($employee->presences->first()?->check_out)
                                <div class="flex items-center">
                                    <div class="mr-2 h-2 w-2 rounded-full bg-blue-500"></div>
                                    <span class="font-medium">
                                        {{ $employee->presences->first()->check_out->format('H:i') }}
                                    </span>
                                </div>
                            @else
                                <span class="inline-flex items-center text-gray-400">
                                    <div class="mr-2 h-2 w-2 rounded-full bg-gray-300"></div>
                                    -
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm border-r border-gray-100">
                            <x-employee-status-badge :presence="$employee->presences->first()" />
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
