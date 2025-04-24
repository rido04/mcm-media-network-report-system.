<div class="rounded-lg shadow-lg mb-4">
    <!-- Header with Title and Description -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
        <div>
            <h3 class="text-xl font-bold text-white">
                Road Traffic Impressions
            </h3>
        </div>
    </div>

    <!-- Stats Summary - Desktop version (hidden on mobile) -->
    <div class="hidden md:grid md:grid-cols-3 gap-4 mb-6">
        <div class="bg-gradient-to-t from-gray-800 to-gray-700 p-4 rounded-lg">
            <div class="text-gray-400 text-xs uppercase font-semibold mb-1">Total Impressions</div>
            <div class="text-2xl font-bold text-white" x-text="new Intl.NumberFormat().format(@js(array_sum($impressions)))"></div>
            <div class="text-indigo-400 text-sm mt-1" x-text="'For ' + @js(ucfirst($timeRange)) + ' period'"></div>
        </div>
        <div class="bg-gradient-to-t from-gray-800 to-gray-700 p-4 rounded-lg">
            <div class="text-gray-400 text-xs uppercase font-semibold mb-1">Average</div>
            <div class="text-2xl font-bold text-white" x-text="new Intl.NumberFormat().format(Math.round(@js(array_sum($impressions)) / @js(count($impressions))))"></div>
            <div class="text-indigo-400 text-sm mt-1">Per data point</div>
        </div>
        <div class="bg-gradient-to-t from-gray-800 to-gray-700 p-4 rounded-lg">
            <div class="text-gray-400 text-xs uppercase font-semibold mb-1">Highest Value</div>
            <div class="text-2xl font-bold text-white" x-text="new Intl.NumberFormat().format(Math.max(...@js($impressions)))"></div>
            <div class="text-indigo-400 text-sm mt-1" id="highestDateDesktop">Peak impression</div>
        </div>
    </div>

    <!-- Mobile Stats Summary (single card, visible only on mobile) -->
    <div class="md:hidden mb-6">
        <div class="bg-gradient-to-t from-gray-800 to-gray-700 p-4 rounded-lg">
            <div class="flex justify-between items-center border-b border-gray-600 pb-3 mb-3">
                <div class="text-gray-400 text-xs uppercase font-semibold">Commuter Summary ({{ ucfirst($timeRange) }})</div>
                <button id="toggleMobileSummary" class="text-gray-400 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
            </div>

            <div id="mobileSummaryContent" class="space-y-4">
                <div class="flex justify-between items-center">
                    <div>
                        <div class="text-sm text-gray-300">Total Impressions</div>
                        <div class="text-lg font-bold text-white" x-text="new Intl.NumberFormat().format(@js(array_sum($impressions)))"></div>
                    </div>
                    <div class="bg-indigo-600 bg-opacity-20 rounded-full p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                </div>

                <div class="flex justify-between items-center">
                    <div>
                        <div class="text-sm text-gray-300">Average</div>
                        <div class="text-lg font-bold text-white" x-text="new Intl.NumberFormat().format(Math.round(@js(array_sum($impressions)) / @js(count($impressions))))"></div>
                    </div>
                    <div class="bg-indigo-600 bg-opacity-20 rounded-full p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                        </svg>
                    </div>
                </div>

                <div class="flex justify-between items-center">
                    <div>
                        <div class="text-sm text-gray-300">Highest Value</div>
                        <div class="text-lg font-bold text-white" x-text="new Intl.NumberFormat().format(Math.max(...@js($impressions)))"></div>
                        <div class="text-xs text-indigo-400 mt-1" id="highestDateMobile">Peak impression</div>
                    </div>
                    <div class="bg-indigo-600 bg-opacity-20 rounded-full p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Container with Card UI -->
    <div class="bg-gradient-to-t from-gray-800 to-gray-700 rounded-lg p-4">
    <!-- Time Range Dropdown -->
    <div class="mt-4 md:mt-0">
        <div class="relative inline-block text-left">
            <select
                wire:model="timeRange"
                wire:change="changeTimeRange($event.target.value)"
                class="block w-full pl-3 pr-10 py-2 text-sm bg-indigo-700 text-white border border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
            >
                <option value="daily">Daily</option>
                <option value="weekly">Weekly</option>
                <option value="monthly">Monthly</option>
                <option value="yearly">Yearly</option>
            </select>
        </div>
    </div>

        <div class="h-80">
            <canvas
                id="RoadTrafficChart-{{ $timeRange }}"
                wire:ignore
                x-data="{
                    chart: null,
                    init() {
                        const ctx = this.$el.getContext('2d');

                        // Define gradient for bar background
                        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
                        gradient.addColorStop(0, 'rgba(99, 102, 241, 0.8)');
                        gradient.addColorStop(1, 'rgba(99, 102, 241, 0.2)');

                        const labels = @js($labels);
                        const data = @js($impressions);

                        this.chart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Impressions',
                                    data: data,
                                    backgroundColor: gradient,
                                    borderColor: 'rgba(99, 102, 241, 1)',
                                    borderWidth: 1,
                                    borderRadius: 4,
                                    hoverBackgroundColor: 'rgba(129, 140, 248, 0.8)',
                                }, {
                                    label: 'Trend',
                                    type: 'line',
                                    data: data,
                                    borderColor: 'rgba(244, 114, 182, 0.8)',
                                    backgroundColor: 'transparent',
                                    borderWidth: 2,
                                    pointRadius: 3,
                                    pointHoverRadius: 5,
                                    pointBackgroundColor: 'rgba(244, 114, 182, 1)',
                                    tension: 0.4,
                                    fill: false
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                interaction: {
                                    mode: 'index',
                                    intersect: false,
                                },
                                plugins: {
                                    legend: {
                                        position: 'top',
                                        labels: {
                                            color: 'white',
                                            font: {
                                                weight: 'bold'
                                            }
                                        }
                                    },
                                    tooltip: {
                                        backgroundColor: 'rgba(17, 24, 39, 0.8)',
                                        titleColor: 'rgba(255, 255, 255, 1)',
                                        bodyColor: 'rgba(255, 255, 255, 0.8)',
                                        borderColor: 'rgba(99, 102, 241, 0.5)',
                                        borderWidth: 1,
                                        padding: 10,
                                        cornerRadius: 6,
                                        callbacks: {
                                            label: function(context) {
                                                return 'Impressions: ' + context.raw.toLocaleString();
                                            }
                                        }
                                    }
                                },
                                scales: {
                                    x: {
                                        grid: {
                                            color: 'rgba(255, 255, 255, 0.05)'
                                        },
                                        ticks: {
                                            color: 'rgba(255, 255, 255, 0.7)',
                                            maxRotation: 45,
                                            minRotation: 45
                                        }
                                    },
                                    y: {
                                        beginAtZero: true,
                                        grid: {
                                            color: 'rgba(255, 255, 255, 0.05)'
                                        },
                                        ticks: {
                                            color: 'rgba(255, 255, 255, 0.7)',
                                            callback: function(value) {
                                                return value.toLocaleString();
                                            }
                                        }
                                    }
                                },
                                animation: {
                                    duration: 1000,
                                    easing: 'easeOutQuart'
                                }
                            }
                        });

                        // Find highest value date
                        const maxIndex = data.indexOf(Math.max(...data));
                        if (maxIndex !== -1) {
                            document.getElementById('highestDateDesktop').innerHTML += ' on ' + labels[maxIndex];
                            document.getElementById('highestDateMobile').innerHTML = 'on ' + labels[maxIndex];
                        }

                        // Mobile summary toggle
                        const toggleButton = document.getElementById('toggleMobileSummary');
                        const content = document.getElementById('mobileSummaryContent');
                        let isExpanded = true;

                        toggleButton.addEventListener('click', () => {
                            isExpanded = !isExpanded;
                            content.style.display = isExpanded ? 'block' : 'none';
                            toggleButton.querySelector('svg').classList.toggle('rotate-180', !isExpanded);
                        });

                        // Update chart when Livewire data changes
                        Livewire.on('refreshChart', () => {
                            if (this.chart) {
                                this.chart.data.labels = @js($labels);
                                this.chart.data.datasets[0].data = @js($impressions);
                                this.chart.data.datasets[1].data = @js($impressions);
                                this.chart.update();

                                // Update highest value date
                                const newData = @js($impressions);
                                const newLabels = @js($labels);
                                const newMaxIndex = newData.indexOf(Math.max(...newData));
                                if (newMaxIndex !== -1) {
                                    document.getElementById('highestDateDesktop').innerHTML = 'Peak impression on ' + newLabels[newMaxIndex];
                                    document.getElementById('highestDateMobile').innerHTML = 'on ' + newLabels[newMaxIndex];
                                }
                            }
                        });
                    }
                }"
            ></canvas>
        </div>
    </div>

    <!-- Download Options -->
    <div class="mt-4 flex justify-end">
        <button
            id="downloadChartBtn"
            class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors text-sm flex items-center"
            onclick="downloadChart()"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
            </svg>
            Download Chart
        </button>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('livewire:load', function() {
        Livewire.on('timeRangeChanged', () => {
            // Force refresh the chart when time range changes
            setTimeout(() => {
                Livewire.emit('refreshChart');
            }, 100);
        });
    });

    function downloadChart() {
        const canvas = document.getElementById('RoadTrafficChart-{{ $timeRange }}');
        const image = canvas.toDataURL('image/png', 1.0);

        // Create download link
        const link = document.createElement('a');
        link.download = 'road-traffic-impressions-{{ $timeRange }}.png';
        link.href = image;
        link.click();
    }
</script>
@endpush
