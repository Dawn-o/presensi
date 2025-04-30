<x-app-layout>
    <div class="max-w-7xl mx-auto py-4 sm:py-6 px-4 sm:px-6 lg:px-8">
        <!-- Header Card -->
        <div class="bg-white shadow-md sm:rounded-xl border border-gray-100 overflow-hidden mb-6">
            <x-gradient-header title="Rekap Kehadiran"
                subtitle="{{ Carbon\Carbon::create()->month($month)->translatedFormat('F') }} {{ $year }}" />

            <div class="p-6">
                <div class="flex flex-col space-y-5">
                    <!-- User info (if admin) -->
                    @if (auth()->user()->is_admin && isset($user) && $user->id !== auth()->id())
                        <x-user-info-card :user="$user" />
                    @endif

                    <!-- Filters -->
                    <x-filter-box title="Filter Rekap">
                        @include('partials.recap-filters')
                    </x-filter-box>
                </div>

                <!-- Tabs Navigation -->
                <div class="mt-8">
                    <x-tab-navigation :tabs="['attendance' => 'Rekap Kehadiran', 'leave' => 'Riwayat Izin/Cuti']" :currentTab="request('tab', 'attendance')" baseRoute="presence.recap" :queryParams="[
                        'month' => $month,
                        'year' => $year,
                        'user_id' => request('user_id'),
                    ]" />
                </div>
            </div>
        </div>

        <!-- Content Section -->
        <x-section-card title="{{ request('tab') === 'leave' ? 'Riwayat Izin/Cuti' : 'Data Kehadiran' }}">
            <x-slot name="rightContent">
                <x-icons.calendar-days class="h-4 w-4 text-gray-400 mr-1.5" />
                <span>{{ Carbon\Carbon::create()->month($month)->translatedFormat('F') }} {{ $year }}</span>
            </x-slot>

            <!-- Content tabs -->
            @include('partials.attendance-tab')
            @include('partials.leave-tab')
        </x-section-card>
    </div>

    @push('styles')
        <x-styles.hide-scrollbar />
    @endpush
</x-app-layout>
