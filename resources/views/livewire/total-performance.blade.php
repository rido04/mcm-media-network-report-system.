<div class="bg-gradient-to-t from-gray-800 to-gray-700 shadow-lg rounded-2xl p-6 w-full transition-all duration-1000 ease-out transform opacity-0 translate-y-4"
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
