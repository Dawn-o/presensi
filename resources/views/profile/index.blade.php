<x-app-layout>
    <div class="max-w-7xl mx-auto py-4 sm:py-6 px-4 sm:px-6 lg:px-8">
        <!-- Profile Header -->
        <div
            class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden mb-8 transition-all duration-300 hover:shadow-lg">
            <div class="relative">
                <!-- Background with animated gradient -->
                <div
                    class="bg-gradient-to-r from-indigo-600 via-blue-500 to-indigo-700 h-32 md:h-48 relative overflow-hidden">
                    <!-- Decorative elements -->
                    <div class="absolute right-0 bottom-0 w-64 h-64 bg-white rounded-full -mr-32 -mb-32 opacity-10">
                    </div>
                    <div class="absolute left-1/4 top-0 w-32 h-32 bg-indigo-300 rounded-full -ml-16 -mt-16 opacity-10">
                    </div>
                </div>
            </div>
            <div class="p-4 sm:p-6 -mt-16 sm:-mt-20 relative">
                <div class="flex flex-col sm:flex-row sm:items-end gap-4">
                    <div
                        class="w-24 h-24 sm:w-32 sm:h-32 bg-white rounded-full border-4 border-white shadow-md flex items-center justify-center mx-auto sm:mx-0">
                        <div
                            class="bg-indigo-100 rounded-full p-3 w-20 h-20 sm:w-24 sm:h-24 flex items-center justify-center">
                            <svg class="h-12 w-12 sm:h-16 sm:w-16 text-indigo-500" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                    <div class="text-center sm:text-left">
                        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $user->name }}</h1>
                        <p class="text-gray-500 mt-1">{{ $user->employee_id }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Profile Information -->
            <div class="lg:col-span-1">
                <x-page-section title="Informasi Profil" description="Informasi detail akun Anda.">
                    <x-slot name="icon">
                        <div class="p-2 bg-blue-100 rounded-lg">
                            <svg class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </x-slot>
                    @include('partials.profile-details')
                </x-page-section>
            </div>

            <!-- Change Password Section -->
            <div class="lg:col-span-2">
                <x-page-section title="Ubah Password"
                    description="Pastikan menggunakan password yang kuat dan belum pernah digunakan sebelumnya.">
                    <x-slot name="icon">
                        <div class="p-2 bg-amber-100 rounded-lg">
                            <svg class="h-5 w-5 text-amber-600" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                            </svg>
                        </div>
                    </x-slot>
                    @include('partials.change-password-form')
                </x-page-section>
            </div>
        </div>
    </div>
</x-app-layout>
