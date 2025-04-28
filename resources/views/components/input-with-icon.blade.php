@props(['id', 'type' => 'text', 'icon', 'hasError' => false])

<div class="relative sm:rounded-md shadow-sm">
    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
        {{ $icon }}
    </div>
    <input id="{{ $id }}" name="{{ $id }}" type="{{ $type }}" {{ $attributes->merge([
        'class' => 'appearance-none block w-full pl-10 px-3 py-2.5 border ' . 
        ($hasError ? 'border-red-300' : 'border-gray-300') . 
        ' sm:rounded-lg placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-2 ' .
        ($hasError ? 'focus:ring-red-500 focus:border-red-500' : 'focus:ring-indigo-500 focus:border-indigo-500') .
        ' sm:text-sm transition duration-150 ease-in-out'
    ]) }}>
</div>
