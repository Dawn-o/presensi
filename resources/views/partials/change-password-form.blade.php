<form action="{{ route('profile.password.update') }}" method="POST">
    @csrf
    @method('PUT')

    <x-form-card>
        <x-slot name="footerAction">
            <button type="submit"
                class="w-full sm:w-auto inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2.5 px-6 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors duration-200">
                Simpan Perubahan
            </button>
        </x-slot>

        @if (session('success'))
            <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-md text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md text-sm">
                {{ session('error') }}
            </div>
        @endif

        <div class="space-y-4">
            <!-- Current Password Field -->
            <x-password-input id="current_password" label="Password Saat Ini"
                placeholder="Masukkan password Anda saat ini" :hasError="$errors->has('current_password')" required>
                {{ $errors->first('current_password') }}
            </x-password-input>

            <!-- New Password Field -->
            <x-password-input id="password" label="Password Baru" placeholder="Minimal 8 karakter" :hasError="$errors->has('password')"
                required>
                {{ $errors->first('password') }}
            </x-password-input>

            <!-- Password Confirmation Field -->
            <x-password-input id="password_confirmation" label="Konfirmasi Password Baru"
                placeholder="Masukkan ulang password baru" :hasError="$errors->has('password_confirmation')" required>
                {{ $errors->first('password_confirmation') }}
            </x-password-input>
        </div>
    </x-form-card>
</form>
