<!DOCTYPE html>
<html>
<head>
    <title>403 Forbidden</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes redCarpetRoll {
            0% { transform: translateX(-100%); }
            40% { transform: translateX(0); }
            100% { transform: translateX(0); }
        }

        @keyframes bodyguardEnter {
            0% { transform: translateX(100%); opacity: 0; }
            40% { transform: translateX(100%); opacity: 0; }
            70% { transform: translateX(0); opacity: 1; }
            80% { transform: translateX(0) rotate(0deg); }
            85% { transform: translateX(0) rotate(-5deg); }
            90% { transform: translateX(0) rotate(0deg); }
            95% { transform: translateX(0) rotate(-5deg); }
            100% { transform: translateX(0) rotate(0deg); }
        }

        @keyframes flashEffect {
            0%, 100% { opacity: 0; }
            5% { opacity: 0.4; }
            10% { opacity: 0; }
            15% { opacity: 0.3; }
            20% { opacity: 0; }
        }

        @keyframes accessDeniedAppear {
            0%, 60% { opacity: 0; transform: translateY(20px); }
            80% { opacity: 1; transform: translateY(0); }
            100% { opacity: 1; transform: translateY(0); }
        }

        .red-carpet {
            animation: redCarpetRoll 2s ease-out forwards;
        }

        .bodyguard {
            animation: bodyguardEnter 3s ease-out forwards;
        }

        .flash-effect {
            animation: flashEffect 4s ease-out infinite;
        }

        .access-denied {
            animation: accessDeniedAppear 3s ease-out forwards;
        }

        .hand-gesture {
            transform-origin: bottom center;
            animation: handGesture 1.5s ease-in-out 3s infinite;
        }

        @keyframes handGesture {
            0%, 100% { transform: rotate(0deg); }
            50% { transform: rotate(15deg); }
        }
    </style>
</head>
<body class="bg-gray-900 text-gray-100 overflow-hidden">
    <!-- Background with film strip and velvet texture -->
    <div class="absolute inset-0 -z-10 opacity-10 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAiIGhlaWdodD0iMTAwIiB2aWV3Qm94PSIwIDAgMTAwIDEwMCI+PHBhdGggZD0iTTAgMGgyMHYxMDBIMHoiIGZpbGw9IiNGRkYiIG9wYWNpdHk9IjAuMSIvPjxwYXRoIGQ9Ik00MCAwaDIwdjEwMEg0MHoiIGZpbGw9IiNGRkYiIG9wYWNpdHk9IjAuMSIvPjxwYXRoIGQ9Ik04MCAwaDIwdjEwMEg4MHoiIGZpbGw9IiNGRkYiIG9wYWNpdHk9IjAuMSIvPjwvc3ZnPg==')]"></div>

    <!-- Camera flash effect -->
    <div class="absolute inset-0 bg-white opacity-0 -z-10 flash-effect"></div>

    <!-- Main content -->
    <div class="flex flex-col items-center justify-center min-h-screen text-center px-4 relative overflow-hidden">

        <!-- Red Carpet -->
        <div class="absolute bottom-0 left-0 right-0 h-32 bg-red-600 red-carpet z-10"></div>

        <!-- Velvet Rope -->
        <div class="absolute bottom-32 left-1/2 transform -translate-x-1/2 z-20">
            <div class="w-64 h-px bg-yellow-400"></div>
        </div>

        <!-- Bodyguard SVG -->
        <div class="absolute bottom-32 left-1/2 transform -translate-x-1/2 bodyguard z-30">
            <svg width="200" height="300" viewBox="0 0 200 300" fill="none" xmlns="http://www.w3.org/2000/svg">
                <!-- Body -->
                <rect x="70" y="100" width="60" height="150" fill="black"/>

                <!-- Head -->
                <circle cx="100" cy="60" r="40" fill="#D1A080"/>

                <!-- Sunglasses -->
                <rect x="70" y="50" width="60" height="20" rx="5" fill="black"/>

                <!-- Earpiece -->
                <rect x="140" y="60" width="10" height="20" fill="black"/>
                <path d="M140 70 C 150 70, 150 60, 150 60" stroke="black" stroke-width="3"/>

                <!-- Arms -->
                <rect x="40" y="110" width="30" height="80" fill="black"/>
                <rect x="130" y="110" width="30" height="80" fill="black"/>

                <!-- Hand making "stop" gesture -->
                <rect x="30" y="110" width="40" height="10" fill="#D1A080" class="hand-gesture"/>

                <!-- Tie -->
                <path d="M100 100 L110 120 L100 250 L90 120 Z" fill="red"/>

                <!-- Legs -->
                <rect x="70" y="250" width="25" height="50" fill="black"/>
                <rect x="105" y="250" width="25" height="50" fill="black"/>
            </svg>
        </div>

        <!-- Content -->
        <div class="relative z-40 access-denied flex flex-col items-center">
            <div class="bg-black bg-opacity-80 p-6 rounded-lg shadow-2xl max-w-md">
                <h1 class="text-3xl md:text-4xl font-bold text-red-500 mb-6">ACCESS DENIED</h1>

                <div class="mb-6">
                    <span class="inline-block px-3 py-1 bg-red-600 text-white font-bold rounded-md">403</span>
                    <span class="ml-2 text-xl text-gray-300">FORBIDDEN</span>
                </div>

                <p class="text-lg md:text-xl text-gray-300 mb-6">
                    @auth
                        @php
                            $user = auth()->user();
                        @endphp

                        @if($user && $user->hasRole('company'))
                            <p class="text-base md:text-lg text-gray-400">
                                You are registered as <strong class="text-red-400">Client</strong>, Admin page is restricted for you.
                            </p>
                        @elseif($user && $user->hasRole('admin'))
                            <p class="text-base md:text-lg text-gray-400">
                                You are registered as <strong class="text-red-400">Admin</strong>, Client page is restricted for you.
                            </p>
                        @else
                            <p class="text-base md:text-lg text-gray-400">You don't have permission to access this page.</p>
                        @endif
                    @else
                        <p class="text-base md:text-lg text-gray-400">Please login to access this page.</p>
                    @endauth
                </p>

                <!-- Action button styled like a VIP pass -->
                <a href="{{ url('/login') }}" class="inline-block group">
                    <div class="bg-gradient-to-r from-blue-600 to-blue-600 px-8 py-3 rounded-md transform transition-all duration-300 group-hover:scale-105 shadow-lg">
                        <span class="text-red-700 font-bold">BACK TO LOGIN</span>
                    </div>
                </a>
            </div>

            <!-- Subtle "On Air" indicator -->
            <div class="mt-12 flex items-center">
                <div class="w-3 h-3 rounded-full bg-slate-500 animate-pulse mr-2"></div>
                <span class="text-xs text-gray-500">MCM MEDIA NETWORK</span>
            </div>
        </div>
    </div>
</body>
</html>
