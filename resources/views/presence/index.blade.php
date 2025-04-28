<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Presensi') }}
        </h2>
    </x-slot>

    @php
        $serverTime = now()->setTimezone('Asia/Makassar');
        $timestamp = $serverTime->timestamp * 1000; // Convert to milliseconds for JavaScript
    @endphp

    <div class="max-w-7xl mx-auto py-4 sm:py-6 px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <x-page-header title="Presensi">
            <x-slot name="action">
                <a href="{{ route('employees.index') }}"
                    class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 border border-gray-300 sm:rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    <x-icons.users class="h-5 w-5 -ml-1 mr-2 text-gray-500" />
                    Daftar Karyawan
                </a>
            </x-slot>
        </x-page-header>

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
        @include('partials.clock-script', ['timestamp' => $timestamp])
    @endpush
</x-app-layout>
