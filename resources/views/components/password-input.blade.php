@props(['id', 'label', 'placeholder' => '', 'hasError' => false])

<div>
    <label for="{{ $id }}" class="block text-sm font-medium text-gray-700">
        {{ $label }}
    </label>
    <div class="mt-1 relative">
        <input type="password" name="{{ $id }}" id="{{ $id }}"
            class="block w-full pr-10 py-2.5 px-3 border {{ $hasError ? 'border-red-300' : 'border-gray-300' }} rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm"
            {{ $attributes }} placeholder="{{ $placeholder }}">

        <!-- Password Toggle Button -->
        <div id="{{ $id }}-toggle-container"
            class="absolute inset-y-0 right-0 flex items-center pr-3 opacity-0 transition-opacity duration-200">
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

        @if ($hasError)
            <p class="mt-1 text-sm text-red-600">{{ $slot }}</p>
        @endif
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('{{ $id }}');
            const toggleContainer = document.getElementById('{{ $id }}-toggle-container');

            if (input && toggleContainer) {
                // Show toggle on input focus
                input.addEventListener('focus', function() {
                    toggleContainer.classList.add('opacity-100');
                });

                // Hide toggle on input blur (unless password is visible)
                input.addEventListener('blur', function() {
                    if (input.type === 'password') {
                        toggleContainer.classList.remove('opacity-100');
                    }
                });
            }
        });

        function togglePasswordVisibility(inputId) {
            const input = document.getElementById(inputId);
            const showIcon = document.getElementById(`${inputId}-eye-show`);
            const hideIcon = document.getElementById(`${inputId}-eye-hide`);
            const toggleContainer = document.getElementById(`${inputId}-toggle-container`);

            // Toggle the input type
            if (input.type === 'password') {
                input.type = 'text';
                showIcon.classList.add('hidden');
                hideIcon.classList.remove('hidden');
                // Keep toggle visible when password is showing
                toggleContainer.classList.add('opacity-100');
            } else {
                input.type = 'password';
                hideIcon.classList.add('hidden');
                showIcon.classList.remove('hidden');
                // Hide toggle if input is not focused
                if (!input.matches(':focus')) {
                    toggleContainer.classList.remove('opacity-100');
                }
            }
        }
    </script>
@endpush
