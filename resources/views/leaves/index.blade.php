<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-6">
        <!-- Page Header -->
        <div class="mb-8">
            <x-page-header-card title="Pengajuan Izin" subtitle="Ajukan dan pantau status permohonan izin Anda">
                <x-slot name="icon">
                    <x-icons.clipboard-check class="h-6 w-6 text-indigo-600" />
                </x-slot>
            </x-page-header-card>
        </div>

        <!-- Form Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Side - Guidelines -->
            <div class="lg:col-span-1">
                @include('partials.leaves.guidelines-card')
            </div>

            <!-- Right Side - Form -->
            <div class="lg:col-span-2">
                <x-section-card title="Formulir Permohonan">
                    @include('partials.leaves.form')
                </x-section-card>
            </div>
        </div>

        <!-- History Table Section -->
        <div class="mt-8">
            <x-section-card title="Riwayat Pengajuan Izin">
                @include('partials.leaves.history-table')
            </x-section-card>
        </div>
    </div>

    @push('scripts')
        <x-scripts.date-validator startDateId="start_date" endDateId="end_date" errorId="dateError" />
    @endpush
</x-app-layout>
