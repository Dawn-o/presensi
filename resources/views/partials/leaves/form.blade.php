<form action="{{ route('leaves.store') }}" method="POST">
    @csrf

    <!-- Alert messages -->
    @if (session('success'))
        <x-alert type="success" class="mt-0" :message="session('success')" />
    @endif
    @if (session('error'))
        <x-alert type="error" class="mt-0" :message="session('error')" />
    @endif

    <div class="mt-6 space-y-4 sm:space-y-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
            <!-- Date Inputs -->
            <div class="col-span-1">
                <x-date-input id="start_date" label="Tanggal Mulai" onchange="validateDates()" required />
            </div>

            <div class="col-span-1">
                <x-date-input id="end_date" label="Tanggal Selesai" onchange="validateDates()" required />
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
                    <x-custom-select name="type" :options="[
                        '' => 'Pilih jenis izin',
                        'sick' => 'Sakit',
                        'personal' => 'Keperluan Pribadi',
                        'other' => 'Lainnya',
                    ]" required />
                </div>
            </div>

            <!-- Reason Textarea -->
            <div class="col-span-1 sm:col-span-2">
                <x-textarea-input id="reason" label="Alasan" rows="3"
                    placeholder="Jelaskan alasan pengajuan izin Anda" required />
            </div>
        </div>
        <button type="submit"
            class="w-full sm:w-auto inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium sm:rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Ajukan Izin
        </button>
    </div>
</form>
