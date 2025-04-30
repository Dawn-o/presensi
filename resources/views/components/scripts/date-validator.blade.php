@props(['startDateId', 'endDateId', 'errorId'])

<script>
    function validateDates() {
        const startDate = document.getElementById('{{ $startDateId }}').value;
        const endDate = document.getElementById('{{ $endDateId }}').value;
        const submitButton = document.querySelector('button[type="submit"]');
        const errorMessage = document.getElementById('{{ $errorId }}');

        if (startDate && endDate) {
            if (new Date(endDate) < new Date(startDate)) {
                submitButton.disabled = true;
                errorMessage.classList.remove('hidden');
                return false;
            }
        }

        submitButton.disabled = false;
        errorMessage.classList.add('hidden');
        return true;
    }

    // Set min date to today for both inputs
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('{{ $startDateId }}').min = today;
    document.getElementById('{{ $endDateId }}').min = today;
</script>
