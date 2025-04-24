<div class="bg-gradient-to-r from-gray-700 via-gray-600 to-gray-700 rounded-2xl shadow-lg p-4 sm:p-6">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-4 space-y-2 sm:space-y-0">
        <h3 class="text-lg sm:text-xl font-bold text-white">Placement Overview per City</h3>
    </div>

    <div class="relative w-full h-[200px] sm:h-[300px]">
        <canvas
            id="placementChart"
            wire:ignore
            class="!w-full !h-full"
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
                                    ticks: {
                                        color: '#e5e7eb',
                                        autoSkip: true,
                                        maxRotation: 45,
                                        font: { size: 12 }
                                    }
                                },
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        color: '#e5e7eb',
                                        stepSize: 1,
                                        font: { size: 12 }
                                    },
                                    grid: {
                                        color: 'rgba(255, 255, 255, 0.1)',
                                        drawBorder: false
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'top',
                                    labels: {
                                        color: '#f3f4f6',
                                        font: { size: 12 }
                                    }
                                },
                                tooltip: {
                                    mode: 'index',
                                    intersect: false,
                                    backgroundColor: '#1f2937',
                                    titleColor: '#fff',
                                    bodyColor: '#d1d5db',
                                    borderColor: '#374151',
                                    borderWidth: 1,
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
