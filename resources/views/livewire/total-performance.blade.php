<div class="bg-gradient-to-br from-gray-800 via-gray-700 to-gray-800 shadow-lg rounded-2xl p-6 w-full transition-all duration-1000 ease-out transform opacity-0 translate-y-4"
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

    // Ambil data dari backend
    const labels = @json($labels);
    const backendDatasets = @json($datasets);

    // Buat salinan dataset dari backend
    const datasets = [...backendDatasets];

    // Tambahkan dataset line baru
    // Contoh: line dataset berdasarkan data dari dataset pertama
    // Anda bisa menyesuaikan data yang digunakan
    if (datasets.length > 0 && datasets[0].data) {
        datasets.push({
            type: 'line',
            label: 'Trend Line',
            data: datasets[0].data,  // Gunakan data yang sama dengan dataset pertama
            borderColor: 'rgba(255, 99, 132, 1)',
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderWidth: 2,
            fill: false,
            tension: 0.4,
            pointRadius: 3,
            pointHoverRadius: 5,
            pointBackgroundColor: 'rgba(255, 99, 132, 1)',
            // Tambahkan opsi ini untuk memastikan line chart menggunakan sumbu y yang sama
            yAxisID: 'y'
        });
    }

    new Chart(ctx, {
        type: 'bar',  // Tipe utama tetap bar
        data: {
            labels: labels,
            datasets: datasets  // Gunakan datasets yang sudah dimodifikasi
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
