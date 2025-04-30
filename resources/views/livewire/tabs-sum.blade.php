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
        <div class="border-b border-gray-600 dark:border-gray-700 overflow-x-auto scrollbar-hide">
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
    <div id="media-placement-grid" class="my-4"></div>
</div>

<!-- Media Plan Tab -->
<div x-show="tab === 'media_statistics'" x-transition:enter="transition ease-out duration-1000"
     x-transition:enter-start="opacity-0 translate-y-2"
     x-transition:enter-end="opacity-100 translate-y-0"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 translate-y-0"
     x-transition:leave-end="opacity-0 translate-y-2" x-cloak>
    <div id="media-statistics-grid" class="my-4"></div>
</div>

<!-- Play Log Tab -->
<div x-show="tab === 'play_log'" x-transition:enter="transition ease-out duration-1000"
     x-transition:enter-start="opacity-0 translate-y-2"
     x-transition:enter-end="opacity-100 translate-y-0"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 translate-y-0"
     x-transition:leave-end="opacity-0 translate-y-2" x-cloak>
    <div id="play-log-grid" class="my-4"></div>
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
            <div class="group bg-slate-800 shadow-md overflow-hidden border border-gray-600 dark:border-gray-600 hover:shadow-lg transition-all duration-1000 hover:-translate-y-1">
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
<script>
    // Convert PHP collections to JSON and escape properly
    const mediaPlacementData = {!! json_encode($mediaPlacement->map(function($item) {
        return [
            'media' => $item->media ?? '-',
            'category' => $item->adminTraffic->category ?? '-',
            'space_ads' => $item->space_ads ?? '-',
            'size' => $item->size ?? '-',
            'avg_daily_impression' => $item->avg_daily_impression ?? 0
        ];
    })) !!};

    const mediaStatisticsData = {!! json_encode($mediaStatistics->map(function($item) {
        return [
            'media' => $item->media,
            'start_date' => \Carbon\Carbon::parse($item->start_date)->format('d M Y'),
            'end_date' => \Carbon\Carbon::parse($item->end_date)->format('d M Y'),
            'duration' => \Carbon\Carbon::parse($item->start_date)->diffInDays($item->end_date) . ' days',
            'total_impression' => $item->dailyImpressions->sum('impression') ?? 0
        ];
    })) !!};

    const playLogsData = {!! json_encode($playLogs->map(function($log) {
        return [
            'device_id' => $log->device_id,
            'media_name' => $log->media_name,
            'play_date' => \Carbon\Carbon::parse($log->play_date)->format('d M Y H:i'),
            'longitude' => $log->longitude,
            'latitude' => $log->latitude,
            'location' => $log->location ?? $log->latitude + ', ' + $log->longitude
        ];
    })) !!};

    // Initialize grids when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Media Placement Grid
        new window.gridjs.Grid({
            columns: [
                'Media',
                'Category',
                'Space Ads',
                'Size',
                {
                    name: 'Avg Daily Impression',
                    formatter: (cell) => gridjs.html(`<span>${new Intl.NumberFormat().format(cell)}</span>`)
                }
            ],
            data: mediaPlacementData.map(item => [
                item.media,
                item.category,
                item.space_ads,
                item.size,
                item.avg_daily_impression
            ]),
            search: true,
            pagination: true,
            resizable:true,
            style: {
                table: { 'white-space': 'nowrap' },
                th: {
                    'background-color': '#1e293b',
                    color: '#fff',
                    padding: '0.75rem 1.5rem'
                },
                td: { padding: '0.75rem 1.5rem',
                    'background-color' : '#f1f1f1'
                 }
            },
            className: {
                table: 'w-full bg-slate-700',
                thead: 'bg-slate-800',
                tbody: 'divide-y divide-gray-600',
                tr: 'hover:bg-indigo-400 dark:hover:bg-gray-700/50',
                th: 'text-left text-xs font-medium uppercase tracking-wider',
                td: 'text-sm text-black whitespace-nowrap',
                footer : 'bg-[#f1f1f1]'
            }
        }).render(document.getElementById('media-placement-grid'));

        // Media Statistics Grid (similar structure)
        new window.gridjs.Grid({
            columns: [
                'Media Plan',
                'Start Date',
                'End Date',
                'Duration',
                {
                    name: 'Total Impression',
                    formatter: (cell) => gridjs.html(`<span>${new Intl.NumberFormat().format(cell)}</span>`)
                }
            ],
            data: mediaStatisticsData.map(item => [
                item.media,
                item.start_date,
                item.end_date,
                item.duration,
                item.total_impression
            ]),
            search: true,
            pagination: true,
            resizable:true,
            style: {
                table: { 'white-space': 'nowrap' },
                th: {
                    'background-color': '#1e293b',
                    color: '#fff',
                    padding: '0.75rem 1.5rem'
                },
                td: { padding: '0.75rem 1.5rem',
                    'background-color' : '#f1f1f1'
                 }
            },
            className: {
                table: 'w-full bg-slate-700',
                thead: 'bg-slate-800',
                tbody: 'divide-y divide-gray-600',
                tr: 'hover:bg-indigo-400 dark:hover:bg-gray-700/50',
                th: 'text-left text-xs font-medium uppercase tracking-wider',
                td: 'text-sm text-black whitespace-nowrap'
            }
        }).render(document.getElementById('media-statistics-grid'));

        // Play Log Grid (similar structure)
        new window.gridjs.Grid({
            columns: [
                'Device ID',
                'Media Name',
                'Play Date',
                'Longitude',
                'Latitude',
                'Location'
            ],
            data: playLogsData.map(item => [
                item.device_id,
                item.media_name,
                item.play_date,
                item.longitude,
                item.latitude,
                item.location
            ]),
            search: true,
            pagination: true,
            resizable:true,
            style: {
                table: { 'white-space': 'nowrap' },
                th: {
                    'background-color': '#1e293b',
                    color: '#fff',
                    padding: '0.75rem 1.5rem'
                },
                td: { padding: '0.75rem 1.5rem',
                    'background-color' : '#f1f1f1'
                 }
            },
            className: {
                table: 'w-full bg-slate-700',
                thead: 'bg-slate-800',
                tbody: 'divide-y divide-gray-600',
                tr: 'hover:bg-indigo-400 dark:hover:bg-gray-700/50',
                th: 'text-left text-xs font-medium uppercase tracking-wider',
                td: 'text-sm text-black whitespace-nowrap'
            }
        }).render(document.getElementById('play-log-grid'));
    });
    </script>
