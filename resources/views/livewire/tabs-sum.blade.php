<div class="transition-all duration-1000 mt-20">
    <div x-data="{ tab: 'media_placement' }">
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
                <div class="flex lg:justify-center">
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
        <div id="play-log-grid" class="my-4 overflow-x-auto"></div>
        <button onclick="exportExcel(playLogsData, ['Device ID','Media Name','Play Date','Longitude','Latitude','Location'], 'play_logs.xlsx')" class="bg-green-800 hover:bg-slate-800 transition duration-500 ease-in-out text-white px-4 py-2 rounded">Download Excel</button>
    </div>

        <!-- Documentation Tab -->
        <div x-show="tab === 'documentation'" x-transition:enter="transition ease-out duration-1000"
             x-transition:enter-start="opacity-0 translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 translate-y-2" x-cloak>

            <!-- Documentation Modal -->
            <div x-data="{
                selectedDoc: null,
                lastScrollPosition: 0,
                openModal(doc) {
                    this.lastScrollPosition = window.scrollY;
                    this.selectedDoc = doc;
                    document.body.classList.add('modal-open');

                    // Crucial: Set the modal position based on current scroll
                    this.$nextTick(() => {
                        const modal = document.querySelector('.modal-content');
                        if (modal) {
                            const viewportHeight = window.innerHeight;
                            const modalTop = Math.max(this.lastScrollPosition + 50, 50); // 50px from current scroll position
                            modal.style.top = modalTop + 'px';
                            modal.style.maxHeight = (viewportHeight - 100) + 'px';
                        }
                    });
                },
                closeModal() {
                    this.selectedDoc = null;
                    document.body.classList.remove('modal-open');
                }
            }" @keydown.escape.window="closeModal()">
                <!-- Modal Backdrop with fixed positioning -->
                <div x-show="selectedDoc !== null"
                     class="fixed inset-0 bg-black/70 z-50 overflow-y-auto"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     @click="closeModal()">

                    <!-- Modal Content with absolute positioning -->
                    <div x-show="selectedDoc !== null"
                         class="modal-content bg-slate-800 rounded-lg shadow-xl max-w-4xl w-full mx-auto my-8 overflow-hidden transform transition-all absolute left-0 right-0"
                         style="margin-left: auto; margin-right: auto;"
                         x-transition:enter="ease-out duration-300"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="ease-in duration-200"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         @click.stop>

                        <div class="flex flex-col md:flex-row">
                            <!-- Image Section -->
                            <div class="md:w-1/2 bg-slate-900 flex items-center justify-center p-4">
                                <img :src="selectedDoc ? '{{ asset('storage/') }}/' + selectedDoc.image_path : ''"
                                     :alt="selectedDoc ? selectedDoc.description : ''"
                                     class="max-h-96 max-w-full object-contain">
                            </div>

                            <!-- Content Section -->
                            <div class="md:w-1/2 p-6">
                                <div class="flex justify-between items-start mb-4">
                                    <p class="text-xl font-normal text-white" x-text="selectedDoc ? selectedDoc.description : ''"></p>
                                    <button @click="closeModal()" class="text-gray-400 hover:text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>

                                <div class="text-sm text-gray-300 mb-4">
                                    <p class="mb-2">
                                        <span class="font-medium">Client:</span>
                                        <span x-text="selectedDoc ? (selectedDoc.user ? selectedDoc.user.name : '-') : ''"></span>
                                    </p>
                                    <p>
                                        <span class="font-medium">Uploaded at:</span>
                                        <span x-text="selectedDoc ? selectedDoc.created_at : ''"></span>
                                    </p>
                                </div>

                                <div class="text-gray-300 mb-6">
                                </div>

                                <div class="flex justify-end">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Documentation Grid -->
                <div id="documentation-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse ($documentations as $index => $doc)
                    <div class="documentation-item group bg-slate-800 shadow-md overflow-hidden border border-gray-600 dark:border-gray-600 hover:shadow-lg transition-all duration-1000 hover:-translate-y-1 {{ $index >= 3 ? 'hidden' : '' }}"
                         x-data="{
                             docData: {
                                 id: {{ $doc->id }},
                                 description: '{{ addslashes($doc->description) }}',
                                 image_path: '{{ $doc->image_path }}',
                                 created_at: '{{ $doc->created_at->format('d M Y H:i:s') }}',
                                 user: { name: '{{ $doc->user->name ?? '-' }}' }
                             },
                             hovering: false
                         }"
                         @mouseenter="hovering = true"
                         @mouseleave="hovering = false"
                         @click="openModal(docData)">

                        <div class="relative h-48 overflow-hidden cursor-pointer">
                            <img src="{{ asset('storage/' . $doc->image_path) }}"
                                 alt="{{ $doc->description }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                            <!-- Overlay that appears on hover -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-black/50 flex flex-col justify-end p-4 transition-opacity duration-300"
                                 :class="hovering ? 'opacity-100' : 'opacity-0'">
                                <h4 class="text-sm font-medium text-white line-clamp-2">{{ $doc->description }}</h4>
                                <div class="mt-2 flex items-center justify-between text-xs text-white">
                                    <span>Client: {{ $doc->user->name ?? '-' }}</span>
                                    <span>{{ $doc->created_at->format('d M Y') }}</span>
                                </div>
                                <div class="mt-3 text-center">
                                    <span class="inline-block bg-blue-600 hover:bg-blue-700 rounded-full px-3 py-1 text-xs text-white">
                                        View Details
                                    </span>
                                </div>
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

                <!-- Load More Button (Only show if there are more than 3 documentation items) -->
                @if(isset($documentations) && $documentations->count() > 3)
                <div id="load-more-container" class="mt-8 text-center">
                    <button id="load-more-btn" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        <span>Load More</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                </div>
                @endif
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
        // Common GridJS configuration for ALL tables
        const gridOptions = {
            search: true,
            pagination: true,
            resizable: true,
            width: '100%',
            style: {
                table: {
                    'min-width': '600px',
                },
                th: {
                    'background-color': '#1e293b',
                    color: '#fff',
                    padding: '0.75rem 1rem',
                },
                td: {
                    padding: '0.75rem 1rem',
                    'background-color': '#f1f1f1',
                },
            },
            className: {
                table: 'w-full bg-slate-700',
                thead: 'bg-slate-800',
                tbody: 'divide-y divide-gray-600',
                tr: 'hover:bg-indigo-400 dark:hover:bg-gray-700/50',
                th: 'text-left font-medium uppercase tracking-wider',
                td: 'text-black break-words whitespace-normal',
                footer: 'bg-[#f1f1f1]',
            },
        };

        // ===== Media Placement Grid =====
        new window.gridjs.Grid({
            ...gridOptions,
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
            ])
        }).render(document.getElementById('media-placement-grid'));

        // ===== Media Statistics Grid =====
        const statsGrid = new window.gridjs.Grid({
            ...gridOptions,
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
            ])
        }).render(document.getElementById('media-statistics-grid'));

        // ===== Play Log Grid =====
        const playLogGrid = new window.gridjs.Grid({
            ...gridOptions,
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
            ])
        }).render(document.getElementById('play-log-grid'));
        setTimeout(() => {
            statsGrid.forceRender();
            playLogGrid.forceRender();
        }, 500);

         // Fix for maintaining scroll position when opening/closing modal
         document.addEventListener('alpine:initialized', () => {
            // Monitor for modal open/close to adjust positioning
            const observer = new MutationObserver((mutations) => {
                mutations.forEach((mutation) => {
                    if (mutation.type === 'attributes' && mutation.attributeName === 'style') {
                        const modal = document.querySelector('.modal-content');
                        if (modal && modal.style.display !== 'none' && window.getComputedStyle(modal).display !== 'none') {
                            window.positionModalAtScroll(modal);
                        }
                    }
                });
            });

            // Start observing once Alpine is ready
            setTimeout(() => {
                const modal = document.querySelector('.modal-content');
                if (modal) {
                    observer.observe(modal, { attributes: true });
                }
            }, 500);
        });
        // Load More functionality for Documentation tab
        const loadMoreBtn = document.getElementById('load-more-btn');
        if (loadMoreBtn) {
            const docItems = document.querySelectorAll('.documentation-item');
            const itemsPerLoad = 3;
            let currentlyShown = 3; // Initially showing first 3 items

            loadMoreBtn.addEventListener('click', function() {
                // Calculate next batch to show
                const nextToShow = Math.min(currentlyShown + itemsPerLoad, docItems.length);

                // Show the next batch of items with animation
                for (let i = currentlyShown; i < nextToShow; i++) {
                    docItems[i].classList.remove('hidden');
                    docItems[i].classList.add('animate-fade-in');
                }

                // Update count of currently shown items
                currentlyShown = nextToShow;

                // Hide button if all items are shown
                if (currentlyShown >= docItems.length) {
                    document.getElementById('load-more-container').style.display = 'none';
                }
            });
        }
        });
        function exportExcel(data, headers, baseFilename) {
        const date = new Date().toISOString().split('T')[0];
        const filename = `${baseFilename.replace('.xlsx', '')}_${date}.xlsx`;

        const worksheetData = [
            headers,
            ...data.map(item => headers.map((_, index) => Object.values(item)[index]))
        ];

        const worksheet = XLSX.utils.aoa_to_sheet(worksheetData);
        worksheet['!cols'] = headers.map(() => ({ wch: 20 }));
        const workbook = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(workbook, worksheet, "Sheet1");
        XLSX.writeFile(workbook, filename);
    }
    </script>

<style>
    .animate-fade-in {
        animation: fadeIn 0.5s ease-out forwards;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    /* Modal styling */
    .modal-content {
        position: absolute;
        /* Will be set dynamically by JavaScript */
    }

    /* Prevent page scrolling when modal is open */
    body.modal-open {
        overflow: hidden;
    }
    </style>
</div>
