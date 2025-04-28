<x-app-layout>
    <x-auth-card>
        <x-auth-header title="Buat Akun Baru" description="Silakan lengkapi data diri Anda">
            <x-slot name="icon">
                <x-icons.user-plus class="h-10 w-10 text-indigo-600" />
            </x-slot>
        </x-auth-header>

        <form class="mt-8 space-y-6" method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name field -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                    Nama
                </label>
                <x-input-with-icon id="name" :hasError="$errors->has('name')" placeholder="Masukkan nama lengkap" :value="old('name')"
                    autofocus required>
                    <x-slot name="icon">
                        <x-icons.user class="h-5 w-5 {{ $errors->has('name') ? 'text-red-400' : 'text-gray-400' }}" />
                    </x-slot>
                </x-input-with-icon>
                @error('name')
                    <x-error-message :message="$message" />
                @enderror
            </div>

            <!-- Employee ID field -->
            <div>
                <label for="employee_id" class="block text-sm font-medium text-gray-700 mb-1">
                    NIP/NIK
                </label>
                <x-input-with-icon id="employee_id" :hasError="$errors->has('employee_id')" placeholder="Masukkan NIP/NIK" :value="old('employee_id')"
                    required>
                    <x-slot name="icon">
                        <x-icons.badge
                            class="h-5 w-5 {{ $errors->has('employee_id') ? 'text-red-400' : 'text-gray-400' }}" />
                    </x-slot>
                </x-input-with-icon>
                @error('employee_id')
                    <x-error-message :message="$message" />
                @enderror
            </div>

            <!-- Email field -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                    Email
                </label>
                <x-input-with-icon id="email" type="email" :hasError="$errors->has('email')" placeholder="Masukkan alamat email"
                    :value="old('email')" required>
                    <x-slot name="icon">
                        <x-icons.email class="h-5 w-5 {{ $errors->has('email') ? 'text-red-400' : 'text-gray-400' }}" />
                    </x-slot>
                </x-input-with-icon>
                @error('email')
                    <x-error-message :message="$message" />
                @enderror
            </div>

            <!-- Password fields -->
            <div class="space-y-4">
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                        Password
                    </label>
                    <x-input-with-icon id="password" type="password" :hasError="$errors->has('password')" placeholder="Masukkan password"
                        required>
                        <x-slot name="icon">
                            <x-icons.lock
                                class="h-5 w-5 {{ $errors->has('password') ? 'text-red-400' : 'text-gray-400' }}" />
                        </x-slot>
                    </x-input-with-icon>
                    @error('password')
                        <x-error-message :message="$message" />
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                        Konfirmasi Password
                    </label>
                    <x-input-with-icon id="password_confirmation" type="password" placeholder="Konfirmasi password"
                        required>
                        <x-slot name="icon">
                            <x-icons.shield class="h-5 w-5 text-gray-400" />
                        </x-slot>
                    </x-input-with-icon>
                </div>
            </div>

            <div>
                <button type="submit"
                    class="group relative w-full flex justify-center py-2.5 px-4 border border-transparent text-sm font-medium sm:rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out shadow-sm hover:shadow-md">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <x-icons.user-plus
                            class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400 transition duration-150" />
                    </span>
                    Daftar
                </button>
            </div>

            <div class="text-sm text-center">
                <p class="text-gray-600">
                    Sudah punya akun?
                    <a href="{{ route('login') }}"
                        class="font-medium text-indigo-600 hover:text-indigo-500 transition duration-150 ease-in-out">
                        Masuk disini
                    </a>
                </p>
            </div>
        </form>
    </x-auth-card>

    @push('styles')
        <style>
            input:-webkit-autofill,
            input:-webkit-autofill:hover,
            input:-webkit-autofill:focus {
                -webkit-box-shadow: 0 0 0px 1000px white inset;
                transition: background-color 5000s ease-in-out 0s;
            }
        </style>
    @endpush
</x-app-layout>
