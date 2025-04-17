<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - MCM Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('storage/image/logo_mcm.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Add Lottie Player library -->
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <style type="text/tailwindcss">
        @layer utilities {
            .bg-twitter-light {
                background-color: #bdafee;
            }
            .text-twitter-dark {
                color: #0F1419;
            }
            .border-twitter {
                border-color: #CFD9DE;
            }
            .focus-outline-twitter {
                outline-color: #1D9BF0;
            }
        }
    </style>
</head>
<body class="font-poppins flex flex-col md:flex-row min-h-screen overflow-x-hidden bg-zinc-950">
    <!-- Left Section with Hero Content -->
    <div class="flex-1 flex items-center justify-center p-4 md:p-8 min-h-[40vh] md:min-h-screen w-full md:w-1/2">
        <div class="max-w-[280px] md:max-w-[380px] w-full flex flex-col items-center text-center">
            <!-- Wrapper div for animation and logo -->
            <div class="relative w-full aspect-square">
                <!-- Lottie animation positioned behind the logo -->
                <div class="absolute inset-0 flex items-center justify-center" style="width: 400px; height: 400px; left: 50%; top: 50%; transform: translate(-50%, -50%);">
                    <lottie-player 
                        src="{{ asset('js/animations/circle.json') }}" 
                        background="transparent" 
                        speed="1" 
                        style="width: 400px; height: 400px; filter: brightness(1.5);" 
                        loop 
                        autoplay
                        renderer="svg">
                    </lottie-player>
                </div>
                <!-- Logo image on top of animation -->
                <img class="relative z-10 w-full max-w-[180px] md:max-w-[250px] h-auto object-contain mx-auto"
                    src="{{ asset('storage/image/logo_mcm.png') }}"
                    alt="MCM Media Network"
                    style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);">
            </div>
        </div>
    </div>

    <!-- Right Section with Login Form -->
    <div class="flex-1 flex flex-col justify-center p-4 md:p-8 w-full md:w-1/2 mx-auto">
        <div class="max-w-md w-full mx-auto rounded-lg shadow-md p-6 md:p-8 backdrop-blur-lg bg-white/70">
            <h2 class="text-2xl md:text-3xl font-medium mb-4 text-twitter-dark">MCM Portal</h2>
            <h4 class="text-lg md:text-xl font-medium mb-6 text-twitter-dark">Login to your account</h4>

            @if ($errors->any())
                <div class="text-red-600 text-sm mb-4">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full p-3 border border-twitter rounded text-twitter-dark bg-white focus:outline focus:outline-1 focus-outline-twitter"
                        placeholder="Email" required>
                </div>
                <div class="mb-6">
                    <input type="password" name="password"
                        class="w-full p-3 border border-twitter rounded text-twitter-dark bg-white focus:outline focus:outline-1 focus-outline-twitter"
                        placeholder="Password" required>
                </div>
                <button type="submit" class="w-full py-3 rounded-full font-bold cursor-pointer border-none text-white bg-blue-400 mb-4 hover:text-black hover:bg-white transition duration-300 ease-in-out">
                    Login
                </button>
            </form>
        </div>
    </div>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        twitter: {
                            blue: '#1D9BF0',
                            dark: '#0F1419',
                            light: '#bdafee',
                            gray: '#536471'
                        }
                    }
                }
            }
        }

        // Add this script to debug if the animation loads
        document.addEventListener('DOMContentLoaded', function() {
            const player = document.querySelector('lottie-player');
            player.addEventListener('ready', () => {
                console.log('Lottie animation is ready and loaded!');
            });
            player.addEventListener('error', (e) => {
                console.error('Lottie error:', e);
            });
        });
    </script>
</body>
</html>