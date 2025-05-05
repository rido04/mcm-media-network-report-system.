<div class="chart-container bg-gradient-to-br from-gray-800 via-gray-700 to-gray-800 rounded-xl p-6 shadow-lg opacity-0 transition-all duration-1000 ease-out transform -0 translate-y-4"
     data-scroll-animation>
    <h2 class="text-xl font-semibold text-white mb-4">Total Performance</h2>
    <div class="relative w-full" style="height: 320px;">
        <div class="w-full h-full rounded-lg overflow-hidden">
            <div id="performanceChart" class="w-full h-full"></div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Initialize the chart with data passed from Laravel
    initPerformanceChart(
        @json($labels),
        @json($datasets)
    );

    // Scroll animation functionality
    const animateOnScroll = () => {
        const elements = document.querySelectorAll('[data-scroll-animation]');

        elements.forEach(element => {
            const elementTop = element.getBoundingClientRect().top;
            const windowHeight = window.innerHeight;

            // When element is 100px from the bottom of the viewport
            if (elementTop < windowHeight - 100) {
                element.classList.add('opacity-100', 'translate-y-0');
            }
        });
    };

    // Run once on load
    animateOnScroll();

    // Run on scroll
    window.addEventListener('scroll', animateOnScroll);
});
document.addEventListener('DOMContentLoaded', function() {
    // Initialize the chart with data passed from Laravel
    initPerformanceChart(
        @json($labels),
        @json($datasets)
    );
});
</script>
