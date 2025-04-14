<x-filament-widgets::widget>
    <div x-data="{ open: false }" class="relative inline-block">
        <!-- Trigger Button -->
        <button
            @click="open = !open"
            class="flex items-center space-x-2 px-3 py-2 bg-primary-50 dark:bg-gray-800 rounded-lg hover:bg-primary-100 dark:hover:bg-gray-700 transition-colors"
        >
            <x-heroicon-o-funnel class="w-6 h-6 text-primary-500" />
            {{-- <span class="text-xs font-medium">Filter</span> --}}
        </button>

        <!-- Dropdown Content -->
        <div
            x-show="open"
            @click.away="open = false"
            x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="absolute right-0 mt-2 w-72 bg-white dark:bg-gray-800 rounded-md shadow-lg z-50 border border-gray-200 dark:border-gray-700"
            style="display: none;"
        >
            <div class="p-4 space-y-4"> <!-- Ubah p-10 menjadi p-4 untuk padding yang lebih rapi -->
                <div class="grid grid-cols-2 gap-4 px-3"> <!-- Tambahkan px-3 untuk padding horizontal -->
                    {{ $this->form }}
                </div>

                <div class="px-3"> <!-- Tambahkan container dengan padding untuk tombol -->
                    <button
                        wire:click="applyFilters"
                        class="w-full py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-md text-sm font-medium transition-colors"
                    >
                        Terapkan Filter
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-filament-widgets::widget>
