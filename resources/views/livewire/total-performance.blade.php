<div class="chart-container bg-gradient-to-br from-gray-800 via-gray-700 to-gray-800 rounded-xl p-6 shadow-lg">
    <h2 class="text-xl font-semibold text-white mb-4">Total Performance</h2>
    <div class="relative w-full" style="height: 320px;">
        <!-- Tambahkan div wrapper dengan overflow-hidden -->
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
});
</script>
