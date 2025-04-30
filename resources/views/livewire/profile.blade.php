<div>
<div class="bg-slate-800 min-h-screen">
    <!-- Navigation Bar -->
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <a href="{{ route('company.dashboard') }}" class="flex items-center px-2 sm:px-3 text-gray-700 hover:text-blue-600 transition">
                        <i class="fas fa-arrow-left mr-1 sm:mr-2"></i>
                        <span class="font-medium text-sm sm:text-base">Back to Dashboard</span>
                    </a>
                </div>
                <div class="flex items-center">
                    <span class="text-xs sm:text-sm text-gray-500">Profile View</span>
                </div>
            </div>
        </div>
    </nav>

    <!-- Welcome Animation -->
    <div id="welcome-animation" class="fixed inset-0 flex items-center justify-center bg-white/95 z-50 transition-opacity duration-500">
        <div class="text-center w-full max-w-md px-4">
            <div id="lottie-welcome" class="w-full h-72 sm:h-80 md:h-96 mx-auto flex items-center justify-center">
                <div id="animation-fallback" class="text-center">
                    <i class="fas fa-smile text-6xl sm:text-7xl text-yellow-400 mb-4 animate-pulse"></i>
                    <p class="text-gray-600 text-lg sm:text-xl">Loading welcome...</p>
                </div>
            </div>
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-800 mt-4">Welcome back, {{ $user->name }}!</h2>
            <p class="text-base sm:text-lg md:text-xl text-gray-600 mt-2">Great to see you again</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto py-6 sm:py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Profile Header -->
            <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
                <div class="bg-gradient-to-r from-blue-500 to-purple-600 h-32 sm:h-40 relative">
                    <div class="absolute bottom-0 left-0 w-full h-16 bg-gradient-to-t from-black/20 to-transparent"></div>
                </div>

                <div class="px-4 sm:px-6 py-6 md:p-8 -mt-20">
                    <div class="flex flex-col md:flex-row items-center md:items-end space-y-4 md:space-y-0">
                        <div class="relative group">
                            @if($user->company_logo)
                                <img src="{{ asset('storage/' . $user->company_logo) }}" alt="Company Logo"
                                    class="w-28 h-28 sm:w-32 sm:h-32 md:w-36 md:h-36 rounded-full border-4 border-white bg-white object-cover shadow-xl group-hover:shadow-2xl transition-all duration-300">
                            @else
                                <div class="w-28 h-28 sm:w-32 sm:h-32 md:w-36 md:h-36 rounded-full bg-gradient-to-br from-gray-100 to-gray-200 border-4 border-white flex items-center justify-center shadow-xl group-hover:shadow-2xl transition-all duration-300">
                                    <i class="fas fa-building text-gray-400 text-4xl sm:text-5xl"></i>
                                </div>
                            @endif
                            <div class="absolute -bottom-1 -right-1 bg-green-500 rounded-full w-6 h-6 border-4 border-white flex items-center justify-center">
                                <span class="sr-only">Active</span>
                            </div>
                        </div>
                        <div class="md:ml-6 text-center md:text-left">
                            <h1 class="text-xl sm:text-2xl md:text-4xl font-bold text-gray-800">{{ $user->name }}</h1>
                            <p class="text-blue-600 mt-1 font-medium text-sm sm:text-base">
                                <i class="fas fa-check-circle mr-1 text-sm"></i> Verified Account
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dashboard Grid Layout -->
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">

                <!-- Performance Chart -->
                <div class="lg:col-span-2 bg-gradient-to-br from-gray-800 via-gray-700 to-gray-800 shadow-lg rounded-2xl p-6 transition-all duration-1000 ease-out transform opacity-0 translate-y-4"
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
                        <div id="performanceChart" class="w-full h-full"></div>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="bg-white shadow-md rounded-xl p-5">
                    <h2 class="text-lg font-semibold text-gray-700 mb-4 flex items-center">
                        <i class="fas fa-chart-line mr-2 text-blue-500"></i>
                        Account Stats
                    </h2>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="bg-blue-100 p-2 rounded-full">
                                    <i class="fas fa-calendar-alt text-blue-600"></i>
                                </div>
                                <span class="ml-3 text-gray-700">Member since</span>
                            </div>
                            <span class="font-medium">{{ \Carbon\Carbon::parse($user->created_at)->format('M Y') }}</span>
                        </div>

                        <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="bg-green-100 p-2 rounded-full">
                                    <i class="fas fa-check-circle text-green-600"></i>
                                </div>
                                <span class="ml-3 text-gray-700">Status</span>
                            </div>
                            <span class="font-medium text-green-600">Active</span>
                        </div>

                        <div class="flex items-center justify-between p-3 bg-purple-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="bg-purple-100 p-2 rounded-full">
                                    <i class="fas fa-star text-purple-600"></i>
                                </div>
                                <span class="ml-3 text-gray-700">Account type</span>
                            </div>
                            <span class="font-medium">Premium</span>
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="lg:col-span-2 bg-white shadow-md rounded-xl p-4 sm:p-6 md:p-8">
                    <h2 class="text-lg sm:text-xl font-semibold text-gray-700 mb-4 sm:mb-6 flex items-center">
                        <i class="fas fa-id-card-alt mr-2 sm:mr-3 text-blue-500"></i>
                        Contact Information
                    </h2>

                    <div class="space-y-4 sm:space-y-6">
                        <div class="flex items-start hover:bg-gray-50 p-2 sm:p-3 rounded-lg transition-colors">
                            <div class="flex-shrink-0 bg-blue-100 rounded-full p-2 sm:p-3 text-blue-600">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="ml-3 sm:ml-4">
                                <p class="text-xs sm:text-sm font-medium text-gray-500">Company Address</p>
                                <p class="text-sm sm:text-base text-gray-700 font-medium">{{ $user->company_address ?: 'Not provided' }}</p>
                            </div>
                        </div>

                        <div class="flex items-start hover:bg-gray-50 p-2 sm:p-3 rounded-lg transition-colors">
                            <div class="flex-shrink-0 bg-green-100 rounded-full p-2 sm:p-3 text-green-600">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="ml-3 sm:ml-4">
                                <p class="text-xs sm:text-sm font-medium text-gray-500">Phone Number</p>
                                <p class="text-sm sm:text-base text-gray-700 font-medium">{{ $user->company_phone ?: 'Not provided' }}</p>
                            </div>
                        </div>

                        <div class="flex items-start hover:bg-gray-50 p-2 sm:p-3 rounded-lg transition-colors">
                            <div class="flex-shrink-0 bg-purple-100 rounded-full p-2 sm:p-3 text-purple-600">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="ml-3 sm:ml-4">
                                <p class="text-xs sm:text-sm font-medium text-gray-500">Email Address</p>
                                <p class="text-sm sm:text-base text-gray-700 font-medium">{{ $user->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Activity Summary -->
                <div class="bg-white shadow-md rounded-xl p-5">
                    <h2 class="text-lg font-semibold text-gray-700 mb-4 flex items-center">
                        <i class="fas fa-history mr-2 text-blue-500"></i>
                        Recent Activity
                    </h2>

                    <div class="space-y-3">
                        <div class="flex items-start p-2 border-l-4 border-green-500">
                            <div class="ml-2">
                                <p class="text-sm font-medium text-gray-900">Profile updated</p>
                                <p class="text-xs text-gray-500">2 days ago</p>
                            </div>
                        </div>

                        <div class="flex items-start p-2 border-l-4 border-blue-500">
                            <div class="ml-2">
                                <p class="text-sm font-medium text-gray-900">Logged in from new device</p>
                                <p class="text-xs text-gray-500">1 week ago</p>
                            </div>
                        </div>

                        <div class="flex items-start p-2 border-l-4 border-purple-500">
                            <div class="ml-2">
                                <p class="text-sm font-medium text-gray-900">Password changed</p>
                                <p class="text-xs text-gray-500">2 weeks ago</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="mt-6 text-center text-gray-500 text-xs sm:text-sm">
                <p>&copy; {{ date('Y') }} {{ $user->name }}. All rights reserved.</p>
            </div>
        </div>
    </div>

    <!-- Floating Assistant -->
    <div id="floating-assistant"
        class="fixed bottom-4 sm:bottom-6 right-4 sm:right-6 w-16 h-16 sm:w-20 sm:h-20 md:w-24 md:h-24 cursor-pointer hover:scale-110 active:scale-95 transition-transform duration-300 z-40 hover:drop-shadow-lg">
    </div>

    <!-- Scripts -->
    <!-- Load ApexCharts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.41.0/apexcharts.min.js"></script>
    <!-- Load Lottie -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.12.2/lottie.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Welcome Animation Handling
            const welcomeContainer = document.getElementById('welcome-animation');
            const fallback = document.getElementById('animation-fallback');
            const userName = "{{ $user->name }}";

            try {
                const anim = lottie.loadAnimation({
                    container: document.getElementById('lottie-welcome'),
                    renderer: 'svg',
                    loop: false,
                    autoplay: true,
                    path: 'https://assets9.lottiefiles.com/packages/lf20_5tkzkblw.json',
                    rendererSettings: {
                        preserveAspectRatio: 'xMidYMid slice'
                    }
                });

                anim.addEventListener('DOMLoaded', () => {
                    fallback.style.display = 'none';
                });

                anim.addEventListener('data_failed', () => {
                    showFallbackAnimation();
                });
            } catch (e) {
                console.error("Lottie animation failed to load:", e);
                showFallbackAnimation();
            }

            setTimeout(() => {
                welcomeContainer.style.opacity = '0';
                setTimeout(() => {
                    welcomeContainer.style.display = 'none';
                }, 500);
            }, 3000);

            function showFallbackAnimation() {
                fallback.innerHTML = `
                    <div class="animate-bounce">
                        <i class="fas fa-hand-peace text-5xl sm:text-6xl text-blue-500 mb-4"></i>
                        <p class="text-gray-600 text-lg sm:text-xl">Welcome ${userName}!</p>
                    </div>
                `;
                fallback.style.display = 'block';
            }

            // Initialize ApexCharts
            // Use fallback data if vars not defined
            let labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
            let barData = [44, 55, 57, 56, 61, 58];
            let chartTitle = 'Performance';

            // Try to get the data from PHP variables if they exist
            try {
                const dataLabels = @json($labels ?? null);
                const datasets = @json($datasets ?? null);

                if (dataLabels) {
                    labels = dataLabels;
                }

                if (datasets && datasets[0] && datasets[0].data) {
                    barData = datasets[0].data;
                }

                if (datasets && datasets[0] && datasets[0].label) {
                    chartTitle = datasets[0].label;
                }
            } catch (e) {
                console.error("Error parsing chart data:", e);
                // Use fallback data defined above
            }

            // Create a trend line with higher values than the bar data
            const trendLineData = barData.map(value => {
                const multiplier = Math.random() * 0.1 + 1.15; // Random between 1.15 and 1.25
                return Math.round(value * multiplier);
            });

            const options = {
                chart: {
                    type: 'area', // Changed to area chart
                    height: 320,
                    fontFamily: "'Inter', sans-serif",
                    toolbar: {
                        show: false
                    },
                    background: 'transparent',
                    foreColor: '#fff'
                },
                series: [
                    {
                        name: chartTitle,
                        data: barData
                    },
                    {
                        name: 'Trend Line',
                        data: trendLineData
                    }
                ],
                colors: ['#4F46E5', '#EC4899'],
                fill: {
                    type: ['gradient', 'gradient'],
                    gradient: {
                        shade: 'dark',
                        type: "vertical",
                        shadeIntensity: 0.3,
                        opacityFrom: 0.7,
                        opacityTo: 0.2,
                        stops: [0, 90, 100]
                    }
                },
                stroke: {
                    curve: 'smooth',
                    width: [2, 2]
                },
                grid: {
                    borderColor: 'rgba(255, 255, 255, 0.1)',
                    strokeDashArray: 3,
                    xaxis: {
                        lines: {
                            show: false
                        }
                    },
                    yaxis: {
                        lines: {
                            show: true
                        }
                    }
                },
                dataLabels: {
                    enabled: false
                },
                xaxis: {
                    categories: labels,
                    labels: {
                        style: {
                            colors: '#fff',
                            fontSize: '12px',
                            fontFamily: "'Inter', sans-serif"
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
                            colors: '#fff',
                            fontSize: '12px',
                            fontFamily: "'Inter', sans-serif"
                        }
                    }
                },
                legend: {
                    position: 'bottom',
                    horizontalAlign: 'center',
                    fontSize: '12px',
                    fontFamily: "'Inter', sans-serif",
                    labels: {
                        colors: '#fff'
                    },
                    markers: {
                        radius: 12
                    }
                },
                tooltip: {
                    theme: 'dark',
                    x: {
                        show: true
                    },
                    y: {
                        title: {
                            formatter: function (seriesName) {
                                return seriesName;
                            }
                        }
                    }
                },
                responsive: [
                    {
                        breakpoint: 768,
                        options: {
                            chart: {
                                height: 280
                            },
                            legend: {
                                fontSize: '10px'
                            }
                        }
                    }
                ]
            };

            const chart = new ApexCharts(document.querySelector("#performanceChart"), options);
            chart.render();

            // Load assistant with responsive settings
            try {
                const assistant = lottie.loadAnimation({
                    container: document.getElementById('floating-assistant'),
                    renderer: 'svg',
                    loop: true,
                    autoplay: true,
                    path: 'https://assets9.lottiefiles.com/packages/lf20_5tkzkblw.json',
                    rendererSettings: {
                        preserveAspectRatio: 'xMidYMid slice'
                    }
                });

                document.getElementById('floating-assistant').addEventListener('click', function() {
                    assistant.playSegments([0, 30], true);
                    setTimeout(() => {
                        const helpOptions = confirm("Need help?\n\nOK: Contact Support\nCancel: View Tutorial");
                        if(helpOptions) {
                            window.location.href = "/contact";
                        } else {
                            window.open("/tutorial", "_blank");
                        }
                    }, 500);
                });
            } catch (e) {
                console.error("Assistant animation failed to load:", e);
                const assistantElement = document.getElementById('floating-assistant');
                assistantElement.innerHTML = `
                    <div class="w-full h-full bg-blue-500 rounded-full flex items-center justify-center shadow-lg">
                        <i class="fas fa-question text-white text-2xl sm:text-3xl"></i>
                    </div>
                `;
            }
        });
    </script>
</div>
</div>
