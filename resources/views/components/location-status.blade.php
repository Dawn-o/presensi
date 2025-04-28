@props(['isAllowed'])

<div class="bg-white shadow sm:rounded-lg overflow-hidden">
    <div class="p-6">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                @if ($isAllowed)
                    <div class="p-2 bg-green-100 sm:rounded-full">
                        <x-icons.location class="h-6 w-6 text-green-600" />
                    </div>
                @else
                    <div class="p-2 bg-red-100 sm:rounded-full">
                        <x-icons.warning class="h-6 w-6 text-red-600" />
                    </div>
                @endif
            </div>
            <div class="ml-4 flex-1">
                <h3 class="text-lg font-medium text-gray-900">Status Lokasi</h3>
                <div class="mt-2">
                    @if ($isAllowed)
                        <p class="text-sm font-medium text-green-600">
                            Anda berada di lingkungan kantor
                        </p>
                        <p class="mt-1 text-sm text-gray-500">
                            IP Address terdeteksi di jaringan kantor
                        </p>
                    @else
                        <p class="text-sm font-medium text-red-600">
                            Anda berada di luar lingkungan kantor
                        </p>
                        <p class="mt-1 text-sm text-gray-500">
                            Silakan gunakan WiFi kantor untuk melakukan presensi
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @if (!$isAllowed)
        <div class="bg-red-50 px-6 py-4 border-t border-red-100">
            <div class="flex items-center">
                <x-icons.info class="h-5 w-5 text-red-400" />
                <p class="ml-3 text-sm text-red-700">
                    Presensi hanya dapat dilakukan di lingkungan kantor
                </p>
            </div>
        </div>
    @endif
</div>
