<div class="transition-all duration-1000 mt-20">
    <div x-data="{ tab: 'media_placement' }">
        <!-- Tab Navigation with Indicator Animation -->
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

            <!-- Filter Row -->
            <div class="mb-4 flex flex-wrap gap-2 items-center">
                <div class="filter-container">
                    <select id="filter-media" class="bg-slate-700 text-white border border-slate-600 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">All Media</option>
                    </select>
                </div>
                <div class="filter-container">
                    <select id="category-filter" class="bg-slate-700 text-white border border-slate-600 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">All Categories</option>
                    </select>
                </div>
                <div class="filter-container">
                    <select id="space-ads-filter" class="bg-slate-700 text-white border border-slate-600 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">All Space Ads</option>
                    </select>
                </div>
                <div class="ml-auto">
                    <button id="reset-mp-filters" class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded transition duration-300">
                        Reset Filters
                    </button>
                </div>
            </div>

            <div id="media-placement-table" class="my-4"></div>
        </div>

        <!-- Media Plan Tab -->
        <div x-show="tab === 'media_statistics'" x-transition:enter="transition ease-out duration-1000"
            x-transition:enter-start="opacity-0 translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-2" x-cloak>

            <!-- Filter Row -->
            <div class="mb-4 flex flex-wrap gap-2 items-center">
                <div class="filter-container">
                    <select id="media-plan-filter" class="bg-slate-700 text-white border border-slate-600 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">All Media Plans</option>
                    </select>
                </div>
                <div class="filter-container">
                    <select id="duration-filter" class="bg-slate-700 text-white border border-slate-600 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">All Durations</option>
                    </select>
                </div>
                <div class="ml-auto">
                    <button id="reset-ms-filters" class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded transition duration-300">
                        Reset Filters
                    </button>
                </div>
            </div>

            <div id="media-statistics-table" class="my-4"></div>
        </div>

        <!-- Play Log Tab -->
        <div x-show="tab === 'play_log'" x-transition:enter="transition ease-out duration-1000"
            x-transition:enter-start="opacity-0 translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-2" x-cloak>

            <!-- Filter Row -->
            <div class="mb-4 flex flex-wrap gap-2 items-center">
                <div class="filter-container">
                    <select id="device-filter" class="bg-slate-700 text-white border border-slate-600 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">All Devices</option>
                    </select>
                </div>
                <div class="filter-container">
                    <select id="media-name-filter" class="bg-slate-700 text-white border border-slate-600 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">All Media Names</option>
                    </select>
                </div>
                <div class="ml-auto">
                    <button id="reset-pl-filters" class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded transition duration-300">
                        Reset Filters
                    </button>
                </div>
            </div>

            <div id="play-log-table" class="my-4 overflow-x-auto"></div>
            <button onclick="exportExcel(playLogsData, ['Device ID','Media Name','Play Date','Longitude','Latitude','Location'], 'play_logs.xlsx')" class="bg-green-800 hover:bg-slate-800 transition duration-500 ease-in-out text-white px-4 py-2 rounded">Download Excel</button>
        </div>

        <!-- Documentation Tab -->
        <div x-show="tab === 'documentation'" x-transition:enter="transition ease-out duration-1000"
        x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-2" x-cloak>

        <!-- Sub-tabs Navigation for Documentation -->
        <div x-data="{ subTab: 'all' }">
        <div class="mb-4 border-b border-gray-600 dark:border-gray-700">
            <div class="flex lg:justify-center">
                <button @click="subTab = 'all'"
                        :class="subTab === 'all' ? 'text-blue-600 dark:text-blue-400 font-semibold border-b-2 border-blue-600 dark:border-blue-400' : 'text-white dark:text-gray-400 hover:text-blue-200 dark:hover:text-gray-200'"
                        class="relative py-2 px-4 focus:outline-none transition-colors whitespace-nowrap group">
                    All
                </button>
                <button @click="subTab = 'images'"
                        :class="subTab === 'images' ? 'text-blue-600 dark:text-blue-400 font-semibold border-b-2 border-blue-600 dark:border-blue-400' : 'text-white dark:text-gray-400 hover:text-blue-200 dark:hover:text-gray-200'"
                        class="relative py-2 px-4 focus:outline-none transition-colors whitespace-nowrap group">
                    Images
                </button>
                <button @click="subTab = 'videos'"
                        :class="subTab === 'videos' ? 'text-blue-600 dark:text-blue-400 font-semibold border-b-2 border-blue-600 dark:border-blue-400' : 'text-white dark:text-gray-400 hover:text-blue-200 dark:hover:text-gray-200'"
                        class="relative py-2 px-4 focus:outline-none transition-colors whitespace-nowrap group">
                    Videos
                </button>
            </div>
        </div>

    <!-- Documentation Modal -->
    <div x-data="{
        selectedDoc: null,
        lastScrollPosition: 0,
        getYouTubeEmbedUrl(url) {
            if (!url) return '';
            // Match YouTube URL patterns and extract video ID
            const regex = /(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/;
            const matches = url.match(regex);
            if (matches && matches[1]) {
                // Return the embed URL with the video ID
                return `https://www.youtube.com/embed/${matches[1]}`;
            }
            return '';
        },
        openModal(doc) {
            this.lastScrollPosition = window.scrollY;
            this.selectedDoc = doc;
            document.body.classList.add('modal-open');

            //Set the modal position based on current scroll
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
                    class="modal-content bg-gradient-to-r from-slate-950 to-slate-800 sm:bg-gradient-to-b sm:from-slate-900 sm:to-slate-800
                    lg:bg-gradient-to-r lg:from-slate-950 lg:to-slate-800 rounded-lg shadow-xl max-w-4xl w-full mx-auto my-8 overflow-hidden transform transition-all absolute left-0 right-0"
                    style="margin-left: auto; margin-right: auto;"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    @click.stop>

                <div class="flex flex-col md:flex-row">
                    <!-- Dynamic Media Section (Image or Video) -->
                    <div class="md:w-1/2 bg-slate-900 flex items-center justify-center p-4">
                        <!-- Show Image or Video Based on Type -->
                        <template x-if="selectedDoc && selectedDoc.type === 'image'">
                            <img :src="'{{ asset('storage/') }}/' + selectedDoc.image_path"
                                    :alt="selectedDoc.description"
                                    class="max-h-96 max-w-full object-contain">
                        </template>
                        <template x-if="selectedDoc && selectedDoc.type === 'video'">
                            <div class="video-container w-full h-full" style="aspect-ratio: 16/9;">
                                <iframe
                                    x-bind:src="selectedDoc.youtube_embed_url || getYouTubeEmbedUrl(selectedDoc.link_video)"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen
                                    class="w-full h-full object-contain">
                                </iframe>
                            </div>
                        </template>
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
                            <!-- Only show external link for video type -->
                            <p x-show="selectedDoc && selectedDoc.type === 'video' && selectedDoc.link_video">
                                <span class="font-medium">Documentation Video:</span>
                                <a x-bind:href="selectedDoc ? selectedDoc.link_video : '#'"
                                    target="_blank"
                                    class="text-blue-600 hover:underline"
                                    x-text="selectedDoc ? 'Watch Here' : ''">
                                </a>
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

        <!-- All Sub-Tab Content -->
    <div x-show="subTab === 'all'" x-transition:enter="transition ease-out duration-500"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100">
        <div id="documentation-all" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($documentations as $index => $doc)
        <div class="documentation-item group bg-slate-800 shadow-md overflow-hidden border border-gray-600 dark:border-gray-600 hover:shadow-lg transition-all duration-1000 hover:-translate-y-1 {{ $index > 3 ? 'hidden' : '' }}"
                x-data="{
                doc: @js([
                    'id' => $doc->id,
                    'image_path' => $doc->image_path,
                    'link_video' => $doc->link_video,
                    'description' => $doc->description,
                    'created_at' => $doc->created_at->format('d M Y H:i:s'),
                    'user' => ['name' => $doc->user->name ?? '-'],
                    'type' => $doc->type
                ]),
                    hovering: false
                }"
                @mouseenter="hovering = true"
                @mouseleave="hovering = false"
                @click="openModal(doc)">

            <div class="relative h-48 overflow-hidden cursor-pointer">
                <!-- Image Content -->
                <template x-if="doc.type === 'image'">
                    <img :src="'{{ asset('storage/') }}/' + doc.image_path"
                         :alt="doc.description"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </template>

                <!-- Video Content -->
                <template x-if="doc.type === 'video'">
                    <!-- Video Thumbnail with Play Button -->
                    <div class="relative w-full h-full">
                         @php
                            // Extract YouTube video ID from the URL
                            $youtubeId = null;
                            if ($doc->link_video) {
                                preg_match('/(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $doc->link_video, $matches);
                                $youtubeId = $matches[1] ?? null;
                            }

                            // Generate thumbnail URL
                            $thumbnailUrl = $doc->thumbnail_path
                                ? asset('storage/' . $doc->thumbnail_path)
                                : ($youtubeId
                                    ? "https://img.youtube.com/vi/{$youtubeId}/hqdefault.jpg"
                                    : asset('storage/video-thumbnails/default.jpg'));
                        @endphp
                        <img src="{{ $thumbnailUrl }}"
                                alt="{{ $doc->description }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                        <!-- Play Button Icon -->
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="bg-black/50 rounded-full p-3 transform transition-transform duration-300 group-hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </template>

                <!-- Overlay that appears on hover -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-black/50 flex flex-col justify-end p-4 transition-opacity duration-300"
                      :class="hovering ? 'opacity-100' : 'opacity-0'">
                    <h4 class="text-sm font-medium text-white line-clamp-2">{{ $doc->description }}</h4>
                    <div class="mt-2 flex items-center justify-between text-xs text-white">
                        <span>Client: {{ $doc->user->name ?? '-' }}</span>
                        <span>{{ $doc->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="mt-3 text-center">
                        <span class="inline-block bg-blue-600 hover:bg-blue-700 rounded-full px-3 py-1 text-xs text-white"
                              x-text="doc.type === 'video' ? 'Play Video' : 'View Details'">
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
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Contact Admin for more help.</p>
            </div>
        </div>
        @endforelse
        </div>

        <!-- Load More Button for All (Only show if there are more than 3 documentation items) -->
        @php
        $totalCount = $documentations->count();
        @endphp
        @if($totalCount > 3)
        <div id="load-more-all" class="mt-8 text-center">
            <button id="load-more-all-btn" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                <span>Load More</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
        </div>
        @endif
    </div>
        <!-- Images Sub-Tab Content -->
        <div x-show="subTab === 'images'" x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100">
            <div id="documentation-images" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($documentations->where('type', 'image') as $index => $doc)
                <div class="documentation-item group bg-slate-800 shadow-md overflow-hidden border border-gray-600 dark:border-gray-600 hover:shadow-lg transition-all duration-1000 hover:-translate-y-1 {{ $index >= 3 ? 'hidden' : '' }}"
                        x-data="{
                        doc: @js([
                            'id' => $doc->id,
                            'image_path' => $doc->image_path,
                            'description' => $doc->description,
                            'created_at' => $doc->created_at->format('d M Y H:i:s'),
                            'user' => ['name' => $doc->user->name ?? '-'],
                            'type' => 'image'
                        ]),
                            hovering: false
                        }"
                        @mouseenter="hovering = true"
                        @mouseleave="hovering = false"
                        @click="openModal(doc)">

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
                        <h3 class="mt-4 text-sm font-medium text-white dark:text-white">No image documentation available</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Contact Admin for more help.</p>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Load More Button for Images (Only show if there are more than 3 image documentation items) -->
            @php
            $imageCount = $documentations->where('type', 'image')->count();
            @endphp
            @if($imageCount > 3)
            <div id="load-more-images" class="mt-8 text-center">
                <button id="load-more-images-btn" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    <span>Load More</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
            </div>
            @endif
        </div>

        <!-- Videos Sub-Tab Content -->
        <div x-show="subTab === 'videos'" x-transition:enter="transition ease-out duration-500"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100">
        <div id="documentation-videos" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($documentations->where('type', 'video') as $index => $doc)
        <div class="documentation-item group bg-slate-800 shadow-md overflow-hidden border border-gray-600 dark:border-gray-600 hover:shadow-lg transition-all duration-1000 hover:-translate-y-1 {{ $index >= 3 ? 'hidden' : '' }}"
                x-data="{
                doc: @js([
                    'id' => $doc->id,
                    'link_video' => $doc->link_video,
                    'description' => $doc->description,
                    'created_at' => $doc->created_at->format('d M Y H:i:s'),
                    'user' => ['name' => $doc->user->name ?? '-'],
                    'type' => 'video'
                ]),
                    hovering: false
                }"
                @mouseenter="hovering = true"
                @mouseleave="hovering = false"
                @click="openModal(doc)">

            <div class="relative h-48 overflow-hidden cursor-pointer">
                <!-- Video Thumbnail with Play Button -->
                <div class="relative w-full h-full">
                    <!-- Video Thumbnail - Use YouTube thumbnail if available, fallback to custom or default -->
                    @php
                        // Extract YouTube video ID from the URL
                        $youtubeId = null;
                        if ($doc->link_video) {
                            preg_match('/(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $doc->link_video, $matches);
                            $youtubeId = $matches[1] ?? null;
                        }

                        // Generate thumbnail URL
                        $thumbnailUrl = $doc->thumbnail_path
                            ? asset('storage/' . $doc->thumbnail_path)
                            : ($youtubeId
                                ? "https://img.youtube.com/vi/{$youtubeId}/hqdefault.jpg"
                                : asset('storage/video-thumbnails/default.jpg'));
                    @endphp

                    <img src="{{ $thumbnailUrl }}"
                            alt="{{ $doc->description }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                    <!-- Play Button Icon -->
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="bg-black/50 rounded-full p-3 transform transition-transform duration-300 group-hover:scale-110">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

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
                            Play Video
                        </span>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-3 py-12 text-center">
            <div class="mx-auto max-w-md p-6 bg-slate-800/50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                </svg>
                <h3 class="mt-4 text-sm font-medium text-white dark:text-white">No video documentation available</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Contact Admin for more help.</p>
            </div>
        </div>
        @endforelse
        </div>

        <!-- Load More Button for Videos (Only show if there are more than 3 video documentation items) -->
        @php
        $videoCount = $documentations->where('type', 'video')->count();
        @endphp
        @if($videoCount > 3)
        <div id="load-more-videos" class="mt-8 text-center">
        <button id="load-more-videos-btn" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
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
                'total_impression' => $item->mediaPlacements->sum('avg_daily_impression') ?? 0
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

        // Initialize tables and filters when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Shared Tabulator configuration
            const tabulatorTheme = {
                layout: "fitColumns",
                responsiveLayout: "collapse",
                pagination: "local",
                paginationSize: 10,
                paginationSizeSelector: [5, 10, 25, 50, 100],
                headerFilterLiveFilterDelay: 300,
                movableColumns: true,
                selectable: false
            };

            // Format for number values
            const numberFormatter = function(cell, formatterParams, onRendered) {
                return new Intl.NumberFormat().format(cell.getValue());
            };

            // Helper function to populate select filters
            function populateFilter(selectId, data, columnName) {
                const select = document.getElementById(selectId);
                if (!select) return;

                // Get unique values
                const uniqueValues = [...new Set(data.map(item => item[columnName]))].filter(Boolean);
                uniqueValues.sort();

                // Add options to select
                uniqueValues.forEach(value => {
                    const option = document.createElement('option');
                    option.value = value;
                    option.textContent = value;
                    select.appendChild(option);
                });
            }

            const mpData = mediaPlacementData.map(item => ({
                media: item.media,
                category: item.category,
                space_ads: item.space_ads,
                size: item.size,
                avg_daily_impression: item.avg_daily_impression
            }));
            const msData = mediaStatisticsData.map(item => ({
                media: item.media,
                start_date: item.start_date,
                end_date: item.end_date,
                duration: item.duration,
                total_impression: item.total_impression
            }));
            const plData = playLogsData.map(item => ({
                device_id: item.device_id,
                media_name: item.media_name,
                play_date: item.play_date,
                longitude: item.longitude,
                latitude: item.latitude,
                location: item.location
            }));

            // Initialize Media Placement Table
            const mpTable = new Tabulator("#media-placement-table", {
                ...tabulatorTheme,
                data: mpData,
                columns: [
                    { title: "Media", field: "media", headerFilter: false },
                    { title: "Category", field: "category", headerFilter: false },
                    { title: "Space Ads", field: "space_ads", headerFilter: false },
                    { title: "Size", field: "size", headerFilter: false },
                    {
                        title: "Total Impression",
                        field: "avg_daily_impression",
                        headerFilter: false,
                        headerFilterFunc: ">="
                    }
                ]
            });

            // Initialize Media Statistics Table
            const msTable = new Tabulator("#media-statistics-table", {
                ...tabulatorTheme,
                data: msData,
                columns: [
                    { title: "Media Plan", field: "media", headerFilter: false },
                    { title: "Start Date", field: "start_date", headerFilter: false },
                    { title: "End Date", field: "end_date", headerFilter: false },
                    { title: "Duration", field: "duration", headerFilter: false },
                    {
                        title: "Total Impression",
                        field: "total_impression",
                        formatter: numberFormatter,
                        headerFilter: false,
                        headerFilterFunc: ">="
                    }
                ]
            });

            // Initialize Play Log Table
            const plTable = new Tabulator("#play-log-table", {
                ...tabulatorTheme,
                data: plData,
                columns: [
                    { title: "Device ID", field: "device_id", headerFilter: false },
                    { title: "Media Name", field: "media_name", headerFilter: false },
                    { title: "Play Date", field: "play_date", headerFilter: false },
                    { title: "Longitude", field: "longitude", headerFilter: false },
                    { title: "Latitude", field: "latitude", headerFilter: false },
                    { title: "Location", field: "location", headerFilter: false }
                ]
            });

            // Populate filters
            populateFilter("filter-media", mpData, "media");
            populateFilter("category-filter", mpData, "category");
            populateFilter("space-ads-filter", mpData, "space_ads");
            populateFilter("media-plan-filter", msData, "media");
            populateFilter("duration-filter", msData, "duration");
            populateFilter("device-filter", plData, "device_id");
            populateFilter("media-name-filter", plData, "media_name");

            // Handle Media Placement filters
            document.getElementById("filter-media").addEventListener("change", function() {
                if (this.value === "") {
                    mpTable.clearFilter("media");
                } else {
                    mpTable.setFilter("media", "=", this.value);
                }
            });

            document.getElementById("category-filter").addEventListener("change", function() {
                if (this.value === "") {
                    mpTable.clearFilter("category");
                } else {
                    mpTable.setFilter("category", "=", this.value);
                }
            });

            document.getElementById("space-ads-filter").addEventListener("change", function() {
                if (this.value === "") {
                    mpTable.clearFilter("space_ads");
                } else {
                    mpTable.setFilter("space_ads", "=", this.value);
                }
            });

            document.getElementById("reset-mp-filters").addEventListener("click", function() {
                document.getElementById("filter-media").value = "";
                document.getElementById("category-filter").value = "";
                document.getElementById("space-ads-filter").value = "";
                mpTable.clearFilter(true);
            });

            // Handle Media Statistics filters
            document.getElementById("media-plan-filter").addEventListener("change", function() {
                if (this.value === "") {
                    msTable.clearFilter("media");
                } else {
                    msTable.setFilter("media", "=", this.value);
                }
            });

            document.getElementById("duration-filter").addEventListener("change", function() {
                if (this.value === "") {
                    msTable.clearFilter("duration");
                } else {
                    msTable.setFilter("duration", "=", this.value);
                }
            });

            document.getElementById("reset-ms-filters").addEventListener("click", function() {
                document.getElementById("media-plan-filter").value = "";
                document.getElementById("duration-filter").value = "";
                msTable.clearFilter(true);
            });

            // Handle Play Log filters
            document.getElementById("device-filter").addEventListener("change", function() {
                if (this.value === "") {
                    plTable.clearFilter("device_id");
                } else {
                    plTable.setFilter("device_id", "=", this.value);
                }
            });

            document.getElementById("media-name-filter").addEventListener("change", function() {
                if (this.value === "") {
                    plTable.clearFilter("media_name");
                } else {
                    plTable.setFilter("media_name", "=", this.value);
                }
            });

            document.getElementById("reset-pl-filters").addEventListener("click", function() {
                document.getElementById("device-filter").value = "";
                document.getElementById("media-name-filter").value = "";
                plTable.clearFilter(true);
            });

            // Redraw tables when tab changes
            Alpine.effect(() => {
                const tab = Alpine.store('tab') || Alpine.reactive({tab: 'media_placement'}).tab;
                setTimeout(() => {
                    if (tab === 'media_placement') mpTable.redraw(true);
                    if (tab === 'media_statistics') msTable.redraw(true);
                    if (tab === 'play_log') plTable.redraw(true);
                }, 100);
            });
        // modal positioning
        window.positionModalAtScroll = function(modal) {
            const viewportHeight = window.innerHeight;
            const scrollPosition = window.scrollY || window.pageYOffset;
            const modalTop = Math.min(
                Math.max(scrollPosition, 20),
                document.body.scrollHeight - viewportHeight
            );
            modal.style.top = `${modalTop}px`;
            modal.style.maxHeight = `${viewportHeight - 60}px`;
        };
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
    // Additional script for documentation sub-tabs
    document.addEventListener('DOMContentLoaded', function() {
    // Fungsi umum untuk menangani "Load More" untuk sub-tab tertentu
    function initializeLoadMore(buttonId, containerId, itemsSelector) {
        const loadMoreBtn = document.getElementById(buttonId);
        if (!loadMoreBtn) return;

        const items = document.querySelectorAll(`${containerId} ${itemsSelector}`);
        const itemsPerLoad = 3;
        let currentlyShown = 3; // Awalnya menampilkan 3 item

        loadMoreBtn.addEventListener('click', function() {
            // Count next batch to show
            const nextToShow = Math.min(currentlyShown + itemsPerLoad, items.length);

            // Show next batch with animation
            for (let i = currentlyShown; i < nextToShow; i++) {
                items[i].classList.remove('hidden');
                items[i].classList.add('animate-fade-in');
            }

            // update item shown
            currentlyShown = nextToShow;

            // Hide button if all item are showed
            if (currentlyShown >= items.length) {
                loadMoreBtn.parentElement.style.display = 'none';
            }
        });
    }

    // Initiate "Load More" for sub-tab Images
    initializeLoadMore('load-more-images-btn', '#documentation-images', '.documentation-item');

    // Initiate "Load More" for sub-tab Videos
    initializeLoadMore('load-more-videos-btn', '#documentation-videos', '.documentation-item');
    });
    function getYouTubeEmbedUrl(url) {
    if (!url) return '';

    // Match YouTube URL patterns and extract video ID
    const regex = /(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/;
    const matches = url.match(regex);

    if (matches && matches[1]) {
        // Return the embed URL with the video ID
        return `https://www.youtube.com/embed/${matches[1]}`;
    }

    return url; // Return original if no match (shouldn't happen with validation)
}

    // Modify the existing openModal function to handle YouTube links
    function openModal(doc) {
    // Convert YouTube URL to embed URL if it's a video
    if (doc && doc.type === 'video' && doc.link_video) {
        doc.link_video = getYouTubeEmbedUrl(doc.link_video);
    }

    // Store document and set modal state
    selectedDoc = doc;
    document.body.classList.add('modal-open');

    // Position the modal
    this.$nextTick(() => {
        const modal = document.querySelector('.modal-content');
        if (modal) {
            const viewportHeight = window.innerHeight;
            const modalTop = Math.max(window.scrollY + 50, 50);
            modal.style.top = modalTop + 'px';
            modal.style.maxHeight = (viewportHeight - 100) + 'px';
        }
    });
}
    function getYouTubeEmbedUrl(url) {
    if (!url) return '';

    // Match YouTube URL patterns and extract video ID
    const regex = /(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/;
    const matches = url.match(regex);

    if (matches && matches[1]) {
        return `https://www.youtube.com/embed/${matches[1]}`;
    }

    return '';
}
    </script>

    <style>
        /* Tabulator styling*/
        .tabulator {
            background-color: transparent !important;
            border:1px solid rgba(75, 85, 99, 0.3) !important;
        }

        .tabulator-tableholder {
            background-color: transparent !important;
        }

        .tabulator-row {
            background-color: #020617 !important;
            border-bottom: 1px solid rgba(75, 85, 99, 0.3) !important;
            font-size: 16px !important;
            color: white !important;
        }

        .tabulator-row.tabulator-row-even {
            background-color: #020617 !important;
        }

        .tabulator-row:hover {
            background-color: rgba(79, 70, 229, 0.2) !important;
            color: black !important;
        }

        .tabulator-header {
            background-color: #020617 !important;
            border-bottom: 2px solid rgb(75, 85, 99) !important;
            border-top: 2px solid rgb(75, 85, 99) !important;
            font-size: 20px !important;
        }

        .tabulator-col {
            background-color: #020617 !important;
            color: white !important;
            border-right: 1px solid rgba(75, 85, 99, 0.3) !important;
            border-left: 1px solid rgba(75, 85, 99, 0.3) !important;
        }

        .tabulator-footer {
            background-color: #020617 !important;
            color: white !important;
            border-top: 1px solid rgba(75, 85, 99, 0.5) !important;
            border-bottom: 1px solid rgba(75, 85, 99, 0.5) !important;
        }

        .tabulator-page {
            background-color: #020617 !important;
            color: white !important;
            border: 1px solid rgba(75, 85, 99, 0.5) !important;
        }

        .tabulator-page.active {
            background-color: rgb(37, 99, 235) !important;
            color: white !important;
        }

        .tabulator-header-filter input {
            background-color: rgba(30, 41, 59, 0.9) !important;
            color: white !important;
            border: 1px solid rgba(75, 85, 99, 0.5) !important;
            padding: 4px !important;
        }

        /* Filter styling */
        .filter-container {
            position: relative;
            min-width: 160px;
        }

        select {
            appearance: none;
        }

        .filter-container::after {
            font-size: 0.8em;
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            color: #0F172A;
        }

        /* Documentation styling (keep existing) */
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
