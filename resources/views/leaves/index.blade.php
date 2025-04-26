@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Pengajuan Izin</h3>
                    <p class="mt-1 text-sm text-gray-600">
                        Silakan isi form pengajuan izin dengan informasi yang lengkap.
                    </p>
                </div>
            </div>

            <div class="mt-5 md:mt-0 md:col-span-2">
                <form action="{{ route('leaves.store') }}" method="POST">
                    @csrf
                    <div class="shadow sm:rounded-md sm:overflow-hidden">
                        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="start_date" class="block text-sm font-medium text-gray-700">Tanggal
                                        Mulai</label>
                                    <input type="date" name="start_date" id="start_date"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                        required onchange="validateDates()">
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="end_date" class="block text-sm font-medium text-gray-700">Tanggal
                                        Selesai</label>
                                    <input type="date" name="end_date" id="end_date"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                        required onchange="validateDates()">
                                    <p id="dateError" class="mt-1 text-sm text-red-600 hidden">
                                        Tanggal selesai tidak boleh lebih awal dari tanggal mulai
                                    </p>
                                </div>

                                <div class="col-span-6">
                                    <label for="type" class="block text-sm font-medium text-gray-700">Jenis Izin</label>
                                    <select id="type" name="type"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        required>
                                        <option value="">Pilih jenis izin</option>
                                        <option value="sick">Sakit</option>
                                        <option value="personal">Keperluan Pribadi</option>
                                        <option value="other">Lainnya</option>
                                    </select>
                                </div>

                                <div class="col-span-6">
                                    <label for="reason" class="block text-sm font-medium text-gray-700">Alasan</label>
                                    <textarea id="reason" name="reason" rows="3"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                        required placeholder="Jelaskan alasan pengajuan izin Anda"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button type="submit"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Ajukan Izin
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

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
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Jenis</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Alasan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($leaves as $leave)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $leave->start_date->format('d/m/Y') }} - {{ $leave->end_date->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $leave->type === 'sick' ? 'Sakit' : ($leave->type === 'personal' ? 'Keperluan Pribadi' : 'Lainnya') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        {{ $leave->reason }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
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
                                    <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
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
@endsection

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
