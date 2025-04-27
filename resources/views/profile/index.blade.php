@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-4 sm:py-6 px-4 sm:px-6 lg:px-8">
        <!-- Profile Information -->
        <div class="space-y-6 sm:space-y-0 md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-0 sm:px-0">
                    <h3 class="text-lg font-medium text-gray-900">Informasi Profil</h3>
                    <p class="mt-1 text-sm text-gray-600">
                        Informasi detail akun Anda.
                    </p>
                </div>
            </div>

            <div class="mt-4 md:mt-0 md:col-span-2">
                <div class="bg-white shadow sm:rounded-lg">
                    <div class="p-4 sm:p-6">
                        <dl class="space-y-4 sm:space-y-0 sm:divide-y sm:divide-gray-200">
                            <div class="sm:py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">Nama</dt>
                                <dd class="mt-1 sm:mt-0 text-sm text-gray-900 sm:col-span-2">{{ $user->name }}</dd>
                            </div>
                            <div class="sm:py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">ID Karyawan</dt>
                                <dd class="mt-1 sm:mt-0 text-sm text-gray-900 sm:col-span-2">{{ $user->employee_id }}</dd>
                            </div>
                            <div class="sm:py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-500">Email</dt>
                                <dd class="mt-1 sm:mt-0 text-sm text-gray-900 sm:col-span-2">{{ $user->email }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Change Password Section -->
        <div class="mt-8 sm:mt-12 space-y-6 sm:space-y-0 md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-0 sm:px-0">
                    <h3 class="text-lg font-medium text-gray-900">Ubah Password</h3>
                    <p class="mt-1 text-sm text-gray-600">
                        Pastikan menggunakan password yang kuat dan belum pernah digunakan sebelumnya.
                    </p>
                </div>
            </div>

            <div class="mt-4 md:mt-0 md:col-span-2">
                <form action="{{ route('profile.password.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="bg-white shadow sm:rounded-lg">
                        <div class="p-4 sm:p-6">
                            @if (session('success'))
                                <div
                                    class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-md text-sm">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md text-sm">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <div class="space-y-4">
                                <div>
                                    <label for="current_password" class="block text-sm font-medium text-gray-700">
                                        Password Saat Ini
                                    </label>
                                    <input type="password" name="current_password" id="current_password"
                                        class="mt-1 block w-full py-2.5 px-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                                        required placeholder="Masukkan password Anda saat ini">
                                    @error('current_password')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700">
                                        Password Baru
                                    </label>
                                    <input type="password" name="password" id="password"
                                        class="mt-1 block w-full py-2.5 px-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                                        required placeholder="Minimal 8 karakter">
                                    @error('password')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                                        Konfirmasi Password Baru
                                    </label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        class="mt-1 block w-full py-2.5 px-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm"
                                        required placeholder="Masukkan ulang password baru">
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 sm:px-6">
                            <div class="flex justify-end">
                                <button type="submit"
                                    class="w-full sm:w-auto inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2.5 px-6 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors duration-200">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
