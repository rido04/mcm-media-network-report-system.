<x-filament-widgets::widget>
    <x-filament::section>
        <div class="p-4 bg-grey-100 rounded-lg">
            <form wire:submit.prevent="applyFilters" class="space-y-4">
                {{ $this->form }}

                <div class="flex justify-end">
                    <button
                        type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-primary-600 rounded-lg hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                        Terapkan Filter
                    </button>
                </div>
            </form>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
