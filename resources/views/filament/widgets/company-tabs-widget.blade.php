<!-- resources/views/filament/widgets/media-dashboard.blade.php -->
<x-filament-widgets::widget>
    <x-filament::card>
        <x-filament::tabs>
            @foreach($this->getTabs() as $tabKey => $tab)
                <x-filament::tabs.item 
                    wire:click="$set('activeTab', '{{ $tabKey }}')"
                    :active="$activeTab === $tabKey"
                    :icon="$tab['icon']"
                >
                    {{ $tab['label'] }}
                </x-filament::tabs.item>
            @endforeach
        </x-filament::tabs>

        <div class="p-6">
            {{ $this->getTabs()[$activeTab]['content'] }}
        </div>
    </x-filament::card>
</x-filament-widgets::widget>