<x-filament-widgets::widget>
    <x-filament::section>
        <div class="p-4 bg-grey-100 rounded-lg">
            <div x-data="{ open: false }" class="relative">
                <!-- Tombol atau Ikon -->
                <button @click="open = !open" class="p-2 bg-blue-500 text-blue rounded-full">
                    <x-heroicon-o-funnel class="w-6 h-6" /> <!-- Gunakan ikon filter -->
                </button>

                <!-- Form Filter -->
                <div
                    x-show="open"
                    @click.away="open = false"
                    class="absolute top-10 right-0 bg-black shadow-lg rounded-lg p-4 z-50 w-80"
                    style="display: none;"
                >
                    <h3 class="text-lg font-bold mb-4">Filter Statistik</h3>
                    {{ $this->form }}
                    <button
                        wire:click="applyFilters"
                        class="mt-4 bg-primary-500 text-white px-4 py-2 rounded-lg"
                    >
                        Terapkan Filter
                    </button>
                </div>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
