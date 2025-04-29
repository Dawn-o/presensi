@props(['name', 'options', 'selectedValue' => null, 'placeholder' => null])

<div class="relative">
    <select name="{{ $name }}" {{ $attributes->merge(['class' => 'appearance-none w-full pl-3 pr-10 py-2 text-sm border border-gray-300 bg-white sm:rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500']) }}>
        @if ($placeholder)
            <option value="">{{ $placeholder }}</option>
        @endif
        
        @foreach($options as $value => $label)
            <option value="{{ $value }}" {{ $selectedValue == $value ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>
    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
        <x-icons.chevron-down class="h-5 w-5" />
    </div>
</div>
