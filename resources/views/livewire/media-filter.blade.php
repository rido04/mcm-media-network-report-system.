<!-- resources/views/livewire/media-filter.blade.php -->

<div class="bg-gray-600 rounded-lg p-4 w-full"
     x-data="{
        activeFilter: null,
        toggleFilter(name) {
            this.activeFilter = this.activeFilter === name ? null : name;
        }
     }">
    <div class="flex flex-wrap items-center gap-2">
        <!-- Date Range Filter -->
        <div class="relative">
            <button @click="toggleFilter('date')" class="flex items-center gap-2 bg-white border border-gray-200 rounded-md px-3 py-2 text-sm text-gray-700 hover:bg-gray-50">
                <span>{{ $filters['start_date'] ?? now()->startOfYear()->format('Y-m-d') }} - {{ $filters['end_date'] ?? now()->endOfYear()->format('Y-m-d') }}</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
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
                 class="absolute z-50 mt-1 bg-white rounded-md shadow-lg p-4 w-64">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                        <input type="date" wire:model.defer="filters.start_date" class="w-full pl-3 pr-10 py-2 border border-gray-200 rounded-lg text-gray-700 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none text-sm" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                        <input type="date" wire:model.defer="filters.end_date" class="w-full pl-3 pr-10 py-2 border border-gray-200 rounded-lg text-gray-700 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none text-sm" />
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button wire:click="applyFilters" @click="activeFilter = null" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors duration-200">
                            Apply
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Media Plan Filter -->
        <div class="relative">
            <button @click="toggleFilter('media')" class="flex items-center gap-2 bg-white border border-gray-200 rounded-md px-3 py-2 text-sm text-gray-700 hover:bg-gray-50">
                <span>Media Plan {{ $filters['media'] ? '(1)' : '' }}</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                 class="absolute z-50 mt-1 bg-white rounded-md shadow-lg p-4 w-64">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Media Plan</label>
                    <select wire:model.defer="filters.media" class="w-full pl-3 pr-10 py-2 border border-gray-200 rounded-lg text-gray-700 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none text-sm">
                        <option value="">All Media Plans</option>
                        @foreach($mediaOptions as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                    <div class="flex justify-end space-x-2 mt-4">
                        <button wire:click="applyFilters" @click="activeFilter = null" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors duration-200">
                            Apply
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- City & District Filter -->
        <div class="relative">
            <button @click="toggleFilter('city')" class="flex items-center gap-2 bg-white border border-gray-200 rounded-md px-3 py-2 text-sm text-gray-700 hover:bg-gray-50">
                <span>City & District {{ $filters['city'] ? '(1)' : '' }}</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                 class="absolute z-50 mt-1 bg-white rounded-md shadow-lg p-4 w-64">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">City</label>
                    <select wire:model.defer="filters.city" class="w-full pl-3 pr-10 py-2 border border-gray-200 rounded-lg text-gray-700 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none text-sm">
                        <option value="">All Cities</option>
                        @foreach($cityOptions as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                    <div class="flex justify-end space-x-2 mt-4">
                        <button wire:click="applyFilters" @click="activeFilter = null" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors duration-200">
                            Apply
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reset Button -->
        <button wire:click="resetFilters" class="bg-white border border-gray-200 rounded-md px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 flex items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
            </svg>
            <span>Reset</span>
        </button>
    </div>
</div>
