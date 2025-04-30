@props(['timestamp'])

<script>
    // Initialize with server time
    let serverTime = new Date({{ $timestamp }});
    let timeDiff = serverTime - new Date();

    function updateClock() {
        // Use server time + elapsed time since page load
        const now = new Date(Date.now() + timeDiff);

        // Update clock with WITA timezone (using colon separator)
        const clockElement = document.getElementById('clock');
        const timeOptions = {
            timeZone: 'Asia/Makassar',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: false
        };

        // Format time manually to ensure colon separator
        const formatter = new Intl.DateTimeFormat('id-ID', timeOptions);
        const parts = formatter.formatToParts(now);
        const time = parts
            .map(p => p.type === 'literal' ? ':' : p.value)
            .join('')
            .replace(/\./g, ':');

        clockElement.textContent = time;

        // Update date with WITA timezone (unchanged)
        const dateElement = document.getElementById('date');
        dateElement.textContent = now.toLocaleDateString('id-ID', {
            timeZone: 'Asia/Makassar',
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
    }

    // Update immediately and then every second
    updateClock();
    setInterval(updateClock, 1000);
</script>
