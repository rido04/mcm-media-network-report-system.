<div x-data="{ tab: 'media_placement' }" class="transition-all duration-1000 ">
    <!-- Enhanced Tab Navigation with Indicator Animation -->
    <div class="relative mb-6 transition-all duration-1000 ease-out transform opacity-0 translate-y-4"
     x-data="{
         shown: false,
         init() {
             const observer = new IntersectionObserver((entries) => {
                 entries.forEach(entry => {
                     this.shown = entry.isIntersecting;
                     if (entry.isIntersecting) observer.unobserve(this.$el);
                 });
             });
             observer.observe(this.$el);
         }
     }"
     x-bind:class="{
         'opacity-100 translate-y-0': shown,
         'opacity-0 translate-y-4': !shown
     }">
        <div class="border-b border-gray-500 dark:border-gray-700 overflow-x-auto scrollbar-hide">
            <div class="flex space-x-4 min-w-max">
                <button @click="tab = 'media_placement'"
                        :class="tab === 'media_placement' ? 'text-blue-600 dark:text-blue-400 font-semibold' : 'text-white dark:text-gray-400 hover:text-blue-200 dark:hover:text-gray-200'"
                        class="relative py-3 px-4 focus:outline-none transition-colors whitespace-nowrap group">
                    Media Placement
                    <span :class="tab === 'media_placement' ? 'w-full' : 'w-0 group-hover:w-full'"
                          class="absolute bottom-0 left-0 h-0.5 bg-blue-600 dark:bg-blue-400 transition-all duration-1000"></span>
                </button>
                <button @click="tab = 'media_statistics'"
                        :class="tab === 'media_statistics' ? 'text-blue-600 dark:text-blue-400 font-semibold' : 'text-white dark:text-gray-400 hover:text-blue-200 dark:hover:text-gray-200'"
                        class="relative py-3 px-4 focus:outline-none transition-colors whitespace-nowrap group">
                    Media Plan
                    <span :class="tab === 'media_statistics' ? 'w-full' : 'w-0 group-hover:w-full'"
                          class="absolute bottom-0 left-0 h-0.5 bg-blue-600 dark:bg-blue-400 transition-all duration-1000"></span>
                </button>
                <button @click="tab = 'play_log'"
                        :class="tab === 'play_log' ? 'text-blue-600 dark:text-blue-400 font-semibold' : 'text-white dark:text-gray-400 hover:text-blue-200 dark:hover:text-gray-200'"
                        class="relative py-3 px-4 focus:outline-none transition-colors whitespace-nowrap group">
                    Play Log
                    <span :class="tab === 'play_log' ? 'w-full' : 'w-0 group-hover:w-full'"
                          class="absolute bottom-0 left-0 h-0.5 bg-blue-600 dark:bg-blue-400 transition-all duration-1000"></span>
                </button>
                <button @click="tab = 'documentation'"
                        :class="tab === 'documentation' ? 'text-blue-600 dark:text-blue-400 font-semibold' : 'text-white dark:text-gray-400 hover:text-blue-200 dark:hover:text-gray-200'"
                        class="relative py-3 px-4 focus:outline-none transition-colors whitespace-nowrap group">
                    Documentation
                    <span :class="tab === 'documentation' ? 'w-full' : 'w-0 group-hover:w-full'"
                          class="absolute bottom-0 left-0 h-0.5 bg-blue-600 dark:bg-blue-400 transition-all duration-1000"></span>
                </button>
            </div>
        </div>
    </div>

    <!-- Media Placement Tab -->
    <div x-show="tab === 'media_placement'" x-transition:enter="transition ease-out duration-1000"
         x-transition:enter-start="opacity-0 translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-2" x-cloak>
        <div class="overflow-x-auto rounded-md border border-gray-500 dark:border-gray-700 shadow-sm">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-slate-800">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white dark:text-white uppercase tracking-wider">Media</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white dark:text-white uppercase tracking-wider">Category</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white dark:text-white uppercase tracking-wider">Space Ads</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white dark:text-white uppercase tracking-wider">Size</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white dark:text-white uppercase tracking-wider">Avg daily Impression</th>
                    </tr>
                </thead>
                <tbody class="bg-slate-700 dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($mediaPlacement as $item)
                    <tr class="hover:bg-indigo-400 dark:hover:bg-gray-700/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white dark:text-white">{{ $item->media ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white dark:text-white">{{ $item->adminTraffic->category ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white dark:text-white">{{ $item->space_ads ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white dark:text-white">{{ $item->size ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white dark:text-white">
                            {{ number_format($item->avg_daily_impression, 0, ',', '.') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">No Media Placement found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Media Plan Tab -->
    <div x-show="tab === 'media_statistics'" x-transition:enter="transition ease-out duration-1000"
         x-transition:enter-start="opacity-0 translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-2" x-cloak>
        <div class="overflow-x-auto border rounded-md border-gray-600 dark:border-gray-700 shadow-sm">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-slate-800">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white dark:text-white uppercase tracking-wider">Media Plan</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white dark:text-white uppercase tracking-wider">Start Date</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white dark:text-white uppercase tracking-wider">End Date</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white dark:text-white uppercase tracking-wider">Duration</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white dark:text-white uppercase tracking-wider">Total Impression</th>
                    </tr>
                </thead>
                <tbody class="bg-slate-700 dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($mediaStatistics as $item)
                    <tr class="hover:bg-indigo-300 dark:hover:bg-gray-700/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white dark:text-white">{{ $item->media }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white dark:text-white">{{ \Carbon\Carbon::parse($item->start_date)->format('d M Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white dark:text-white">{{ \Carbon\Carbon::parse($item->end_date)->format('d M Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white dark:text-white">
                            {{ \Carbon\Carbon::parse($item->start_date)->diffInDays($item->end_date) }} days
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white dark:text-white">
                            {{ number_format($item->dailyImpressions->sum('impression') ?? 0, 0, ',', '.') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">No Media Plans found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Play Log Tab -->
    <div x-show="tab === 'play_log'" x-transition:enter="transition ease-out duration-1000"
         x-transition:enter-start="opacity-0 translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-2" x-cloak>
        <div class="overflow-x-auto border rounded-md border-gray-600 dark:border-gray-700 shadow-sm">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-slate-800">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white dark:text-white uppercase tracking-wider">Device ID</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white dark:text-white uppercase tracking-wider">Media Name</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white dark:text-white uppercase tracking-wider">Play Date</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white dark:text-white uppercase tracking-wider">Longitude</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white dark:text-white uppercase tracking-wider">Latitude</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white dark:text-white uppercase tracking-wider">Location</th>
                    </tr>
                </thead>
                <tbody class="bg-slate-700 dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($playLogs as $log)
                    <tr class="hover:bg-indigo-300 dark:hover:bg-gray-700/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-white dark:text-white">{{ $log->device_id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white dark:text-white">{{ $log->media_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white dark:text-white">
                            {{ \Carbon\Carbon::parse($log->play_date)->format('d M Y H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white dark:text-white">
                            {{ $log->longitude }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white dark:text-white">
                            {{ $log->latitude }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-white dark:text-white">
                            {{ $log->location ?? $log->latitude.', '.$log->longitude }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">No Play Logs found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Documentation Tab -->
    <div x-show="tab === 'documentation'" x-transition:enter="transition ease-out duration-1000"
         x-transition:enter-start="opacity-0 translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-2" x-cloak>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($documentations as $doc)
            <div class="group bg-slate-800 rounded-md shadow-md overflow-hidden border border-gray-600 dark:border-gray-600 hover:shadow-lg transition-all duration-1000 hover:-translate-y-1">
                <div class="relative h-48 overflow-hidden">
                    <img src="{{ asset('storage/' . $doc->image_path) }}"
                         alt="{{ $doc->description }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-1000"></div>
                </div>
                <div class="p-4">
                    <h4 class="text-sm font-medium text-white dark:text-white line-clamp-2">{{ $doc->description }}</h4>
                    <div class="mt-3 flex items-center justify-between text-xs text-white">
                        <span>Client: {{ $doc->user->name ?? '-' }}</span>
                        <span>{{ $doc->created_at->format('d M Y') }}</span>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-3 py-12 text-center">
                <div class="mx-auto max-w-md p-6 bg-slate-800/50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="mt-4 text-sm font-medium text-white dark:text-white">No documentation available</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Upload your first documentation to get started.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>
