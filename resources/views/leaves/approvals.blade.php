<x-app-layout>
    <div class="max-w-7xl mx-auto py-4 sm:py-6 px-4 sm:px-6 lg:px-8">
        <!-- Enhanced Page Header -->
        <div class="mb-8">
            <x-page-header-card title="Persetujuan Izin" subtitle="Kelola dan proses pengajuan izin karyawan">
                <x-slot name="icon">
                    <x-icons.clipboard-check class="h-6 w-6 text-indigo-600" />
                </x-slot>
            </x-page-header-card>
        </div>

        <!-- Improved Content Card -->
        <x-section-card title="Daftar Pengajuan">
            <x-slot name="rightContent">
                <span
                    class="bg-amber-100 text-amber-800 text-xs font-medium px-2.5 py-0.5 rounded-full flex items-center">
                    <x-icons.clock class="h-4 w-4 mr-1" />
                    Menunggu Tindakan
                </span>
            </x-slot>

            <!-- Alert messages -->
            @if (session('success'))
                <x-alert type="success" :message="session('success')" />
            @endif

            @if (session('error'))
                <x-alert type="error" :message="session('error')" />
            @endif

            <div class="mt-4 overflow-x-auto">
                <div class="inline-block min-w-full align-middle">
                    <!-- Mobile View -->
                    <div class="sm:hidden space-y-4">
                        @foreach ($pendingLeaves as $leave)
                            @include('partials.leaves.mobile-leave-card', ['leave' => $leave])
                        @endforeach
                    </div>

                    <!-- Desktop View - Enhanced Table -->
                    @include('partials.leaves.desktop-leave-table')
                </div>
            </div>

            <!-- Enhanced Pagination -->
            <div class="mt-4">
                {{ $pendingLeaves->links() }}
            </div>
    </div>
    </x-section-card>
    </div>
</x-app-layout>
