<x-filament-widgets::widget>
    <x-filament::section style="background-color: rgb(24, 26, 59) !important;">
        <x-slot name="header"></x-slot>
        @php
            $user = $this->getUser();
        @endphp
        <div class="bg-gray-900 text-white p-4 rounded-xl flex flex-col gap-4 shadow-md">
            <!-- User Info Section -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 sm:gap-6 w-full">
                <!-- Left Side with Logo and User Info -->
                <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                    <!-- Logo/Avatar -->
                    <div class="flex items-center gap-4 sm:block">
                        @if($user->company_logo)
                            <img src="{{ asset('storage/' . $user->company_logo) }}"
                                 alt="Logo"
                                 class="h-10 sm:h-12 w-10 sm:w-12 rounded-full object-cover flex-shrink-0" />
                        @else
                            <div class="h-10 sm:h-12 w-10 sm:w-12 rounded-full bg-gray-700 flex items-center justify-center text-lg sm:text-xl font-bold flex-shrink-0">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                    <!-- User Info -->
                    <div class="flex flex-col justify-center">
                        <div class="font-semibold text-base sm:text-lg truncate leading-tight">
                            Welcome, {{ $user->name }}
                        </div>
                        <div class="text-xs sm:text-sm text-gray-400 truncate">
                            Client
                        </div>
                    </div>
                </div>

                <!-- Right Side with Sign Out Button -->
                <div class="flex justify-start sm:justify-end">
                    <!-- Sign Out Button -->
                    <a href="{{ route('filament.' . filament()->getCurrentPanel()?->getId() . '.auth.logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="inline-flex items-center justify-center px-3 py-1.5 text-xs font-medium border border-white text-white rounded hover:bg-white hover:text-black transition">
                        <x-heroicon-o-arrow-right-on-rectangle class="w-3 h-3 sm:w-4 sm:h-4 mr-1" />
                        <span>Sign out</span>
                    </a>
                    <!-- Hidden Form for Logout -->
                    <form id="logout-form" method="POST" action="{{ route('filament.' . filament()->getCurrentPanel()?->getId() . '.auth.logout') }}" class="hidden">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
        <x-slot name="footer"></x-slot>
    </x-filament::section>
</x-filament-widgets::widget>
