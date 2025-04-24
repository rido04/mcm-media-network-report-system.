<div>
    <!-- Mobile Summary Card (visible only on small screens) -->
    <div class="block sm:hidden mb-4 bg-gradient-to-r from-gray-600 to-gray-700 dark:from-gray-700 dark:to-gray-800 rounded-xl shadow-lg overflow-hidden">
        <div class="px-4 py-3">
            <h3 class="text-sm font-medium text-gray-200 dark:text-gray-300 mb-2">Media Overview Summary</h3>
            <div class="grid grid-cols-2 gap-3">
                <div class="bg-gray-500/30 dark:bg-gray-600/30 rounded-lg p-2">
                    <p class="text-xs text-gray-200 dark:text-gray-300">Media Plan</p>
                    <p class="text-lg font-bold text-white">{{ $stats['totalMediaPlan'] }}</p>
                </div>
                <div class="bg-gray-500/30 dark:bg-gray-600/30 rounded-lg p-2">
                    <p class="text-xs text-gray-200 dark:text-gray-300">Placement</p>
                    <p class="text-lg font-bold text-white">{{ $stats['totalInventory'] }}</p>
                </div>
                <div class="bg-gray-500/30 dark:bg-gray-600/30 rounded-lg p-2">
                    <p class="text-xs text-gray-200 dark:text-gray-300">Duration</p>
                    <p class="text-lg font-bold text-white">{{ $stats['totalDuration'] }} <span class="text-xs font-normal">Days</span></p>
                </div>
                <div class="bg-gray-500/30 dark:bg-gray-600/30 rounded-lg p-2">
                    <p class="text-xs text-gray-200 dark:text-gray-300">Remaining</p>
                    <p class="text-lg font-bold text-white">{{ $stats['remainingDays'] }} <span class="text-xs font-normal">Days</span></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Desktop Cards Grid (hidden on mobile) -->
    <div class="hidden sm:grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">
        <!-- Media Plan Card -->
        <div class="bg-gradient-to-t from-gray-800 to-gray-700 dark:from-gray-700 dark:to-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="px-5 py-4">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-xs font-semibold uppercase tracking-wider text-gray-300 dark:text-gray-400 mb-1">Media Plan</h3>
                        <p class="text-2xl font-bold text-white dark:text-white">
                            {{ $stats['totalMediaPlan'] }}
                        </p>
                    </div>
                    <div class="rounded-full p-2 bg-blue-100/20 dark:bg-blue-900/30 backdrop-blur-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-300 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-2">
                    <span class="text-xs text-gray-300 dark:text-gray-400">Total media plans created</span>
                </div>
            </div>
        </div>

        <!-- Media Placement Card -->
        <div class="bg-gradient-to-t from-gray-800 to-gray-700 dark:from-gray-700 dark:to-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="px-5 py-4">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-xs font-semibold uppercase tracking-wider text-gray-300 dark:text-gray-400 mb-1">Media Placement</h3>
                        <p class="text-2xl font-bold text-white dark:text-white">
                            {{ $stats['totalInventory'] }}
                        </p>
                    </div>
                    <div class="rounded-full p-2 bg-green-100/20 dark:bg-green-900/30 backdrop-blur-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-300 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                </div>
                <div class="mt-2">
                    <span class="text-xs text-gray-300 dark:text-gray-400">Total media placements</span>
                </div>
            </div>
        </div>

        <!-- Broadcast Duration Card -->
        <div class="bg-gradient-to-t from-gray-800 to-gray-700 dark:from-gray-700 dark:to-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="px-5 py-4">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-xs font-semibold uppercase tracking-wider text-gray-300 dark:text-gray-400 mb-1">Broadcast Duration</h3>
                        <p class="text-2xl font-bold text-white dark:text-white">
                            {{ $stats['totalDuration'] }} <span class="text-sm font-normal">Days</span>
                        </p>
                    </div>
                    <div class="rounded-full p-2 bg-cyan-100/20 dark:bg-cyan-900/30 backdrop-blur-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-cyan-300 dark:text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-2">
                    <span class="text-xs text-gray-300 dark:text-gray-400">Total broadcast duration</span>
                </div>
            </div>
        </div>

        <!-- Remaining Days Card -->
        <div class="bg-gradient-to-t from-gray-800 to-gray-700 dark:from-gray-700 dark:to-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <div class="px-5 py-4">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-xs font-semibold uppercase tracking-wider text-gray-300 dark:text-gray-400 mb-1">Remaining Days</h3>
                        <p class="text-2xl font-bold text-white dark:text-white">
                            {{ $stats['remainingDays'] }} <span class="text-sm font-normal">Days</span>
                        </p>
                    </div>
                    <div class="rounded-full p-2 bg-amber-100/20 dark:bg-amber-900/30 backdrop-blur-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-300 dark:text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-2">
                    <span class="text-xs text-gray-300 dark:text-gray-400">Days remaining in campaign</span>
                </div>
            </div>
        </div>
    </div>
</div>
