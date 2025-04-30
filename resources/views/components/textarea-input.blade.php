@props(['id', 'label', 'rows' => 3, 'hasError' => false, 'required' => false])

<div>
    <label for="{{ $id }}" class="block text-sm font-medium text-gray-700">
        {{ $label }}
    </label>
    <textarea 
        id="{{ $id }}" 
        name="{{ $id }}" 
        rows="{{ $rows }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'mt-1 block w-full py-2 px-3 border border-gray-300 sm:rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm']) }}
    >{{ $slot }}</textarea>
    
    @if ($hasError)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @endif
</div>
