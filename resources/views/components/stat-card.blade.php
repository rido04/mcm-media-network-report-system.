<div class="rounded-xl bg-gray-500 dark:bg-gray-900 p-4 shadow-md border">
    <!-- resources/views/components/stat-card.blade.php -->
<div class="bg-gray-500 p-6 rounded-lg shadow {{ $color ? 'border-t-4 border-'.$color.'-500' : '' }}">
    <p class="text-gray-500 text-sm font-medium">{{ $label }}</p>
    <p class="text-2xl font-bold mt-2">{{ $value }}</p>
</div>
</div>
