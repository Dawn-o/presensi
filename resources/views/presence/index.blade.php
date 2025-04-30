<x-app-layout>
    @php
        $serverTime = now()->setTimezone('Asia/Makassar');
        $timestamp = $serverTime->timestamp * 1000;
    @endphp

    <div class="max-w-7xl mx-auto py-4 sm:py-6 px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <x-page-header-card title="Presensi" subtitle="{{ now()->translatedFormat('l, d F Y') }}">
            <x-slot name="icon">
                <x-icons.clipboard class="h-6 w-6 text-indigo-600" />
            </x-slot>

            <x-slot name="action">
                <a href="{{ route('employees.index') }}"
                    class="group w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 border border-gray-200 sm:rounded-lg shadow-sm text-sm font-medium text-indigo-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <span class="bg-indigo-100 p-1.5 rounded mr-2.5">
                        <x-icons.users class="h-4 w-4 text-indigo-600" />
                    </span>
                    Daftar Karyawan
                </a>
            </x-slot>
        </x-page-header-card>

        <!-- Main Grid Layout -->
        <div class="grid grid-cols-12 gap-6">
            <!-- Left Sidebar -->
            <div class="col-span-12 lg:col-span-4 space-y-6">
                <!-- Clock Card -->
                <x-clock-card />

                <!-- Location Status Card -->
                <x-location-status :isAllowed="App\Helpers\IpHelper::isAllowedIp(request()->ip())" />

                <!-- Work Hours Information -->
                <x-work-hours-info />
            </div>

            <!-- Main Content Area -->
            <div class="col-span-12 lg:col-span-8 space-y-6">
                <!-- Presence Card -->
                <x-presence-card :presence="$today" route="{{ route('presence.store') }}" />

                <!-- Monthly Calendar -->
                <x-monthly-calendar :calendar="$monthlyCalendar" />
            </div>
        </div>
    </div>

    @push('scripts')
        <x-scripts.clock-updater :timestamp="$timestamp" />
    @endpush
</x-app-layout>
