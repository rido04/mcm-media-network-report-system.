<x-filament-widgets::widget>
    <x-filament::section style="background-color: rgb(24, 26, 59) !important;">
        <x-slot name="header"></x-slot>
        <div class="bg-gray-900 text-white p-4 rounded-xl flex flex-col sm:flex-row items-center justify-between shadow-md">
            <!-- Logo and Company Name -->
            <div class="flex items-center gap-3 mb-3 sm:mb-0">
                <img
                    src="{{ asset('storage/image/logo_mcm.png') }}"
                    alt="MCM Media Network"
                    class="h-10 w-auto"
                >
                <span class="text-base sm:text-lg font-medium text-white">MCM Media Network</span>
            </div>
        </div>
        <x-slot name="footer"></x-slot>
    </x-filament::section>
</x-filament-widgets::widget>
