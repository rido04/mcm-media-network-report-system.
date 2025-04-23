    <!-- Stats Cards Row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">
        <!-- Media Plan Card -->
        <div class="bg-gradient-to-r from-gray-600 to-gray-500 dark:bg-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
            <div class="px-6 py-5">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-sm font-medium text-white font- dark:text-gray-400 mb-1">Media Plan</h3>
                        <div class="flex items-baseline">
                            <p class="text-2xl font-bold text-white dark:text-white">
                                {{ $this->stats['totalMediaPlan'] }}
                            </p>
                        </div>
                    </div>
                    <div class="rounded-full p-3 bg-blue-100 dark:bg-blue-900/30">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Media Placement Card -->
        <div class="bg-gradient-to-r from-gray-600 to-gray-500 dark:bg-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
            <div class="px-6 py-5">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-sm font-medium text-white font- dark:text-gray-400 mb-1">Media Placement</h3>
                        <div class="flex items-baseline">
                            <p class="text-2xl font-bold text-white dark:text-white">
                                {{ $this->stats['totalInventory'] }}
                            </p>
                        </div>
                    </div>
                    <div class="rounded-full p-3 bg-green-100 dark:bg-green-900/30">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Broadcast Duration Card -->
        <div class="bg-gradient-to-r from-gray-600 to-gray-500 dark:bg-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
            <div class="px-6 py-5">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-sm font-medium text-white dark:text-gray-400 mb-1">Broadcast Duration</h3>
                        <div class="flex items-baseline">
                            <p class="text-2xl font-bold text-white dark:text-white">
                                {{ $this->stats['totalDuration'] }} <span class="text-sm font-normal">Days</span>
                            </p>
                        </div>
                    </div>
                    <div class="rounded-full p-3 bg-cyan-100 dark:bg-cyan-900/30">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-cyan-600 dark:text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Remaining Days Card -->
        <div class="bg-gradient-to-r from-gray-600 to-gray-500 dark:bg-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
            <div class="px-6 py-5">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-sm font-medium text-white font- dark:text-gray-400 mb-1">Remaining Days</h3>
                        <div class="flex items-baseline">
                            <p class="text-2xl font-bold text-white dark:text-white">
                                {{ $this->stats['remainingDays'] }} <span class="text-sm font-normal">Days</span>
                            </p>
                        </div>
                    </div>
                    <div class="rounded-full p-3 bg-amber-100 dark:bg-amber-900/30">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-600 dark:text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
