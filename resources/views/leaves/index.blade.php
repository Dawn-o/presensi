@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-6">
        <!-- Form Section -->
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <!-- Form Header -->
            <div class="md:col-span-1">
                <div class="px-0 sm:px-4 mb-4 md:mb-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Pengajuan Izin</h3>
                    <p class="mt-1 text-sm text-gray-600">
                        Silakan isi form pengajuan izin dengan informasi yang lengkap.
                    </p>
                </div>
            </div>

            <!-- Form Content -->
            <div class="md:col-span-2">
                <form action="{{ route('leaves.store') }}" method="POST">
                    @csrf
                    <div class="shadow sm:rounded-md sm:overflow-hidden">
                        <div class="px-4 py-5 bg-white space-y-4 sm:space-y-6 sm:p-6">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                                <!-- Date Inputs -->
                                <div class="col-span-1">
                                    <label for="start_date" class="block text-sm font-medium text-gray-700">
                                        Tanggal Mulai
                                    </label>
                                    <input type="date" name="start_date" id="start_date"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        required onchange="validateDates()">
                                </div>

                                <div class="col-span-1">
                                    <label for="end_date" class="block text-sm font-medium text-gray-700">
                                        Tanggal Selesai
                                    </label>
                                    <input type="date" name="end_date" id="end_date"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        required onchange="validateDates()">
                                    <p id="dateError" class="mt-1 text-sm text-red-600 hidden">
                                        Tanggal selesai tidak boleh lebih awal dari tanggal mulai
                                    </p>
                                </div>

                                <!-- Type Select -->
                                <div class="col-span-1 sm:col-span-2">
                                    <label for="type" class="block text-sm font-medium text-gray-700">
                                        Jenis Izin
                                    </label>
                                    <div class="relative mt-1">
                                        <select id="type" name="type"
                                            class="appearance-none block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm pr-10"
                                            required>
                                            <option value="">Pilih jenis izin</option>
                                            <option value="sick">Sakit</option>
                                            <option value="personal">Keperluan Pribadi</option>
                                            <option value="other">Lainnya</option>
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- Reason Textarea -->
                                <div class="col-span-1 sm:col-span-2">
                                    <label for="reason" class="block text-sm font-medium text-gray-700">
                                        Alasan
                                    </label>
                                    <textarea id="reason" name="reason" rows="3"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        required placeholder="Jelaskan alasan pengajuan izin Anda"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 sm:px-6">
                            <button type="submit"
                                class="w-full sm:w-auto inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Ajukan Izin
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- History Table Section -->
        <div class="mt-8">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Riwayat Pengajuan Izin
                    </h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Tanggal
                                </th>
                                <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Jenis
                                </th>
                                <th
                                    class="hidden sm:table-cell px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Alasan
                                </th>
                                <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($leaves as $leave)
                                <tr>
                                    <td class="px-3 sm:px-6 py-4">
                                        <div class="text-sm text-gray-900">
                                            {{ $leave->start_date->format('d/m/y') }}
                                        </div>
                                        @if ($leave->start_date->format('d/m/y') !== $leave->end_date->format('d/m/y'))
                                            <div class="text-xs text-gray-500">
                                                s/d {{ $leave->end_date->format('d/m/y') }}
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-3 sm:px-6 py-4 text-sm text-gray-900">
                                        {{ $leave->type === 'sick' ? 'Sakit' : ($leave->type === 'personal' ? 'Pribadi' : 'Lainnya') }}
                                        <div class="sm:hidden text-xs text-gray-500 mt-1">
                                            {{ \Str::limit($leave->reason, 50) }}
                                        </div>
                                    </td>
                                    <td class="hidden sm:table-cell px-3 sm:px-6 py-4 text-sm text-gray-900">
                                        {{ $leave->reason }}
                                    </td>
                                    <td class="px-3 sm:px-6 py-4">
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
                                    <td colspan="4" class="px-3 sm:px-6 py-4 text-center text-sm text-gray-500">
                                        Belum ada riwayat pengajuan izin
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function validateDates() {
                const startDate = document.getElementById('start_date').value;
                const endDate = document.getElementById('end_date').value;
                const submitButton = document.querySelector('button[type="submit"]');
                const errorMessage = document.getElementById('dateError');

                if (startDate && endDate) {
                    if (new Date(endDate) < new Date(startDate)) {
                        submitButton.disabled = true;
                        errorMessage.classList.remove('hidden');
                        return false;
                    }
                }

                submitButton.disabled = false;
                errorMessage.classList.add('hidden');
                return true;
            }

            // Set min date to today for both inputs
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('start_date').min = today;
            document.getElementById('end_date').min = today;
        </script>
    @endpush
@endsection
