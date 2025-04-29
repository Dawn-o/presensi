@props(['user'])

<div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden mb-8 transition-all duration-300 hover:shadow-lg">
    <div class="relative">
        <!-- Background with animated gradient -->
        <div class="bg-gradient-to-r from-indigo-600 via-blue-500 to-indigo-700 h-32 md:h-48 relative overflow-hidden">
            <!-- Decorative elements -->
            <div class="absolute right-0 bottom-0 w-64 h-64 bg-white rounded-full -mr-32 -mb-32 opacity-10"></div>
            <div class="absolute left-1/4 top-0 w-32 h-32 bg-indigo-300 rounded-full -ml-16 -mt-16 opacity-10"></div>
        </div>
    </div>
    <div class="p-4 sm:p-6 -mt-16 sm:-mt-20 relative">
        <div class="flex flex-col sm:flex-row sm:items-end gap-4">
            <div class="w-24 h-24 sm:w-32 sm:h-32 bg-white rounded-full border-4 border-white shadow-md flex items-center justify-center mx-auto sm:mx-0">
                <div class="bg-indigo-100 rounded-full p-3 w-20 h-20 sm:w-24 sm:h-24 flex items-center justify-center">
                    <x-icons.user class="h-12 w-12 sm:h-16 sm:w-16 text-indigo-500" />
                </div>
            </div>
            <div class="text-center sm:text-left">
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $user->name }}</h1>
                <p class="text-gray-500 mt-1">{{ $user->employee_id }}</p>
            </div>
        </div>
    </div>
</div>
