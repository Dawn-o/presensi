<div class="bg-white shadow sm:rounded-lg">
    <div class="p-4 sm:p-6">
        <dl class="space-y-4 sm:space-y-0 sm:divide-y sm:divide-gray-200">
            <x-profile-detail-item label="Nama" :value="$user->name" />
            <x-profile-detail-item label="ID Karyawan" :value="$user->employee_id" />
            <x-profile-detail-item label="Email" :value="$user->email" />
        </dl>
    </div>
</div>
