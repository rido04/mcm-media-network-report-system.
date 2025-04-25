<div class="transition-all duration-1000 ease-out transform opacity-0 translate-y-4"
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
    <div class="bg-gradient-to-br from-gray-800 via-gray-700 to-gray-800 p-4 rounded-lg shadow mb-4">
        <!-- Time Range Filter -->
        <div class="flex justify-end mb-4">
            <div class="inline-flex rounded-md shadow-sm">
                <button
                    wire:click="changeTimeRange('daily')"
                    type="button"
                    class="px-4 py-2 text-sm font-medium rounded-l-lg {{ $timeRange === 'daily' ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }}"
                >
                    Daily
                </button>
                <button
                    wire:click="changeTimeRange('weekly')"
                    type="button"
                    class="px-4 py-2 text-sm font-medium {{ $timeRange === 'weekly' ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }}"
                >
                    Weekly
                </button>
                <button
                    wire:click="changeTimeRange('monthly')"
                    type="button"
                    class="px-4 py-2 text-sm font-medium rounded-r-lg {{ $timeRange === 'monthly' ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }}"
                >
                    Monthly
                </button>
            </div>
        </div>

        <!-- Chart Title -->
        <h3 class="text-lg font-medium text-gray-900 mb-2">
            Commuterline Impressions - {{ ucfirst($timeRange) }} View
        </h3>

        <!-- Chart Container -->
        <div class="mt-4">
            <canvas
                id="commuterlineChart-{{ $timeRange }}"
                wire:ignore
                x-data="{
                    chart: null,
                    init() {
                        const ctx = this.$el.getContext('2d');
                        this.chart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: @js($labels),
                                datasets: [{
                                    label: 'Impressions',
                                    data: @js($impressions),
                                    backgroundColor: 'rgba(79, 70, 229, 0.7)',
                                    borderColor: 'rgba(79, 70, 229, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        display: false
                                    },
                                    tooltip: {
                                        callbacks: {
                                            label: function(context) {
                                                return 'Impressions: ' + context.raw.toLocaleString();
                                            }
                                        }
                                    }
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        ticks: {
                                            callback: function(value) {
                                                return value.toLocaleString();
                                            }
                                        }
                                    }
                                }
                            }
                        });

                        // Update chart when Livewire data changes
                        Livewire.on('refreshChart', () => {
                            if (this.chart) {
                                this.chart.data.labels = @js($labels);
                                this.chart.data.datasets[0].data = @js($impressions);
                                this.chart.update();
                            }
                        });
                    }
                }"
            ></canvas>
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
    </script>
    @endpush
</div>
