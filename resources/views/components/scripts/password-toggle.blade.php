@props(['inputId'])

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('{{ $inputId }}');
        const toggleContainer = document.getElementById('{{ $inputId }}-toggle-container');

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

    // Only define togglePasswordVisibility once if it doesn't exist
    if (typeof window.togglePasswordVisibility === 'undefined') {
        window.togglePasswordVisibility = function(inputId) {
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
        };
    }
</script>
