<div class="bg-white shadow sm:rounded-lg overflow-hidden">
    <div class="p-6 relative">
        <!-- Decorative circles in background -->
        <div class="absolute -top-10 -right-10 w-40 h-40 bg-indigo-50 rounded-full opacity-70"></div>
        <div class="absolute -bottom-8 -left-8 w-32 h-32 bg-blue-50 rounded-full opacity-50"></div>
        
        <!-- Clock content -->
        <div class="relative">
            <div class="flex flex-col items-center text-center">
                <!-- Time display -->
                <div id="clock" class="text-5xl font-bold text-gray-800 tracking-tight">00:00:00</div>
                
                <!-- Current day and date -->
                <div id="date" class="mt-3 text-base text-gray-600">Loading...</div>
                
                <!-- Decorative line -->
                <div class="mt-4 w-16 h-1 rounded bg-indigo-500"></div>
                
                <!-- Timezone indicator -->
                <div class="mt-3 px-3 py-1 bg-indigo-50 rounded-full">
                    <span class="text-xs font-medium text-indigo-700">Zona Waktu WITA</span>
                </div>
            </div>
        </div>
    </div>
</div>
