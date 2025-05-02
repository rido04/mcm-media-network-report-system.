<div>
    <div class="bg-slate-800 min-h-screen">
        <!-- Navigation Bar -->
        <nav class="bg-white shadow-sm border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-8">
                <div class="flex justify-between h-14 sm:h-16">
                    <div class="flex">
                        <a href="{{ route('company.dashboard') }}" class="flex items-center px-2 text-gray-700 hover:text-blue-600 transition">
                            <i class="fas fa-arrow-left mr-1"></i>
                            <span class="font-medium text-xs sm:text-sm md:text-base">Back to Dashboard</span>
                        </a>
                    </div>
                    <div class="flex items-center">
                        <span class="text-xs text-gray-500">Profile View</span>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Welcome Animation -->
        <div id="welcome-animation" class="fixed inset-0 flex items-center justify-center bg-white/95 z-50 transition-opacity duration-500">
            <div class="text-center w-full max-w-xs sm:max-w-sm md:max-w-md px-2 sm:px-4">
                <div id="lottie-welcome" class="w-full h-56 sm:h-64 md:h-72 mx-auto flex items-center justify-center">
                    <div id="animation-fallback" class="text-center">
                        <i class="fas fa-smile text-5xl sm:text-6xl text-yellow-400 mb-4 animate-pulse"></i>
                        <p class="text-gray-600 text-base sm:text-lg">Loading welcome...</p>
                    </div>
                </div>
                <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-gray-800 mt-4">Welcome back, {{ $user->name }}!</h2>
                <p class="text-sm sm:text-base md:text-lg text-gray-600 mt-2">Great to see you again</p>
            </div>
        </div>

        <!-- Main Content -->
        <div class="container mx-auto py-4 sm:py-6 px-3 sm:px-4 lg:px-6">
            <div class="max-w-7xl mx-auto">
                <!-- Profile Header -->
                <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-500 to-purple-600 h-24 sm:h-32 md:h-40 relative">
                        <div class="absolute bottom-0 left-0 w-full h-12 bg-gradient-to-t from-black/20 to-transparent"></div>
                    </div>

                    <div class="px-3 sm:px-5 py-4 sm:py-6 -mt-16 sm:-mt-18 md:-mt-20">
                        <div class="flex flex-col sm:flex-row items-center sm:items-end space-y-3 sm:space-y-0">
                            <div class="relative group">
                                @if($user->company_logo)
                                    <img src="{{ asset('storage/' . $user->company_logo) }}" alt="Company Logo"
                                        class="w-24 h-24 sm:w-28 sm:h-28 md:w-32 md:h-32 rounded-full border-4 border-white bg-white object-cover shadow-xl group-hover:shadow-2xl transition-all duration-300">
                                @else
                                    <div class="w-24 h-24 sm:w-28 sm:h-28 md:w-32 md:h-32 rounded-full bg-gradient-to-br from-gray-100 to-gray-200 border-4 border-white flex items-center justify-center shadow-xl group-hover:shadow-2xl transition-all duration-300">
                                        <i class="fas fa-building text-gray-400 text-3xl sm:text-4xl"></i>
                                    </div>
                                @endif
                                <div class="absolute -bottom-1 -right-1 bg-green-500 rounded-full w-5 h-5 border-4 border-white flex items-center justify-center">
                                    <span class="sr-only">Active</span>
                                </div>
                            </div>
                            <div class="sm:ml-5 text-center sm:text-left">
                                <h1 class="text-lg sm:text-xl md:text-3xl font-bold text-gray-800">{{ $user->name }}</h1>
                                <p class="text-blue-600 mt-1 font-medium text-xs sm:text-sm">
                                    <i class="fas fa-check-circle mr-1 text-xs"></i> Verified Account
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dashboard Grid Layout -->
                <div class="mt-4 sm:mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-4 md:gap-5">

                    <!-- Quick Stats -->
                    <div class="bg-white shadow-md rounded-xl p-3 sm:p-4 md:p-5">
                        <h2 class="text-base sm:text-lg font-semibold text-gray-700 mb-3 flex items-center">
                            <i class="fas fa-chart-line mr-2 text-blue-500"></i>
                            Account Stats
                        </h2>

                        <div class="space-y-3">
                            <div class="flex items-center justify-between p-2 sm:p-3 bg-blue-50 rounded-lg">
                                <div class="flex items-center">
                                    <div class="bg-blue-100 p-1.5 sm:p-2 rounded-full">
                                        <i class="fas fa-calendar-alt text-blue-600 text-xs sm:text-sm"></i>
                                    </div>
                                    <span class="ml-2 sm:ml-3 text-xs sm:text-sm text-gray-700">Member since</span>
                                </div>
                                <span class="text-xs sm:text-sm font-medium">{{ \Carbon\Carbon::parse($user->created_at)->format('M Y') }}</span>
                            </div>

                            <div class="flex items-center justify-between p-2 sm:p-3 bg-green-50 rounded-lg">
                                <div class="flex items-center">
                                    <div class="bg-green-100 p-1.5 sm:p-2 rounded-full">
                                        <i class="fas fa-check-circle text-green-600 text-xs sm:text-sm"></i>
                                    </div>
                                    <span class="ml-2 sm:ml-3 text-xs sm:text-sm text-gray-700">Status</span>
                                </div>
                                <span class="text-xs sm:text-sm font-medium text-green-600">Active</span>
                            </div>

                            <div class="flex items-center justify-between p-2 sm:p-3 bg-purple-50 rounded-lg">
                                <div class="flex items-center">
                                    <div class="bg-purple-100 p-1.5 sm:p-2 rounded-full">
                                        <i class="fas fa-star text-purple-600 text-xs sm:text-sm"></i>
                                    </div>
                                    <span class="ml-2 sm:ml-3 text-xs sm:text-sm text-gray-700">Account type</span>
                                </div>
                                <span class="text-xs sm:text-sm font-medium">Premium</span>
                            </div>
                        </div>
                    </div>

                    <!-- Performance Chart -->
                    <div class="chart-container lg:col-span-2 bg-gradient-to-br from-gray-800 via-gray-700 to-gray-800 rounded-xl p-3 sm:p-5 shadow-lg">
                        <h2 class="text-lg sm:text-xl font-semibold text-white mb-3">Total Performance</h2>
                        <div class="relative w-full h-64 sm:h-72 md:h-80">
                            <!-- add div wrapper with overflow-hidden -->
                            <div class="w-full h-full rounded-lg overflow-hidden">
                                <div id="performanceChart" class="w-full h-full"></div>
                            </div>
                        </div>
                    </div>


                    <!-- Contact Information -->
                    <div class="lg:col-span-2 bg-white shadow-md rounded-xl p-3 sm:p-5">
                        <h2 class="text-base sm:text-lg md:text-xl font-semibold text-gray-700 mb-3 sm:mb-4 flex items-center">
                            <i class="fas fa-id-card-alt mr-2 text-blue-500"></i>
                            Contact Information
                        </h2>

                        <div class="space-y-3 sm:space-y-4">
                            <div class="flex items-start hover:bg-gray-50 p-2 rounded-lg transition-colors">
                                <div class="flex-shrink-0 bg-blue-100 rounded-full p-1.5 sm:p-2 text-blue-600">
                                    <i class="fas fa-map-marker-alt text-xs sm:text-sm"></i>
                                </div>
                                <div class="ml-2 sm:ml-3">
                                    <p class="text-xs font-medium text-gray-500">Company Address</p>
                                    <p class="text-xs sm:text-sm text-gray-700 font-medium">{{ $user->company_address ?: 'Not provided' }}</p>
                                </div>
                            </div>

                            <div class="flex items-start hover:bg-gray-50 p-2 rounded-lg transition-colors">
                                <div class="flex-shrink-0 bg-green-100 rounded-full p-1.5 sm:p-2 text-green-600">
                                    <i class="fas fa-phone text-xs sm:text-sm"></i>
                                </div>
                                <div class="ml-2 sm:ml-3">
                                    <p class="text-xs font-medium text-gray-500">Phone Number</p>
                                    <p class="text-xs sm:text-sm text-gray-700 font-medium">{{ $user->company_phone ?: 'Not provided' }}</p>
                                </div>
                            </div>

                            <div class="flex items-start hover:bg-gray-50 p-2 rounded-lg transition-colors">
                                <div class="flex-shrink-0 bg-purple-100 rounded-full p-1.5 sm:p-2 text-purple-600">
                                    <i class="fas fa-envelope text-xs sm:text-sm"></i>
                                </div>
                                <div class="ml-2 sm:ml-3">
                                    <p class="text-xs font-medium text-gray-500">Email Address</p>
                                    <p class="text-xs sm:text-sm text-gray-700 font-medium">{{ $user->email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Activity Summary -->
                    <div class="bg-white shadow-md rounded-xl p-3 sm:p-5">
                        <h2 class="text-base sm:text-lg font-semibold text-gray-700 mb-3 flex items-center">
                            <i class="fas fa-history mr-2 text-blue-500"></i>
                            Recent Activity
                        </h2>

                        <div class="space-y-2 sm:space-y-3">
                            <div class="flex items-start p-2 border-l-3 sm:border-l-4 border-green-500">
                                <div class="ml-2">
                                    <p class="text-xs sm:text-sm font-medium text-gray-900">Profile updated</p>
                                    <p class="text-xs text-gray-500">2 days ago</p>
                                </div>
                            </div>

                            <div class="flex items-start p-2 border-l-3 sm:border-l-4 border-blue-500">
                                <div class="ml-2">
                                    <p class="text-xs sm:text-sm font-medium text-gray-900">Logged in from new device</p>
                                    <p class="text-xs text-gray-500">1 week ago</p>
                                </div>
                            </div>

                            <div class="flex items-start p-2 border-l-3 sm:border-l-4 border-purple-500">
                                <div class="ml-2">
                                    <p class="text-xs sm:text-sm font-medium text-gray-900">Password changed</p>
                                    <p class="text-xs text-gray-500">2 weeks ago</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="mt-4 sm:mt-6 text-center text-gray-500 text-xs">
                    <p>&copy; {{ date('Y') }} {{ $user->name }}. All rights reserved.</p>
                </div>
            </div>
        </div>

        <!-- Floating Assistant -->
        <div id="floating-assistant"
            class="fixed bottom-3 sm:bottom-4 right-3 sm:right-4 w-12 h-12 sm:w-16 sm:h-16 md:w-20 md:h-20 cursor-pointer hover:scale-110 active:scale-95 transition-transform duration-300 z-40 hover:drop-shadow-lg">
        </div>
    </div>
</div>

<!-- Load Lottie -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.12.2/lottie.min.js"></script>
<script>
    // Make data available to app.js
    window.apexChartData = {
        labels: @json($labels),
        datasets: @json($datasets)
    };

    // Handle welcome animation
    document.addEventListener('DOMContentLoaded', function() {
        const welcomeAnimation = document.getElementById('welcome-animation');

        // Hide animation after 2.5 seconds
        setTimeout(function() {
            welcomeAnimation.classList.add('opacity-0');
            setTimeout(function() {
                welcomeAnimation.style.display = 'none';
            }, 500);
        }, 2500);

        // Initialize Lottie animation if available
        if (window.lottie) {
            try {
                const lottieWelcome = document.getElementById('lottie-welcome');
                const animationFallback = document.getElementById('animation-fallback');

                // Load welcome animation
                const welcomeAnim = lottie.loadAnimation({
                    container: lottieWelcome,
                    renderer: 'svg',
                    loop: true,
                    autoplay: true,
                    path: '/animations/welcome.json', // Adjust path as needed
                });

                // Hide fallback if animation loads successfully
                welcomeAnim.addEventListener('DOMLoaded', function() {
                    if (animationFallback) {
                        animationFallback.style.display = 'none';
                    }
                });
            } catch (e) {
                console.error('Failed to load Lottie animation:', e);
            }
        }

        // Handle responsive chart
        if (window.ApexCharts && window.apexChartData) {
            const chartOptions = {
                chart: {
                    type: 'area',
                    height: '100%',
                    toolbar: {
                        show: false
                    },
                    zoom: {
                        enabled: false
                    },
                    fontFamily: 'inherit'
                },
                colors: ['#3b82f6', '#8b5cf6'],
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'dark',
                        type: 'vertical',
                        shadeIntensity: 0.3,
                        opacityFrom: 0.7,
                        opacityTo: 0.2,
                        stops: [0, 90, 100]
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 2
                },
                grid: {
                    borderColor: 'rgba(255, 255, 255, 0.1)',
                    row: {
                        colors: ['transparent'],
                        opacity: 0.5
                    },
                    xaxis: {
                        lines: {
                            show: false
                        }
                    }
                },
                markers: {
                    size: 0
                },
                xaxis: {
                    categories: window.apexChartData.labels,
                    labels: {
                        style: {
                            colors: 'rgba(255, 255, 255, 0.7)'
                        }
                    },
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: 'rgba(255, 255, 255, 0.7)'
                        }
                    }
                },
                tooltip: {
                    theme: 'dark'
                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'right',
                    labels: {
                        colors: 'rgba(255, 255, 255, 0.7)'
                    }
                }
            };

            // Create series from datasets
            const series = window.apexChartData.datasets.map(dataset => {
                return {
                    name: dataset.label,
                    data: dataset.data
                };
            });

            // Initialize chart
            const chart = new ApexCharts(
                document.querySelector('#performanceChart'),
                {...chartOptions, series}
            );
            chart.render();

            // Handle resize
            const resizeChart = () => {
                chart.updateOptions({
                    chart: {
                        height: '100%'
                    }
                });
            };

            window.addEventListener('resize', resizeChart);
        }
    });
</script>
