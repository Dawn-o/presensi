@props(['isAllowed'])

<div class="bg-white shadow sm:rounded-lg overflow-hidden">
    <div class="relative">
        <!-- Status indicator - colored top border -->
        <div class="absolute top-0 inset-x-0 h-1 {{ $isAllowed ? 'bg-green-500' : 'bg-red-500' }}"></div>

        <div class="pt-6 px-6 pb-5">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    @if ($isAllowed)
                        <div class="bg-green-100 p-3 rounded-full">
                            <x-icons.location class="h-6 w-6 text-green-600" />
                        </div>
                    @else
                        <div class="bg-red-100 p-3 rounded-full">
                            <x-icons.warning class="h-6 w-6 text-red-600" />
                        </div>
                    @endif
                </div>
                <div class="ml-4 flex-1">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Status Lokasi</h3>
                            <div class="mt-1.5">
                                @if ($isAllowed)
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                        <x-icons.dot class="-ml-0.5 mr-1.5 text-green-600" />
                                        Di Lingkungan Kantor
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                        <x-icons.dot class="-ml-0.5 mr-1.5 text-red-600" />
                                        Di Luar Lingkungan Kantor
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <p class="mt-2.5 text-sm text-gray-600">
                        @if ($isAllowed)
                            IP Address terdeteksi di jaringan kantor.
                        @else
                            Silakan gunakan WiFi kantor untuk melakukan presensi.
                        @endif
                    </p>
                </div>
            </div>
        </div>

        @if (!$isAllowed)
            <div class="border-t border-red-100 bg-red-50 px-6 py-3">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <x-icons.info class="h-5 w-5 text-red-400" />
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-red-800">
                            Presensi hanya dapat dilakukan di lingkungan kantor
                        </p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
