<div>
    <div class="bg-slate-800 min-h-screen">
        <!-- Navigation Bar (improved for mobile) -->
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

        <!-- Welcome Animation (Enhanced size) -->
        <div id="welcome-animation" class="fixed inset-0 flex items-center justify-center bg-white/95 z-50 transition-opacity duration-500">
            <div class="text-center w-full max-w-md px-4">
                <!-- Enhanced Lottie Container with larger dimensions -->
                <div id="lottie-welcome" class="w-full h-72 sm:h-80 md:h-96 mx-auto flex items-center justify-center">
                    <!-- Fallback content (improved) -->
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
            <div class="max-w-4xl mx-auto">
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

                <!-- Quick Stats -->
                <div class="mt-4 sm:mt-6 bg-white shadow-md rounded-xl p-3 sm:p-4">
                    <div class="text-xs sm:text-sm text-gray-500">Member since: {{ \Carbon\Carbon::parse($user->created_at)->format('M Y') }}</div>
                </div>

                <!-- Contact Information -->
                <div class="mt-4 sm:mt-6 bg-white shadow-md rounded-xl p-4 sm:p-6 md:p-8">
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

                <!-- Footer -->
                <div class="mt-6 text-center text-gray-500 text-xs sm:text-sm">
                    <p>&copy; {{ date('Y') }} {{ $user->name }}. All rights reserved.</p>
                </div>
            </div>
        </div>

        <!-- Enhanced Floating Assistant -->
        <div id="floating-assistant"
            class="fixed bottom-4 sm:bottom-6 right-4 sm:right-6 w-16 h-16 sm:w-20 sm:h-20 md:w-24 md:h-24 cursor-pointer hover:scale-110 active:scale-95 transition-transform duration-300 z-40 hover:drop-shadow-lg">
        </div>

        <!-- Lottie Animation Script -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.12.2/lottie.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
            const welcomeContainer = document.getElementById('welcome-animation');
            const fallback = document.getElementById('animation-fallback');
            const userName = "{{ $user->name }}"; // Get username from server

            // Try loading Lottie animation with better error handling
            try {
                const anim = lottie.loadAnimation({
                    container: document.getElementById('lottie-welcome'),
                    renderer: 'svg',
                    loop: false,
                    autoplay: true,
                    path: 'https://assets9.lottiefiles.com/packages/lf20_5tkzkblw.json', // Verified animation
                    rendererSettings: {
                        preserveAspectRatio: 'xMidYMid slice' // Ensure good scaling on all devices
                    }
                });

                // Hide fallback if animation loads
                anim.addEventListener('DOMLoaded', () => {
                    fallback.style.display = 'none';
                });

                // Error handling for animation
                anim.addEventListener('data_failed', () => {
                    showFallbackAnimation();
                });
            } catch (e) {
                console.error("Lottie animation failed to load:", e);
                showFallbackAnimation();
            }

            // Hide welcome animation after 3 seconds with smooth transition
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

            // Load assistant with responsive settings
            try {
                const assistant = lottie.loadAnimation({
                    container: document.getElementById('floating-assistant'),
                    renderer: 'svg',
                    loop: true,
                    autoplay: true,
                    path: 'https://assets9.lottiefiles.com/packages/lf20_5tkzkblw.json', // Helpful robot
                    rendererSettings: {
                        preserveAspectRatio: 'xMidYMid slice' // Better scaling
                    }
                });

                // Add click handler for assistant
                document.getElementById('floating-assistant').addEventListener('click', function() {
                    assistant.playSegments([0, 30], true);
                    setTimeout(() => {
                        // Show help options
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
                // Provide fallback for assistant
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
