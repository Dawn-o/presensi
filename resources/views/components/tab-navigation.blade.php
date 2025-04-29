@props(['tabs', 'currentTab', 'baseRoute', 'queryParams' => []])

<div class="border-b border-gray-200">
    <nav class="-mb-px flex space-x-8 overflow-x-auto" aria-label="Tabs">
        @foreach ($tabs as $tabKey => $tabName)
            @php
                $isActive = $currentTab === $tabKey;
                $params = array_merge($queryParams, ['tab' => $tabKey]);
            @endphp
            <a href="{{ route($baseRoute, $params) }}"
               class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm hover:text-gray-700 hover:border-gray-300
                      {{ $isActive ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500' }}">
                {{ $tabName }}
            </a>
        @endforeach
    </nav>
</div>
