@if ($day['date']->isWeekend())
    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
        Libur
    </span>
@elseif($day['date']->isToday())
    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
        Hari Ini
    </span>
@elseif($day['date']->isFuture())
    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
        -
    </span>
@elseif(!$day['presence'])
    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
        Absen
    </span>
@else
    <span class="px-2 py-1 text-xs font-semibold rounded-full 
        {{ $day['presence']->status === 'present' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
        {{ $day['presence']->status === 'present' ? 'Tepat' : 'Telat' }}
    </span>
@endif