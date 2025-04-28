@if ($day['date']->isWeekend())
    <x-status-badge status="holiday">Libur</x-status-badge>
@elseif($day['date']->isToday())
    <x-status-badge status="today">Hari Ini</x-status-badge>
@elseif($day['date']->isFuture())
    <x-status-badge status="future">-</x-status-badge>
@elseif(!$day['presence'])
    <x-status-badge status="absent">Absen</x-status-badge>
@else
    <x-status-badge status="{{ $day['presence']->status }}">
        {{ $day['presence']->status === 'present' ? 'Tepat' : 'Telat' }}
    </x-status-badge>
@endif
