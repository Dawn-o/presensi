<x-app-layout>
    <x-auth-card>
        <x-auth-header title="Sistem Presensi" description="Silakan masuk menggunakan NIP/NIK dan Password Anda">
            <x-slot name="icon">
                <x-icons.fingerprint class="h-10 w-10 text-indigo-600" />
            </x-slot>
        </x-auth-header>

        <x-auth-session-status :status="session('message')" />

        <form class="mt-8 space-y-6" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="space-y-4">
                <!-- Employee ID -->
                <div>
                    <label for="employee_id" class="block text-sm font-medium text-gray-700 mb-1">
                        NIP/NIK
                    </label>
                    <x-input-with-icon id="employee_id" :hasError="$errors->has('employee_id')" placeholder="Masukkan NIP/NIK"
                        :value="old('employee_id')" autofocus required>
                        <x-slot name="icon">
                            <x-icons.user
                                class="h-5 w-5 {{ $errors->has('employee_id') ? 'text-red-400' : 'text-gray-400' }}" />
                        </x-slot>
                    </x-input-with-icon>
                    @error('employee_id')
                        <x-error-message :message="$message" />
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                        Password
                    </label>
                    <x-input-with-icon id="password" type="password" placeholder="Masukkan password" required>
                        <x-slot name="icon">
                            <x-icons.lock class="h-5 w-5 text-gray-400 transition-colors duration-150" />
                        </x-slot>
                    </x-input-with-icon>
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <button type="submit"
                    class="group relative w-full flex justify-center py-2.5 px-4 border border-transparent text-sm font-medium sm:rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out shadow-sm hover:shadow-md">
                    <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                        <x-icons.login
                            class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400 transition duration-150" />
                    </span>
                    Masuk
                </button>
            </div>
        </form>
    </x-auth-card>

    @push('styles')
        <x-styles.autofill-input />
    @endpush
</x-app-layout>
