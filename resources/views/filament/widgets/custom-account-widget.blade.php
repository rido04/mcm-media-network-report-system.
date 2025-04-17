<x-filament-widgets::widget>
    <x-filament::section style="background-color: rgb(24, 26, 59) !important;">
        
        @php
            $user = $this->getUser();
        @endphp

        <div class="bg-gray-900 text-white p-4 rounded-xl flex flex-col sm:flex-row items-center justify-between gap-4 shadow-md">
            <!-- User Info Section - Perubahan utama di sini -->
            <div class="flex items-center space-x-4 w-full sm:w-auto">
                @if($user->company_logo)
                    <img src="{{ asset('storage/' . $user->company_logo) }}"
                         alt="Logo"
                         class="h-10 w-10 sm:h-12 sm:w-12 rounded-full object-cover flex-shrink-0 mr-4" /> <!-- Tambahkan mr-4 -->
                @else
                    <div class="h-10 w-10 sm:h-12 sm:w-12 rounded-full bg-gray-700 flex items-center justify-center text-lg sm:text-xl font-bold flex-shrink-0 mr-4">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                @endif

                <div class="min-w-0 flex flex-col justify-center"> <!-- Tambahkan flex-col justify-center -->
                    <div class="font-semibold text-sm sm:text-lg truncate leading-tight"> <!-- Tambahkan leading-tight -->
                        Welcome, {{ $user->name }}
                    </div>
                    <div class="text-xs sm:text-sm text-gray-400 truncate mt-0.5"> <!-- Tambahkan mt-0.5 -->
                        Client
                    </div>
                </div>
            </div>

            <!-- Logout Button (tetap sama) -->
            <form method="POST" action="{{ route('filament.' . filament()->getCurrentPanel()?->getId() . '.auth.logout') }}"
                  class="w-full sm:w-auto">
                @csrf
                <button type="submit"
                    class="w-full sm:w-auto inline-flex items-center justify-center px-3 py-2 text-xs sm:text-sm font-semibold border border-white text-white rounded-lg hover:bg-white hover:text-black transition">
                    <x-heroicon-o-arrow-right-on-rectangle class="w-4 h-4 sm:w-5 sm:h-5 mr-1" />
                    <span>Sign out</span>
                </button>
            </form>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
