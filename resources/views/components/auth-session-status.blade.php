@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'mb-4 bg-yellow-50 border border-yellow-200 text-yellow-700 px-4 py-3 rounded-md text-sm']) }}>
        {{ $status }}
    </div>
@endif
