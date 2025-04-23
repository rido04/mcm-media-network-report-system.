{{-- @props([
    'label' => '',
    'value' => '',
    'icon' => '',
    'color' => 'primary',
])

@php
    $colorClasses = [
        'primary' => 'bg-blue-600 text-white',
        'success' => 'bg-green-600 text-white',
        'warning' => 'bg-yellow-600 text-white',
        'danger' => 'bg-red-600 text-white',
        'info' => 'bg-cyan-600 text-white',
    ][$color] ?? 'bg-blue-600 text-white';
@endphp

<div {{ $attributes->merge(['class' => 'p-4 bg-white dark:bg-gray-900 rounded-lg shadow-md hover:shadow-xl transition-all duration-300 transform hover:scale-105']) }}>
    <div class="flex justify-between items-center">
        <div>
            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ $label }}</h3>
            <div class="mt-2 text-xl font-semibold {{ $colorClasses }}">{{ $value }}</div>
        </div>

        @if($icon)
        <div class="p-2 rounded-full bg-gray-100 dark:bg-gray-800">
            <x-dynamic-component :component="$icon" class="w-6 h-6 {{ $colorClasses }}" />
        </div>
        @endif
    </div>
</div> --}}
