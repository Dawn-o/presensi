<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Profile Information -->
    <div class="lg:col-span-1">
        <x-page-section title="Informasi Profil" description="Informasi detail akun Anda.">
            <x-slot name="icon">
                <div class="p-2 bg-blue-100 rounded-lg">
                    <x-icons.user class="h-5 w-5 text-blue-600" />
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
                    <x-icons.key class="h-5 w-5 text-amber-600" />
                </div>
            </x-slot>
            @include('partials.change-password-form')
        </x-page-section>
    </div>
</div>
