<div class="bg-gray-600 rounded-xl shadow-md p-4 sm:p-6">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2 mb-4">
        <h3 class="text-base sm:text-lg font-semibold text-white">Placement Overview per City</h3>
    </div>

    <div class="w-full h-[200px] sm:h-[250px]">
        <canvas
            id="placementChart"
            wire:ignore
            x-data="{
                chart: null,
                init() {
                    this.initChart();
                },
                initChart() {
                    this.chart = new Chart(this.$el, {
                        type: 'bar',
                        data: @js($chartData),
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                x: {
                                    stacked: false,
                                    grid: { display: false },
                                    ticks: { color: '#fff', autoSkip: true, maxRotation: 45 }
                                },
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        color: '#fff',
                                        stepSize: 1
                                    },
                                    grid: { color: 'rgba(255,255,255,0.1)' }
                                }
                            },
                            plugins: {
                                legend: {
                                    labels: { color: '#fff' },
                                    position: 'top'
                                },
                                tooltip: {
                                    mode: 'index',
                                    intersect: false,
                                    callbacks: {
                                        label: function(context) {
                                            const dataset = context.dataset;
                                            const index = context.dataIndex;
                                            const city = dataset.city ? dataset.city[index] : 'Unknown';
                                            const value = context.formattedValue;
                                            return `${dataset.label}: ${value} (City: ${city})`;
                                        }
                                    }
                                }
                            }
                        }
                    });
                }
            }"
        ></canvas>
    </div>
</div>
