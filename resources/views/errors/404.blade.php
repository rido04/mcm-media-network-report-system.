<!DOCTYPE html>
<html>
<head>
    <title>404 Not Found</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('storage/image/logo_mcm.png') }}">
    <style>
        @keyframes waveMove {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        @keyframes sunPulse {
            0%, 100% { transform: scale(1); opacity: 0.9; }
            50% { transform: scale(1.05); opacity: 1; }
        }

        @keyframes cloudFloat {
            0% { transform: translateX(0); }
            50% { transform: translateX(20px); }
            100% { transform: translateX(0); }
        }

        @keyframes birdFly {
            0% { transform: translateX(0) translateY(0); }
            25% { transform: translateX(10px) translateY(-5px); }
            50% { transform: translateX(20px) translateY(0); }
            75% { transform: translateX(10px) translateY(5px); }
            100% { transform: translateX(0) translateY(0); }
        }

        @keyframes palmSway {
            0%, 100% { transform: rotate(0deg); }
            50% { transform: rotate(5deg); }
        }

        @keyframes characterLook {
            0%, 20%, 100% { transform: rotate(0deg); }
            25%, 45% { transform: rotate(-8deg); }
            50%, 70% { transform: rotate(0deg); }
            75%, 95% { transform: rotate(8deg); }
        }

        @keyframes characterJump {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        @keyframes fishJump {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-30px) rotate(15deg); }
        }

        @keyframes boatRock {
            0%, 100% { transform: rotate(-3deg); }
            50% { transform: rotate(3deg); }
        }

        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        @keyframes textBounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .waves {
            animation: waveMove 4s ease-in-out infinite;
        }

        .sun {
            animation: sunPulse 5s ease-in-out infinite;
        }

        .cloud {
            animation: cloudFloat 15s ease-in-out infinite;
        }

        .cloud-2 {
            animation: cloudFloat 20s ease-in-out infinite 2s;
        }

        .bird {
            animation: birdFly 10s ease-in-out infinite;
        }

        .bird-2 {
            animation: birdFly 12s ease-in-out infinite 1s;
        }

        .palm {
            animation: palmSway 5s ease-in-out infinite;
            transform-origin: bottom center;
        }

        .character-head {
            animation: characterLook 10s ease-in-out infinite;
            transform-origin: bottom center;
        }

        .character {
            animation: characterJump 3s ease-in-out infinite;
        }

        .fish {
            animation: fishJump 8s ease-in-out infinite;
        }

        .boat {
            animation: boatRock 5s ease-in-out infinite;
            transform-origin: center bottom;
        }

        .scene {
            animation: fadeIn 1s ease-out forwards;
        }

        .bounce-text {
            animation: textBounce 2s ease-in-out infinite;
        }
    </style>
</head>
<body class="bg-blue-500 text-gray-800 overflow-hidden">
    <!-- Main content -->
    <div class="flex flex-col items-center justify-center min-h-screen text-center px-4 relative overflow-hidden scene">
        <!-- Sky background -->
        <div class="absolute inset-0 bg-gradient-to-b from-blue-300 to-blue-500"></div>

        <!-- Sun -->
        <div class="absolute top-10 right-10 w-24 h-24 rounded-full bg-yellow-300 sun"></div>

        <!-- Clouds -->
        <div class="absolute top-16 left-20 cloud">
            <div class="relative">
                <div class="absolute w-20 h-10 bg-white rounded-full"></div>
                <div class="absolute w-12 h-8 bg-white rounded-full -top-4 -left-2"></div>
                <div class="absolute w-12 h-8 bg-white rounded-full -top-2 left-12"></div>
            </div>
        </div>

        <div class="absolute top-32 right-32 cloud-2">
            <div class="relative">
                <div class="absolute w-16 h-8 bg-white rounded-full"></div>
                <div class="absolute w-10 h-6 bg-white rounded-full -top-3 -left-1"></div>
                <div class="absolute w-10 h-6 bg-white rounded-full -top-1 left-10"></div>
            </div>
        </div>

        <!-- Birds -->
        <div class="absolute top-24 left-40 bird">
            <div class="text-2xl text-gray-800">✈</div>
        </div>

        <div class="absolute top-36 left-60 bird-2">
            <div class="text-lg text-gray-800">✈</div>
        </div>

        <!-- Ocean -->
        <div class="absolute bottom-0 left-0 right-0 h-40 bg-blue-600 waves"></div>

        <!-- Island -->
        <div class="absolute bottom-24 left-1/2 transform -translate-x-1/2">
            <div class="relative">
                <!-- Island base -->
                {{-- <div class="w-64 h-16 bg-yellow-200 rounded-full"></div> --}}

                <!-- Palm tree 1 -->
                <div class="absolute -top-40 left-10 palm">
                    <!-- Trunk -->
                    <div class="w-4 h-32 bg-yellow-800 rounded-full mx-auto"></div>
                    <!-- Leaves -->
                    <div class="absolute -top-8 -left-12 w-32 h-16 bg-green-600 rounded-full transform -rotate-45"></div>
                    <div class="absolute -top-8 -right-12 w-32 h-16 bg-green-600 rounded-full transform rotate-45"></div>
                    <div class="absolute -top-16 -left-2 w-8 h-32 bg-green-600 rounded-full"></div>
                </div>

                <!-- Palm tree 2 -->
                <div class="absolute -top-32 right-10 palm" style="animation-delay: 0.5s;">
                    <!-- Trunk -->
                    <div class="w-3 h-24 bg-yellow-800 rounded-full mx-auto"></div>
                    <!-- Leaves -->
                    <div class="absolute -top-6 -left-8 w-24 h-12 bg-green-600 rounded-full transform -rotate-45"></div>
                    <div class="absolute -top-6 -right-8 w-24 h-12 bg-green-600 rounded-full transform rotate-45"></div>
                    <div class="absolute -top-12 -left-1 w-6 h-24 bg-green-600 rounded-full"></div>
                </div>

                <!-- Lost character -->
                <div class="absolute -top-24 left-1/2 transform -translate-x-1/2 character">
                    <!-- Body -->
                    <div class="w-8 h-12 bg-red-500 rounded-md relative">
                        <!-- Arms -->
                        <div class="absolute top-2 -left-6 w-6 h-3 bg-red-500 rounded-full"></div>
                        <div class="absolute top-2 -right-6 w-6 h-3 bg-red-500 rounded-full"></div>
                        <!-- Legs -->
                        <div class="absolute -bottom-5 left-0 w-3 h-5 bg-blue-800 rounded-md"></div>
                        <div class="absolute -bottom-5 right-0 w-3 h-5 bg-blue-800 rounded-md"></div>
                    </div>

                    <!-- Head -->
                    <div class="character-head">
                        <div class="absolute -top-10 left-1/2 transform -translate-x-1/2 w-10 h-10 bg-amber-200 rounded-full">
                            <!-- Eyes -->
                            <div class="absolute top-3 left-2 w-1.5 h-1.5 bg-black rounded-full"></div>
                            <div class="absolute top-3 right-2 w-1.5 h-1.5 bg-black rounded-full"></div>
                            <!-- Mouth -->
                            <div class="absolute bottom-2 left-1/2 transform -translate-x-1/2 w-4 h-1 bg-black rounded-full"></div>
                        </div>
                    </div>
                </div>

                <!-- Fish jumping -->
                <div class="absolute -bottom-5 left-48 fish">
                    <div class="w-8 h-4 bg-orange-400 rounded-full"></div>
                    <div class="absolute -right-2 top-0 w-4 h-4 bg-orange-400 rounded-r-full"></div>
                    <div class="absolute right-0 -top-2 w-2 h-2 bg-white rounded-full"></div>
                </div>
            </div>
        </div>

        <!-- Distant boat -->
        <div class="absolute bottom-36 right-16 boat">
            <div class="w-20 h-8 bg-gray-100 rounded-md relative">
                <div class="absolute -top-16 left-8 w-2 h-16 bg-gray-800"></div>
                <div class="absolute -top-14 left-10 w-6 h-10 bg-red-500 rounded-r-full"></div>
            </div>
        </div>

        <!-- Content text -->
        <div class="relative z-50 mt-12">
            <h1 class="text-6xl md:text-8xl font-bold text-white mb-2 bounce-text">404</h1>

            <h2 class="text-2xl md:text-3xl font-bold text-white mb-4">PAGE NOT FOUND</h2>

            <p class="text-lg text-white mb-8 max-w-md mx-auto">
                Oops! Looks like you're lost on a deserted island. The page you're looking for has drifted away.
            </p>

            <!-- Home button -->
            <a href="{{ url('/login') }}" class="inline-block group">
                <div class="bg-white px-8 py-3 rounded-full transform transition-all duration-300 hover:scale-105 shadow-lg">
                    <span class="text-blue-600 font-bold">BACK TO SHORE</span>
                </div>
            </a>

            <!-- Branding -->
            <div class="mt-8 flex items-center justify-center">
                <div class="w-2 h-2 rounded-full bg-white animate-pulse mr-2"></div>
                <span class="text-xs text-white">MCM MEDIA NETWORK</span>
            </div>
        </div>
    </div>
</body>
</html>
