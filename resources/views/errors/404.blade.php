<x-app-layout>
    <x-error-page code="404" title="Halaman Tidak Ditemukan"
        message="Maaf, halaman yang Anda cari tidak dapat ditemukan." color="indigo">

        <a href="{{ url('/') }}"
            class="inline-flex items-center px-4 py-2 border border-transparent sm:rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            <x-icons.home class="h-5 w-5 mr-2" />
            Kembali ke Beranda
        </a>
    </x-error-page>
</x-app-layout>
