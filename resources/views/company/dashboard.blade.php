 @php
    $user = auth()->user();
 @endphp
<div x-data="{ openFilter: false }" class="container mx-auto p-4 bg-slate-950 dark:bg-slate-950">
    <!-- Header with User Info Section -->
    <div class="bg-gradient-to-r from-gray-600 to-gray-500 rounded-xl shadow-md p-4 mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 sm:gap-6 w-full">
            <!-- Left Side with Logo and User Info -->
            <div class="flex items-center gap-4">
                <!-- Logo/Avatar -->
                <div>
                    @if($user->company_logo)
                        <img src="{{ asset('storage/' . $user->company_logo) }}"
                             alt="Logo"
                             class="h-12 w-12 rounded-full object-cover border-2 border-blue-100 dark:border-blue-800 shadow-sm" />
                    @else
                        <div class="h-12 w-12 rounded-full bg-gradient-to-r from-blue-500 to-blue-700 text-indigo-300 flex items-center justify-center text-xl font-bold shadow-sm">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif
                </div>

                <!-- User Info -->
                <div class="flex flex-col justify-center">
                    <div class="font-semibold text-lg leading-tight text-white dark:text-indigo-300">
                        Welcome, {{ $user->name }}
                    </div>
                    <div class="text-m  text-white dark:text-gray-300">
                        {{ $user->email }}
                    </div>
                </div>
            </div>

            <!-- Company Info with Badge Design -->
            <div class="flex items-center bg-slate-800 dark:bg-gray-700 px-4 py-2 rounded-lg">
                <img
                src="{{ asset('storage/image/logo_mcm.png') }}"
                alt="MCM Media Network"
                class="h-12 w-12 rounded-full object-cover border-2 border-blue-100 dark:border-blue-800 shadow-sm" />

                <div>
                    <span class="text-m font-semibold text-white dark:text-white ml-4">MCM Media Network</span>
                    <div class="font-medium text-gray-800 dark:text-indigo-300"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards Row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">
        <!-- Media Plan Card -->
        <div class="bg-gradient-to-r from-gray-600 to-gray-500 dark:bg-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
            <div class="px-6 py-5">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-sm font-medium text-white font- dark:text-gray-400 mb-1">Media Plan</h3>
                        <div class="flex items-baseline">
                            <p class="text-2xl font-bold text-white dark:text-white">
                                {{ $this->stats['totalMediaPlan'] }}
                            </p>
                        </div>
                    </div>
                    <div class="rounded-full p-3 bg-blue-100 dark:bg-blue-900/30">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Media Placement Card -->
        <div class="bg-gradient-to-r from-gray-600 to-gray-500 dark:bg-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
            <div class="px-6 py-5">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-sm font-medium text-white font- dark:text-gray-400 mb-1">Media Placement</h3>
                        <div class="flex items-baseline">
                            <p class="text-2xl font-bold text-white dark:text-white">
                                {{ $this->stats['totalInventory'] }}
                            </p>
                        </div>
                    </div>
                    <div class="rounded-full p-3 bg-green-100 dark:bg-green-900/30">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Broadcast Duration Card -->
        <div class="bg-gradient-to-r from-gray-600 to-gray-500 dark:bg-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
            <div class="px-6 py-5">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-sm font-medium text-white dark:text-gray-400 mb-1">Broadcast Duration</h3>
                        <div class="flex items-baseline">
                            <p class="text-2xl font-bold text-white dark:text-white">
                                {{ $this->stats['totalDuration'] }} <span class="text-sm font-normal">Days</span>
                            </p>
                        </div>
                    </div>
                    <div class="rounded-full p-3 bg-cyan-100 dark:bg-cyan-900/30">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-cyan-600 dark:text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Remaining Days Card -->
        <div class="bg-gradient-to-r from-gray-600 to-gray-500 dark:bg-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
            <div class="px-6 py-5">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-sm font-medium text-white font- dark:text-gray-400 mb-1">Remaining Days</h3>
                        <div class="flex items-baseline">
                            <p class="text-2xl font-bold text-white dark:text-white">
                                {{ $this->stats['remainingDays'] }} <span class="text-sm font-normal">Days</span>
                            </p>
                        </div>
                    </div>
                    <div class="rounded-full p-3 bg-amber-100 dark:bg-amber-900/30">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-600 dark:text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter and Content Area -->
    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Filter Panel -->
        <div class="bg-gradient-to-r from-gray-500 to-gray-600 dark:bg-gray-800 rounded-xl shadow-md transition-all duration-300 flex-shrink-0"
             :class="openFilter ? 'lg:w-80 w-full' : 'w-auto'">
            <!-- Filter Header -->
            <div @click="openFilter = !openFilter"
                 class="flex items-center justify-between cursor-pointer px-5 py-4 border-b border-gray-100 dark:border-gray-700">
                <div class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                         class="w-5 h-5 text-slate-800 dark:text-slate-800">
                        <path fill-rule="evenodd" d="M2.628 1.601C5.028 1.206 7.49 1 10 1s4.973.206 7.372.601a.75.75 0 01.628.74v2.288a2.25 2.25 0 01-.659 1.59l-4.682 4.683a2.25 2.25 0 00-.659 1.59v3.037c0 .684-.31 1.33-.844 1.757l-1.937 1.55A.75.75 0 018 18.25v-5.757a2.25 2.25 0 00-.659-1.591L2.659 6.22A2.25 2.25 0 012 4.629V2.34a.75.75 0 01.628-.74z" clip-rule="evenodd" />
                    </svg>
                    <span class="font-semibold text-white dark:text-gray-200">Filter Options</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                     class="w-5 h-5 text-slate-800 dark:text-slate-800 transition-transform duration-300"
                     :class="openFilter ? 'transform rotate-180' : ''">
                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                </svg>
            </div>

            <!-- Filter Content -->
            <div x-show="openFilter"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 transform -translate-y-2"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 transform translate-y-0"
                 x-transition:leave-end="opacity-0 transform -translate-y-2"
                 class="p-5 space-y-5">

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Start Date</label>
                    <div class="relative">
                        <input type="date" wire:model.defer="filters.start_date"
                              class="w-full pl-3 pr-10 py-3 border border-gray-200 dark:border-gray-600 rounded-lg
                                     text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700
                                     focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none" />
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">End Date</label>
                    <div class="relative">
                        <input type="date" wire:model.defer="filters.end_date"
                              class="w-full pl-3 pr-10 py-3 border border-gray-200 dark:border-gray-600 rounded-lg
                                     text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700
                                     focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none" />
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Media</label>
                    <div class="relative">
                        <input type="text" wire:model.defer="filters.media" placeholder="Enter media name"
                              class="w-full pl-3 pr-3 py-3 border border-gray-200 dark:border-gray-600 rounded-lg
                                     text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700
                                     focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none" />
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">City</label>
                    <div class="relative">
                        <input type="text" wire:model.defer="filters.city" placeholder="Enter city name"
                              class="w-full pl-3 pr-3 py-3 border border-gray-200 dark:border-gray-600 rounded-lg
                                     text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700
                                     focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none" />
                    </div>
                </div>
                <button wire:click="applyFilters"
                       class="w-full flex items-center justify-center px-4 py-3 bg-blue-600 hover:bg-blue-700
                              text-white font-medium rounded-lg shadow-sm transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Apply Filters
                </button>
                <button wire:click="resetFilters"
                       class="w-full flex items-center justify-center px-4 py-2 mt-2 bg-gray-100 dark:bg-gray-700
                              text-gray-700 dark:text-gray-200 font-medium rounded-lg shadow-sm hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Reset Filters
                </button>
            </div>
        </div>

            {{-- Chart for Avaliablity Placement --}}
        <div class="bg-gradient-to-r from-gray-600 to-gray-500 dark:bg-gray-800 rounded-xl shadow-md p-5 w-full min-h-96">
            <div>
                <label class="block mb-2 font-medium text-sm text-white">Filter City:</label>
                <select wire:model="chartFilter" class="rounded border-gray-300 mb-4 ">
                    <option value="all">All Cities</option>
                    @foreach(\App\Models\MediaStatistic::where('user_id', auth()->id())->select('city')->distinct()->pluck('city') as $city)
                    <option value="{{ $city }}">{{ $city }}</option>
                    @endforeach
                </select>
                <canvas id="adPerformanceChart" class="w-full max-h-[300px] "></canvas>
                @push('scripts')
                @vite('resources/js/adPerformance.js')
            <script>
                        document.addEventListener('DOMContentLoaded', () => {
                            initAdChart(@json($this->chartData));
                        });

                        Livewire.on('refreshChart', data => {
                            renderAdPerformanceChart('adPerformanceChart', data);
                        });
                    </script>
                @endpush
            </div>
        </div>
    </div>
</div>
