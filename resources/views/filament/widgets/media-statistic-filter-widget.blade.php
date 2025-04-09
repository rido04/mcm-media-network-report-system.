<x-filament-widgets::widget>
    <x-filament::section>
        <div>
            <form wire:submit.prevent="applyFilters" class="space-y-4">
                {{ $this->form }}
                <div>
                    <button type="submit" class="btn btn-primary">Terapkan Filter</button>
                </div>
            </form>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
