<div
    class="w-full transition-all duration-1200 ease-out transform"
    x-data="{
        shown: true,
        counters: {},
        init() {
            this.animateElements();

            // Listen for browser events from Livewire
            window.addEventListener('stats-updated-init', (event) => {
                // Ensure the container is visible
                this.shown = true;

                // Force animation with a slight delay to ensure the DOM is updated
                setTimeout(() => {
                    this.resetAnimations();
                    this.animateElements();
                }, 50);
            });

            // Keep for backward compatibility
            window.addEventListener('refreshStatsWidget', () => {
                // Ensure the container is visible
                this.shown = true;

                // Reset and animate
                setTimeout(() => {
                    this.resetAnimations();
                    this.animateElements();
                }, 50);
            });
        },
        resetAnimations() {
            // Clear any ongoing animations
            Object.keys(this.counters).forEach(id => {
                if (this.counters[id] && this.counters[id].timer) {
                    clearInterval(this.counters[id].timer);
                }
            });

            // Reset counter storage
            this.counters = {};
        },
        animateElements() {
            // Add staggered fade-in animation for cards
            const cards = this.$el.querySelectorAll('.card-animate');
            cards.forEach((card, index) => {
                card.classList.remove('card-visible');
                setTimeout(() => {
                    card.classList.add('card-visible');
                }, 150 * index);
            });

            // Enhanced countup animation with easing
            this.$el.querySelectorAll('[data-countup]').forEach(el => {
                const target = parseInt(el.getAttribute('data-countup'));
                const duration = parseInt(el.getAttribute('data-duration') || 1500);
                const start = 0;
                const frameDuration = 1000/60; // 60fps
                const totalFrames = Math.round(duration / frameDuration);
                let frame = 0;

                // Clear any existing animation
                if (this.counters[el.id] && this.counters[el.id].timer) {
                    clearInterval(this.counters[el.id].timer);
                }

                // Save initial value
                this.counters[el.id] = { value: start };
                el.textContent = start;

                const easeOutQuad = t => t * (2 - t); // Smoother easing function

                const timer = setInterval(() => {
                    frame++;

                    // Calculate progress with easing
                    const progress = easeOutQuad(frame / totalFrames);
                    const current = Math.round(start + (target - start) * progress);

                    if (frame === totalFrames) {
                        el.textContent = target;
                        clearInterval(timer);
                    } else {
                        el.textContent = current;
                    }
                }, frameDuration);

                // Store the timer reference for possible cleanup
                this.counters[el.id].timer = timer;
            });
        }
    }"
>
    <!-- Container for both mobile and desktop views -->
    <div class="w-full">
        <!-- Enhanced Mobile Summary Card -->
        <div class="block sm:hidden mb-6 bg-gradient-to-br from-gray-800 via-gray-700 to-gray-800 dark:from-gray-700 dark:via-gray-800 dark:to-gray-900 rounded-2xl shadow-lg overflow-hidden transform transition-all card-animate group">
            <div class="px-5 py-4 relative overflow-hidden">
                <!-- Background accent effects -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-blue-500/10 rounded-full -mr-16 -mt-16 blur-2xl"></div>
                <div class="absolute bottom-0 left-0 w-24 h-24 bg-green-500/10 rounded-full -ml-12 -mb-12 blur-xl"></div>

                <!-- Tailwind Shimmer Effect -->
                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000 ease-in-out"></div>

                <h3 class="text-sm font-medium text-gray-200 dark:text-gray-300 mb-3 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    Media Overview Summary
                </h3>

                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-gray-600/30 dark:bg-gray-700/40 backdrop-blur-sm rounded-xl p-3 transform transition-all duration-300 hover:-translate-y-1 hover:shadow-md relative group/card overflow-hidden">
                        <!-- Tailwind Shimmer Effect -->
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover/card:translate-x-full transition-transform duration-1000 ease-in-out"></div>

                        <p class="text-xs text-gray-300 dark:text-gray-300 mb-1 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Media Plan
                        </p>
                        <p class="text-xl font-bold text-white">
                            <span id="mobile-count-1" data-countup="{{ $stats['totalMediaPlan'] }}" data-duration="1400">0</span>
                        </p>
                    </div>

                    <div class="bg-gray-600/30 dark:bg-gray-700/40 backdrop-blur-sm rounded-xl p-3 transform transition-all duration-300 hover:-translate-y-1 hover:shadow-md relative group/card overflow-hidden">
                        <!-- Tailwind Shimmer Effect -->
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover/card:translate-x-full transition-transform duration-1000 ease-in-out"></div>

                        <p class="text-xs text-gray-300 dark:text-gray-300 mb-1 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            Placement
                        </p>
                        <p class="text-xl font-bold text-white">
                            <span id="mobile-count-2" data-countup="{{ $stats['totalInventory'] }}" data-duration="1400">0</span>
                        </p>
                    </div>

                    <div class="bg-gray-600/30 dark:bg-gray-700/40 backdrop-blur-sm rounded-xl p-3 transform transition-all duration-300 hover:-translate-y-1 hover:shadow-md relative group/card overflow-hidden">
                        <!-- Tailwind Shimmer Effect -->
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover/card:translate-x-full transition-transform duration-1000 ease-in-out"></div>

                        <p class="text-xs text-gray-300 dark:text-gray-300 mb-1 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Duration
                        </p>
                        <p class="text-xl font-bold text-white">
                            <span id="mobile-count-3" data-countup="{{ $stats['totalDuration'] }}" data-duration="1200">0</span>
                            <span class="text-xs font-normal ml-1 text-gray-300"> Days</span>
                        </p>
                    </div>

                    <div class="bg-gray-600/30 dark:bg-gray-700/40 backdrop-blur-sm rounded-xl p-3 transform transition-all duration-300 hover:-translate-y-1 hover:shadow-md relative group/card overflow-hidden">
                        <!-- Tailwind Shimmer Effect -->
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover/card:translate-x-full transition-transform duration-1000 ease-in-out"></div>

                        <p class="text-xs text-gray-300 dark:text-gray-300 mb-1 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Remaining
                        </p>
                        <p class="text-xl font-bold text-white">
                            <span id="mobile-count-4" data-countup="{{ $stats['remainingDays'] }}" data-duration="1200">0</span>
                            <span class="text-xs font-normal ml-1 text-gray-300"> Days</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced Desktop Cards Grid -->
        <div class="hidden sm:grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">
            <!-- Media Plan Card -->
            <div class="card-animate opacity-0 transform translate-y-4 transition-all duration-500 bg-gradient-to-br from-gray-800 via-gray-700 to-gray-800 dark:from-gray-700 dark:via-gray-800 dark:to-gray-900 rounded-xl shadow-md overflow-hidden hover:shadow-xl hover:-translate-y-2 group relative">
                <!-- Background accent effect -->
                <div class="absolute inset-0 bg-blue-500/5 rounded-xl opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>

                <!-- Tailwind Shimmer Effect -->
                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000 ease-in-out"></div>

                <div class="px-5 py-4 relative">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-xs font-semibold uppercase tracking-wider text-gray-300 dark:text-gray-400 mb-1">Media Plan</h3>
                            <p class="text-2xl font-bold text-white dark:text-white">
                                <span id="desk-count-1" data-countup="{{ $stats['totalMediaPlan'] }}" data-duration="1800">0</span>
                            </p>
                        </div>
                        <div class="rounded-full p-2 bg-blue-500/20 dark:bg-blue-900/30 backdrop-blur-sm shadow-lg shadow-blue-500/10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-300 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="text-xs text-gray-300 dark:text-gray-400">Total media plans</span>
                    </div>

                    <!-- Progress indicator -->
                    <div class="w-full h-1 bg-gray-700/50 rounded-full mt-3 overflow-hidden">
                        <div class="h-full bg-blue-500/50 rounded-full" style="width: 75%; transition: width 1.5s ease-out;"></div>
                    </div>
                </div>
            </div>

            <!-- Media Placement Card -->
            <div class="card-animate opacity-0 transform translate-y-4 transition-all duration-500 bg-gradient-to-br from-gray-800 via-gray-700 to-gray-800 dark:from-gray-700 dark:via-gray-800 dark:to-gray-900 rounded-xl shadow-md overflow-hidden hover:shadow-xl hover:-translate-y-2 group relative">
                <!-- Background accent effect -->
                <div class="absolute inset-0 bg-green-500/5 rounded-xl opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>

                <!-- Tailwind Shimmer Effect -->
                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000 ease-in-out"></div>

                <div class="px-5 py-4 relative">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-xs font-semibold uppercase tracking-wider text-gray-300 dark:text-gray-400 mb-1">Media Placement</h3>
                            <p class="text-2xl font-bold text-white dark:text-white">
                                <span id="desk-count-2" data-countup="{{ $stats['totalInventory'] }}" data-duration="1800">0</span>
                            </p>
                        </div>
                        <div class="rounded-full p-2 bg-green-500/20 dark:bg-green-900/30 backdrop-blur-sm shadow-lg shadow-green-500/10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-300 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="text-xs text-gray-300 dark:text-gray-400">Total media placements</span>
                    </div>

                    <!-- Progress indicator -->
                    <div class="w-full h-1 bg-gray-700/50 rounded-full mt-3 overflow-hidden">
                        <div class="h-full bg-green-500/50 rounded-full" style="width: 60%; transition: width 1.5s ease-out;"></div>
                    </div>
                </div>
            </div>

            <!-- Broadcast Duration Card -->
            <div class="card-animate opacity-0 transform translate-y-4 transition-all duration-500 bg-gradient-to-br from-gray-800 via-gray-700 to-gray-800 dark:from-gray-700 dark:via-gray-800 dark:to-gray-900 rounded-xl shadow-md overflow-hidden hover:shadow-xl hover:-translate-y-2 group relative">
                <!-- Background accent effect -->
                <div class="absolute inset-0 bg-cyan-500/5 rounded-xl opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>

                <!-- Tailwind Shimmer Effect -->
                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000 ease-in-out"></div>

                <div class="px-5 py-4 relative">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-xs font-semibold uppercase tracking-wider text-gray-300 dark:text-gray-400 mb-1">Broadcast Duration</h3>
                            <p class="text-2xl font-bold text-white dark:text-white">
                                <span id="desk-count-3" data-countup="{{ $stats['totalDuration'] }}" data-duration="1600">0</span>
                                <span class="text-sm font-normal ml-1"> Days</span>
                            </p>
                        </div>
                        <div class="rounded-full p-2 bg-cyan-500/20 dark:bg-cyan-900/30 backdrop-blur-sm shadow-lg shadow-cyan-500/10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-cyan-300 dark:text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="text-xs text-gray-300 dark:text-gray-400">Total broadcast duration</span>
                    </div>

                    <!-- Progress indicator -->
                    <div class="w-full h-1 bg-gray-700/50 rounded-full mt-3 overflow-hidden">
                        <div class="h-full bg-cyan-500/50 rounded-full" style="width: 85%; transition: width 1.5s ease-out;"></div>
                    </div>
                </div>
            </div>

            <!-- Remaining Days Card -->
            <div class="card-animate opacity-0 transform translate-y-4 transition-all duration-500 bg-gradient-to-br from-gray-800 via-gray-700 to-gray-800 dark:from-gray-700 dark:via-gray-800 dark:to-gray-900 rounded-xl shadow-md overflow-hidden hover:shadow-xl hover:-translate-y-2 group relative">
                <!-- Background accent effect -->
                <div class="absolute inset-0 bg-amber-500/5 rounded-xl opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>

                <!-- Tailwind Shimmer Effect -->
                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000 ease-in-out"></div>

                <div class="px-5 py-4 relative">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-xs font-semibold uppercase tracking-wider text-gray-300 dark:text-gray-400 mb-1">Remaining Days</h3>
                            <p class="text-2xl font-bold text-white dark:text-white">
                                <span id="desk-count-4" data-countup="{{ $stats['remainingDays'] }}" data-duration="1600">0</span>
                                <span class="text-sm font-normal ml-1"> Days</span>
                            </p>
                        </div>
                        <div class="rounded-full p-2 bg-amber-500/20 dark:bg-amber-900/30 backdrop-blur-sm shadow-lg shadow-amber-500/10">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-300 dark:text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="text-xs text-gray-300 dark:text-gray-400">Days remaining in campaign</span>
                    </div>

                    <!-- Progress indicator -->
                    <div class="w-full h-1 bg-gray-700/50 rounded-full mt-3 overflow-hidden">
                        <div class="h-full bg-amber-500/50 rounded-full" style="width: 35%; transition: width 1.5s ease-out;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
    /* animations */
    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .card-visible {
        opacity: 1 !important;
        transform: translateY(0) !important;
    }

    /* Hover effects */
    .hover\:scale-102:hover {
        transform: scale(1.02);
    }
    </style>
</div>
