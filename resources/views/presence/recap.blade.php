<x-app-layout>
    <div class="max-w-7xl mx-auto py-4 sm:py-6 px-4 sm:px-6 lg:px-8">
        <!-- Improved Header Card -->
        <div class="bg-white shadow-md sm:rounded-xl border border-gray-100 overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-indigo-600 via-blue-500 to-indigo-700 px-6 py-6 relative overflow-hidden">
                <!-- Decorative elements -->
                <div class="absolute right-0 bottom-0 w-64 h-64 bg-white rounded-full -mr-32 -mb-32 opacity-10"></div>
                <div class="absolute left-1/4 top-0 w-32 h-32 bg-indigo-300 rounded-full -ml-16 -mt-16 opacity-10"></div>

                <div class="relative">
                    <h1 class="text-2xl font-bold text-white">Rekap Kehadiran</h1>
                    <p class="text-indigo-100 text-sm mt-1">
                        {{ Carbon\Carbon::create()->month($month)->translatedFormat('F') }} {{ $year }}
                    </p>
                </div>
            </div>

            <div class="p-6">
                <div class="flex flex-col space-y-5">
                    <!-- User info (if admin) -->
                    @if (auth()->user()->is_admin && isset($user) && $user->id !== auth()->id())
                        <div class="flex items-center bg-blue-50 rounded-lg p-4">
                            <div class="p-2 bg-blue-100 rounded-full mr-4">
                                <svg class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-blue-900">Menampilkan rekap untuk:</p>
                                <div class="flex items-center mt-1">
                                    <h2 class="text-lg font-semibold text-gray-800">{{ $user->name }}</h2>
                                    <span
                                        class="ml-3 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $user->employee_id }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Improved filters -->
                    <div class="flex flex-col bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <p class="text-sm font-medium text-gray-700 mb-3">Filter Rekap</p>
                        <div class="space-y-3">
                            @include('partials.recap-filters')
                        </div>
                    </div>
                </div>

                <!-- Enhanced Tabs Navigation -->
                <div class="mt-8">
                    <x-tab-navigation :tabs="['attendance' => 'Rekap Kehadiran', 'leave' => 'Riwayat Izin/Cuti']" :currentTab="request('tab', 'attendance')" baseRoute="presence.recap"
                        :queryParams="[
                            'month' => $month,
                            'year' => $year,
                            'user_id' => request('user_id'),
                        ]" />
                </div>
            </div>
        </div>

        <!-- Content Section with enhanced styling -->
        <div class="bg-white shadow-md sm:rounded-xl border border-gray-100 overflow-hidden">
            <!-- Decorative header section -->
            <div class="bg-gray-50 border-b border-gray-100 px-6 py-4 flex items-center">
                <div class="h-8 w-1 bg-indigo-500 rounded-full mr-3"></div>
                <h2 class="text-lg font-medium text-gray-800">
                    {{ request('tab') === 'leave' ? 'Riwayat Izin/Cuti' : 'Data Kehadiran' }}
                </h2>
                <div class="ml-auto flex items-center text-sm text-gray-500">
                    <x-icons.calendar-days class="h-4 w-4 text-gray-400 mr-1.5" />
                    <span>{{ Carbon\Carbon::create()->month($month)->translatedFormat('F') }} {{ $year }}</span>
                </div>
            </div>

            <!-- Main content with relative positioning for decorative elements -->
            <div class="p-6 relative">
                <!-- Content tabs -->
                <div class="relative">
                    @include('partials.attendance-tab')
                    @include('partials.leave-tab')
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            /* Hide scrollbar for Chrome, Safari and Opera */
            nav::-webkit-scrollbar {
                display: none;
            }

            /* Hide scrollbar for IE, Edge and Firefox */
            nav {
                -ms-overflow-style: none;
                /* IE and Edge */
                scrollbar-width: none;
                /* Firefox */
            }
        </style>
    @endpush
</x-app-layout>
