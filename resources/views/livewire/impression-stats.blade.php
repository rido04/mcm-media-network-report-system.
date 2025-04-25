<div class="transition-all duration-1000 ease-out transform opacity-0 translate-y-4"
x-data="{
    shown: false,
    countUp(el, target, duration = 1500, decimals = 0) {
        let start = 0;
        const end = parseFloat(target);
        const range = end - start;
        const stepTime = Math.abs(Math.floor(duration / range));
        const startTime = performance.now();
        const formatValue = (val) => {
            return decimals > 0
                ? Number(val.toFixed(decimals)).toLocaleString()
                : Math.floor(val).toLocaleString();
        };

        function updateNumber(timestamp) {
            const runtime = timestamp - startTime;
            const progress = Math.min(runtime / duration, 1);
            const easedProgress = 1 - Math.pow(1 - progress, 3); // Cubic ease out
            const currentValue = start + (easedProgress * range);

            el.textContent = formatValue(currentValue);

            if (runtime < duration) {
                requestAnimationFrame(updateNumber);
            } else {
                el.textContent = formatValue(end);
            }
        }

        requestAnimationFrame(updateNumber);
    },
    init() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                this.shown = entry.isIntersecting;
                if (entry.isIntersecting) {
                    observer.unobserve(this.$el);

                    // Start countup animations for all elements with data-countup
                    this.$el.querySelectorAll('[data-countup]').forEach(el => {
                        const target = el.getAttribute('data-countup');
                        const duration = parseInt(el.getAttribute('data-duration') || 1500);
                        const decimals = parseInt(el.getAttribute('data-decimals') || 0);
                        this.countUp(el, target, duration, decimals);
                    });
                }
            });
        });
        observer.observe(this.$el);
    }
}"
x-bind:class="{
    'opacity-100 translate-y-0': shown,
    'opacity-0 translate-y-4': !shown
}">
    <!-- Desktop Stats Grid (Hidden on Mobile) -->
    <div class="hidden md:grid md:grid-cols-4 gap-4">
        <!-- Highest Impression Card -->
        <div class="bg-gradient-to-br from-gray-800 via-gray-700 to-gray-800 p-4 rounded-lg shadow-lg text-white relative overflow-hidden group hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <!-- Background Decoration -->
            <div class="absolute right-0 bottom-0 opacity-10 transform translate-x-4 translate-y-4 group-hover:translate-x-2 group-hover:translate-y-2 transition-transform duration-300 ">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                </svg>
            </div>

            <div class="relative z-10">
                <div class="flex items-center justify-between mb-3">
                    <h4 class="text-lg font-semibold">Highest Impression</h4>
                    <div class="bg-white bg-opacity-20 rounded-full p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                        </svg>
                    </div>
                </div>
                <p class="text-3xl text-green-400 font-bold">
                    <span data-countup="{{ $stats['highest'] }}" data-duration="1500" data-decimals="0">0</span>
                </p>
                <p class="text-green-200 text-sm mt-2">Peak performance</p>
            </div>
        </div>

        <!-- Lowest Impression Card -->
        <div class="bg-gradient-to-t from-gray-800 to-gray-700 p-4 rounded-lg shadow-lg text-white relative overflow-hidden group hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <!-- Background Decoration -->
            <div class="absolute right-0 bottom-0 opacity-10 transform translate-x-4 translate-y-4 group-hover:translate-x-2 group-hover:translate-y-2 transition-transform duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" />
                </svg>
            </div>

            <div class="relative z-10">
                <div class="flex items-center justify-between mb-3">
                    <h4 class="text-lg font-semibold">Lowest Impression</h4>
                    <div class="bg-white bg-opacity-20 rounded-full p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
                <p class="text-3xl text-red-400 font-bold">
                    <span data-countup="{{ $stats['lowest'] }}" data-duration="1500" data-decimals="0">0</span>
                </p>
                <p class="text-red-200 text-sm mt-2">Minimum reach</p>
            </div>
        </div>

        <!-- Average Impression Card -->
        <div class="bg-gradient-to-t from-gray-800 to-gray-700 p-4 rounded-lg shadow-lg text-white relative overflow-hidden group hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <!-- Background Decoration -->
            <div class="absolute right-0 bottom-0 opacity-10 transform translate-x-4 translate-y-4 group-hover:translate-x-2 group-hover:translate-y-2 transition-transform duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2" />
                </svg>
            </div>

            <div class="relative z-10">
                <div class="flex items-center justify-between mb-3">
                    <h4 class="text-lg font-semibold">Average Impression</h4>
                    <div class="bg-white bg-opacity-20 rounded-full p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16" />
                        </svg>
                    </div>
                </div>
                <p class="text-3xl text-yellow-400 font-bold">
                    <span data-countup="{{ $stats['average'] }}" data-duration="1500" data-decimals="2">0</span>
                </p>
                <p class="text-yellow-200 text-sm mt-2">Mean daily performance</p>
            </div>
        </div>

        <!-- Total Impression Card -->
        <div class="bg-gradient-to-t from-gray-800 to-gray-700 p-4 rounded-lg shadow-lg text-white relative overflow-hidden group hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
            <!-- Background Decoration -->
            <div class="absolute right-0 bottom-0 opacity-10 transform translate-x-4 translate-y-4 group-hover:translate-x-2 group-hover:translate-y-2 transition-transform duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                </svg>
            </div>

            <div class="relative z-10">
                <div class="flex items-center justify-between mb-3">
                    <h4 class="text-lg font-semibold">Total Impression</h4>
                    <div class="bg-white bg-opacity-20 rounded-full p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                </div>
                <p class="text-3xl text-indigo-600 font-bold">
                    <span data-countup="{{ $stats['total'] }}" data-duration="1800" data-decimals="0">0</span>
                </p>
                <p class="text-indigo-200 text-sm mt-2">Overall reach</p>
            </div>
        </div>
    </div>

    <!-- Mobile Stats Summary Card (Hidden on Desktop) -->
    <div class="md:hidden mb-4">
        <div class="bg-gray-700 rounded-lg shadow-md overflow-hidden">
            <!-- Header with Toggle Button -->
            <div class="flex justify-between items-center p-4 bg-gradient-to-r from-gray-700 to-gray-800">
                <h3 class="text-lg font-semibold text-white">Impression Statistics</h3>
                <button id="toggleMobileStatsSummary" class="text-gray-300 hover:text-white bg-gray-600 bg-opacity-30 rounded-full p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
            </div>

            <!-- Collapsible Content -->
            <div id="mobileStatsSummaryContent" class="divide-y divide-gray-600">
                <!-- Total Section -->
                <div class="p-3 flex justify-between items-center">
                    <div class="flex items-center">
                        <div class="bg-indigo-500 bg-opacity-20 p-2 rounded-full mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-sm text-gray-400">Total Impression</div>
                            <div class="text-white font-semibold">
                                <span data-countup="{{ $stats['total'] }}" data-duration="1800" data-decimals="0">0</span>
                            </div>
                        </div>
                    </div>
                    <div class="text-indigo-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                </div>

                <!-- Highest Section -->
                <div class="p-3 flex justify-between items-center">
                    <div class="flex items-center">
                        <div class="bg-green-500 bg-opacity-20 p-2 rounded-full mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-sm text-gray-400">Highest Impression</div>
                            <div class="text-white font-semibold">
                                <span data-countup="{{ $stats['highest'] }}" data-duration="1500" data-decimals="0">0</span>
                            </div>
                        </div>
                    </div>
                    <div class="text-green-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                        </svg>
                    </div>
                </div>

                <!-- Lowest Section -->
                <div class="p-3 flex justify-between items-center">
                    <div class="flex items-center">
                        <div class="bg-red-500 bg-opacity-20 p-2 rounded-full mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-sm text-gray-400">Lowest Impression</div>
                            <div class="text-white font-semibold">
                                <span data-countup="{{ $stats['lowest'] }}" data-duration="1500" data-decimals="0">0</span>
                            </div>
                        </div>
                    </div>
                    <div class="text-red-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>

                <!-- Average Section -->
                <div class="p-3 flex justify-between items-center">
                    <div class="flex items-center">
                        <div class="bg-yellow-500 bg-opacity-20 p-2 rounded-full mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2" />
                            </svg>
                        </div>
                        <div>
                            <div class="text-sm text-gray-400">Average Impression</div>
                            <div class="text-white font-semibold">
                                <span data-countup="{{ $stats['average'] }}" data-duration="1500" data-decimals="2">0</span>
                            </div>
                        </div>
                    </div>
                    <div class="text-yellow-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add this script to the page -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButton = document.getElementById('toggleMobileStatsSummary');
        const content = document.getElementById('mobileStatsSummaryContent');
        let isExpanded = true;

        if (toggleButton && content) {
            toggleButton.addEventListener('click', () => {
                isExpanded = !isExpanded;
                content.style.display = isExpanded ? 'block' : 'none';
                toggleButton.querySelector('svg').classList.toggle('rotate-180', !isExpanded);
            });
        }
    });
</script>
