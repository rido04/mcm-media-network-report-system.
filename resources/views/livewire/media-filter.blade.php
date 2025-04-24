<!-- resources/views/livewire/media-filter.blade.php (Improved Version) -->

<div class="w-full"
     x-data="{
        activeFilter: null,
        toggleFilter(name) {
            this.activeFilter = this.activeFilter === name ? null : name;
        },
        hasFilters() {
            return $wire.filters.start_date || $wire.filters.end_date || $wire.filters.media || $wire.filters.city;
        }
     }">
    <div class="flex flex-wrap items-center gap-3 mb-4">
        <!-- Date Range Filter -->
        <div class="relative">
            <button @click="toggleFilter('date')"
                    class="flex items-center gap-2 bg-white border border-gray-200 rounded-lg px-3 py-2 text-sm hover:bg-gray-50 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 shadow-sm"
                    :class="{ 'bg-blue-50 border-blue-300 text-blue-700': $wire.filters.start_date || $wire.filters.end_date, 'text-gray-700': !($wire.filters.start_date || $wire.filters.end_date) }">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" :class="{ 'text-blue-500': $wire.filters.start_date || $wire.filters.end_date, 'text-gray-400': !($wire.filters.start_date || $wire.filters.end_date) }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span>{{ $filters['start_date'] ? \Carbon\Carbon::parse($filters['start_date'])->format('M d, Y') : 'Start Date' }} - {{ $filters['end_date'] ? \Carbon\Carbon::parse($filters['end_date'])->format('M d, Y') : 'End Date' }}</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" :class="{ 'text-blue-500': $wire.filters.start_date || $wire.filters.end_date, 'text-gray-400': !($wire.filters.start_date || $wire.filters.end_date) }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div x-show="activeFilter === 'date'"
                 @click.outside="activeFilter = null"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 transform -translate-y-2"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 transform translate-y-0"
                 x-transition:leave-end="opacity-0 transform -translate-y-2"
                 class="absolute z-50 mt-2 bg-white rounded-lg shadow-xl p-5 w-72"
                 style="display: none;">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                        <input type="date" wire:model.defer="filters.start_date" class="w-full pl-3 pr-10 py-2 border border-gray-200 rounded-lg text-gray-700 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none text-sm" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                        <input type="date" wire:model.defer="filters.end_date" class="w-full pl-3 pr-10 py-2 border border-gray-200 rounded-lg text-gray-700 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none text-sm" />
                    </div>
                    <div class="flex justify-between pt-2">
                        <button wire:click="clearDateFilter" @click="activeFilter = null" class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors duration-200 focus:outline-none">
                            Clear
                        </button>
                        <button wire:click="applyFilters" @click="activeFilter = null" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                            Apply
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Media Plan Filter -->
        <div class="relative">
            <button @click="toggleFilter('media')"
                    class="flex items-center gap-2 bg-white border border-gray-200 rounded-lg px-3 py-2 text-sm hover:bg-gray-50 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 shadow-sm"
                    :class="{ 'bg-blue-50 border-blue-300 text-blue-700': $wire.filters.media, 'text-gray-700': !$wire.filters.media }">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" :class="{ 'text-blue-500': $wire.filters.media, 'text-gray-400': !$wire.filters.media }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2" />
                </svg>
                <span x-text="$wire.filters.media ? 'Media Plan (' + $wire.mediaOptions[$wire.filters.media] + ')' : 'Media Plan'"></span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" :class="{ 'text-blue-500': $wire.filters.media, 'text-gray-400': !$wire.filters.media }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div x-show="activeFilter === 'media'"
                 @click.outside="activeFilter = null"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 transform -translate-y-2"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 transform translate-y-0"
                 x-transition:leave-end="opacity-0 transform -translate-y-2"
                 class="absolute z-50 mt-2 bg-white rounded-lg shadow-xl p-5 w-72"
                 style="display: none;">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Media Plan</label>
                    <div class="relative">
                        <select wire:model.defer="filters.media" class="w-full pl-3 pr-10 py-2 border border-gray-200 rounded-lg text-gray-700 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none text-sm appearance-none">
                            <option value="">All Media Plans</option>
                            @foreach($mediaOptions as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex justify-between pt-4">
                        <button wire:click="clearMediaFilter" @click="activeFilter = null" class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors duration-200 focus:outline-none">
                            Clear
                        </button>
                        <button wire:click="applyFilters" @click="activeFilter = null" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                            Apply
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- City & District Filter -->
        <div class="relative">
            <button @click="toggleFilter('city')"
                    class="flex items-center gap-2 bg-white border border-gray-200 rounded-lg px-3 py-2 text-sm hover:bg-gray-50 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 shadow-sm"
                    :class="{ 'bg-blue-50 border-blue-300 text-blue-700': $wire.filters.city, 'text-gray-700': !$wire.filters.city }">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" :class="{ 'text-blue-500': $wire.filters.city, 'text-gray-400': !$wire.filters.city }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                <span x-text="$wire.filters.city ? 'City (' + $wire.cityOptions[$wire.filters.city] + ')' : 'City & District'"></span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" :class="{ 'text-blue-500': $wire.filters.city, 'text-gray-400': !$wire.filters.city }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div x-show="activeFilter === 'city'"
                 @click.outside="activeFilter = null"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 transform -translate-y-2"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 transform translate-y-0"
                 x-transition:leave-end="opacity-0 transform -translate-y-2"
                 class="absolute z-50 mt-2 bg-white rounded-lg shadow-xl p-5 w-72"
                 style="display: none;">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">City</label>
                    <div class="relative">
                        <select wire:model.defer="filters.city" class="w-full pl-3 pr-10 py-2 border border-gray-200 rounded-lg text-gray-700 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none text-sm appearance-none">
                            <option value="">All Cities</option>
                            @foreach($cityOptions as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex justify-between pt-4">
                        <button wire:click="clearCityFilter" @click="activeFilter = null" class="px-3 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors duration-200 focus:outline-none">
                            Clear
                        </button>
                        <button wire:click="applyFilters" @click="activeFilter = null" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                            Apply
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Active Filter Badges -->
        <div class="flex flex-wrap gap-2" x-show="hasFilters()">
            <div x-show="$wire.filters.start_date || $wire.filters.end_date" class="bg-blue-50 text-blue-700 px-2 py-1 rounded-md text-xs font-medium flex items-center">
                <span>Date Range</span>
                <button wire:click="clearDateFilter" class="ml-1 text-blue-500 hover:text-blue-700 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div x-show="$wire.filters.media" class="bg-blue-50 text-blue-700 px-2 py-1 rounded-md text-xs font-medium flex items-center">
                <span x-text="'Media: ' + $wire.mediaOptions[$wire.filters.media]"></span>
                <button wire:click="clearMediaFilter" class="ml-1 text-blue-500 hover:text-blue-700 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div x-show="$wire.filters.city" class="bg-blue-50 text-blue-700 px-2 py-1 rounded-md text-xs font-medium flex items-center">
                <span x-text="'City: ' + $wire.cityOptions[$wire.filters.city]"></span>
                <button wire:click="clearCityFilter" class="ml-1 text-blue-500 hover:text-blue-700 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Reset Button -->
        <button wire:click="resetFilters"
                x-show="hasFilters()"
                class="ml-auto bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-lg px-3 py-2 text-sm flex items-center gap-1 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
            </svg>
            <span>Reset All</span>
        </button>
    </div>

    <!-- Active Filters Summary -->
    <div x-show="hasFilters()" class="mb-4 bg-gray-50 border border-gray-200 rounded-lg p-3">
        <div class="text-sm text-gray-700 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>Active filters:</span>
            <div class="ml-2 space-x-1">
                <span x-show="$wire.filters.start_date || $wire.filters.end_date" class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-0.5 rounded">
                    {{ $filters['start_date'] ? \Carbon\Carbon::parse($filters['start_date'])->format('M d, Y') : now()->startOfYear()->format('M d, Y') }} -
                    {{ $filters['end_date'] ? \Carbon\Carbon::parse($filters['end_date'])->format('M d, Y') : now()->endOfYear()->format('M d, Y') }}
                </span>
                <span x-show="$wire.filters.media" class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-0.5 rounded">
                    Media: {{ $mediaOptions[$filters['media']] ?? 'Unknown' }}
                </span>
                <span x-show="$wire.filters.city" class="bg-blue-100 text-blue-800 text-xs font-medium px-2 py-0.5 rounded">
                    City: {{ $cityOptions[$filters['city']] ?? 'Unknown' }}
                </span>
            </div>
        </div>
    </div>
</div>
