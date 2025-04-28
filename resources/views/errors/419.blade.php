<x-app-layout>
    <x-error-page code="419" title="Sesi Telah Berakhir"
        message="Maaf, sesi Anda telah berakhir. Silakan muat ulang halaman." color="red">

        <a href="{{ url('/') }}"
            class="inline-flex items-center px-4 py-2 border border-gray-300 sm:rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
            <x-icons.home class="h-5 w-5 mr-2 text-gray-400" />
            Kembali ke Beranda
        </a>
    </x-error-page>
</x-app-layout>
