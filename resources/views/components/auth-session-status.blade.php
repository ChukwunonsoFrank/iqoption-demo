@props([
    'status',
])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-xs text-green-600']) }}>
        {{ $status }}
    </div>
@endif
