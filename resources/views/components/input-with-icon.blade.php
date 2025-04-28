@props(['id', 'type' => 'text', 'icon', 'hasError' => false])

<div class="relative sm:rounded-md shadow-sm">
    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
        {{ $icon }}
    </div>
    <input id="{{ $id }}" name="{{ $id }}" type="{{ $type }}"
        {{ $attributes->merge([
            'class' =>
                'appearance-none block w-full pl-10 ' .
                ($type === 'password' ? 'pr-10 ' : '') .
                'px-3 py-2.5 border ' .
                ($hasError ? 'border-red-300' : 'border-gray-300') .
                ' sm:rounded-lg placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-2 ' .
                ($hasError ? 'focus:ring-red-500 focus:border-red-500' : 'focus:ring-indigo-500 focus:border-indigo-500') .
                ' sm:text-sm transition duration-150 ease-in-out',
        ]) }}>

    @if ($type === 'password')
        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
            <button type="button" class="text-gray-400 hover:text-gray-500 focus:outline-none focus:text-gray-500"
                onclick="togglePasswordVisibility('{{ $id }}')" aria-label="Toggle password visibility">
                <span id="{{ $id }}-eye-show">
                    <x-icons.eye class="h-5 w-5" />
                </span>
                <span id="{{ $id }}-eye-hide" class="hidden">
                    <x-icons.eye-off class="h-5 w-5" />
                </span>
            </button>
        </div>
    @endif
</div>

@if ($type === 'password')
    @push('scripts')
        <script>
            function togglePasswordVisibility(inputId) {
                const input = document.getElementById(inputId);
                const showIcon = document.getElementById(`${inputId}-eye-show`);
                const hideIcon = document.getElementById(`${inputId}-eye-hide`);

                // Toggle the input type
                if (input.type === 'password') {
                    input.type = 'text';
                    showIcon.classList.add('hidden');
                    hideIcon.classList.remove('hidden');
                } else {
                    input.type = 'password';
                    hideIcon.classList.add('hidden');
                    showIcon.classList.remove('hidden');
                }
            }
        </script>
    @endpush
@endif
