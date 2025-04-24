<div class="bg-gradient-to-t from-gray-800 to-gray-700 shadow-lg rounded-2xl p-6 w-full">
    <h2 class="text-xl font-semibold text-white mb-4">Total Performance</h2>
    <div class="relative w-full" style="height: 320px;">
        <canvas id="performanceChart" class="w-full h-full"></canvas>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('performanceChart').getContext('2d');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($labels),
                datasets: @json($datasets),
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: 10
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: 'white',
                            font: {
                                size: 12,
                                family: "'Inter', sans-serif"
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1F2937',
                        titleColor: 'white',
                        bodyColor: 'white',
                        mode: 'index',
                        intersect: false
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: 'white',
                            font: {
                                size: 11,
                                family: "'Inter', sans-serif"
                            }
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.05)',
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: 'white',
                            font: {
                                size: 11,
                                family: "'Inter', sans-serif"
                            }
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.05)',
                        }
                    }
                }
            }
        });
    });
</script>
