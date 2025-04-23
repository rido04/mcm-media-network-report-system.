<div x-data="{ openFilter: false }" class="flex-shrink-0">
    <!-- Toggle Button (small when closed) -->
    <div
        @click="openFilter = !openFilter"
        class="cursor-pointer bg-gradient-to-r  from-gray-500 to-gray-600 dark:bg-gray-800 rounded-xl p-3 shadow-md transition-all duration-300 hover:shadow-lg"
        :class="openFilter ? 'rounded-b-none' : ''"
    >
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-white">
            <path fill-rule="evenodd" d="M2.628 1.601C5.028 1.206 7.49 1 10 1s4.973.206 7.372.601a.75.75 0 01.628.74v2.288a2.25 2.25 0 01-.659 1.59l-4.682 4.683a2.25 2.25 0 00-.659 1.59v3.037c0 .684-.31 1.33-.844 1.757l-1.937 1.55A.75.75 0 018 18.25v-5.757a2.25 2.25 0 00-.659-1.591L2.659 6.22A2.25 2.25 0 012 4.629V2.34a.75.75 0 01.628-.74z" clip-rule="evenodd" />
        </svg>
    </div>

    <!-- Filter Panel (shown when open) -->
    <div
        x-show="openFilter"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 transform -translate-y-2"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform -translate-y-2"
        class="bg-gradient-to-r from-gray-500 to-gray-600 dark:bg-gray-800 rounded-b-xl shadow-lg"
    >
        <div class="p-5 space-y-5">
            <div>
                <label class="block text-sm font-medium text-white dark:text-gray-300 mb-2">Start Date</label>
                <input type="date" wire:model.defer="filters.start_date" class="w-full pl-3 pr-10 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none" />
            </div>
            <div>
                <label class="block text-sm font-medium text-white dark:text-gray-300 mb-2">End Date</label>
                <input type="date" wire:model.defer="filters.end_date" class="w-full pl-3 pr-10 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none" />
            </div>
            <div>
                <label class="block text-sm font-medium text-white dark:text-gray-300 mb-2">Media</label>
                <input type="text" wire:model.defer="filters.media" placeholder="Enter media name" class="w-full pl-3 pr-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none" />
            </div>
            <div>
                <label class="block text-sm font-medium text-white dark:text-gray-300 mb-2">City</label>
                <input type="text" wire:model.defer="filters.city" placeholder="Enter city name" class="w-full pl-3 pr-3 py-2 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none" />
            </div>
            <div class="flex space-x-3">
                <button wire:click="applyFilters" class="flex-1 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm transition-colors duration-200">
                    Apply
                </button>
                <button wire:click="resetFilters" class="flex-1 px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-white border border-gray-300 dark:border-gray-600 font-medium rounded-lg shadow-sm hover:bg-gray-200 hover:dark:bg-gray-800 transition-colors duration-200">
                    Reset
                </button>
            </div>
        </div>
    </div>
</div>
