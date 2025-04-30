@props(['id', 'label', 'hasError' => false, 'errorMessage' => null, 'required' => false])

<div>
    <label for="{{ $id }}" class="block text-sm font-medium text-gray-700">
        {{ $label }}
    </label>
    <input 
        type="date" 
        name="{{ $id }}" 
        id="{{ $id }}" 
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'mt-1 block w-full py-2 px-3 border border-gray-300 sm:rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm']) }}
    >
    
    @if ($hasError && $errorMessage)
        <p class="mt-1 text-sm text-red-600">{{ $errorMessage }}</p>
    @endif
</div>
