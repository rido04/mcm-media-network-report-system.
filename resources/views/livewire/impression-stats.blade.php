<div>
    <!-- Responsive Grid of Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
        <!-- Highest Impression Card -->
        <div class="bg-gray-600 p-4 rounded-lg shadow-md text-white text-center">
            <h4 class="text-xl font-semibold">Highest Impression</h4>
            <p class="text-2xl">{{ number_format($stats['highest']) }}</p>
        </div>

        <!-- Lowest Impression Card -->
        <div class="bg-gray-600 p-4 rounded-lg shadow-md text-white text-center">
            <h4 class="text-xl font-semibold">Lowest Impression</h4>
            <p class="text-2xl">{{ number_format($stats['lowest']) }}</p>
        </div>

        <!-- Average Impression Card -->
        <div class="bg-gray-600 p-4 rounded-lg shadow-md text-white text-center">
            <h4 class="text-xl font-semibold">Average Impression</h4>
            <p class="text-2xl">{{ number_format($stats['average'], 2) }}</p>
        </div>

        <!-- Total Impression Card -->
        <div class="bg-gray-600 p-4 rounded-lg shadow-md text-white text-center">
            <h4 class="text-xl font-semibold">Total Impression</h4>
            <p class="text-2xl">{{ number_format($stats['total']) }}</p>
        </div>
    </div>
</div>
