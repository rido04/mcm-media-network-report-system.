<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MCM Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('storage/image/logo_mcm.png') }}" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
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

        /* Custom CSS for the circular animation */
        .logo-animation-container {
            position: relative;
            width: 100%;
            aspect-ratio: 1/1;
            z-index: 1;
            /* Reduce max height to prevent excessive space */
            max-height: 300px;
            margin: 0 auto;
        }

        /* Container for the logo and rings */
        .radio-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background-color: rgba(0, 0, 0, 0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1;
        }

        /* Radio signal rings */
        .radio-ring {
            position: absolute;
            border-radius: 50%;
            border: 2px solid #3e17cc;
            opacity: 0;
            animation: radioPulse 2s infinite ease-out;
            z-index: 0;
        }

        .radio-ring:nth-child(1) {
            width: 100%;
            height: 100%;
            animation-delay: 0s;
        }

        .radio-ring:nth-child(2) {
            width: 130%;
            height: 130%;
            animation-delay: 0.4s;
        }

        .radio-ring:nth-child(3) {
            width: 160%;
            height: 160%;
            animation-delay: 0.8s;
        }

        .radio-ring:nth-child(4) {
            width: 190%;
            height: 190%;
            animation-delay: 1.2s;
        }

        .radio-ring:nth-child(5) {
            width: 220%;
            height: 220%;
            animation-delay: 1.6s;
        }

        @keyframes radioPulse {
            0% {
                transform: scale(0.8);
                opacity: 0.8;
            }
            100% {
                transform: scale(1);
                opacity: 0;
            }
        }

        .logo-img {
            position: relative;
            z-index: 2;
            width: 200px;
            height: auto;
            max-width: 100%;
        }

        /* Add higher z-index to form container */
        .login-form-container {
            position: relative;
            z-index: 10;
        }

        /* Improved responsive layout */
        @media (max-width: 767px) {
            /* More compact layout for mobile */
            .hero-section {
                min-height: 250px;
                padding: 1rem 0;
            }

            .radio-container {
                width: 180px;
                height: 180px;
            }

            .logo-img {
                width: 200px;
            }

            /* Improved spacing for mobile */
            .logo-animation-container {
                max-height: 220px;
            }
        }

        @media (min-width: 768px) {
            .radio-container {
                width: 250px;
                height: 250px;
            }

            .logo-img {
                width: 300px;
            }
        }
    </style>
</head>
<body class="font-[Montserrat] flex flex-col md:flex-row min-h-screen overflow-x-hidden bg-slate-950">
    <!-- Left Section with Hero Content - added more specific class name -->
    <div class="hero-section flex-1 flex items-center justify-center p-4 md:p-8 w-full md:w-1/2">
        <div class="max-w-[250px] md:max-w-[380px] w-full flex flex-col items-center text-center">
            <!-- Wrapper div for animation and logo -->
            <div class="logo-animation-container">
                <!-- Radio container with dark background -->
                <div class="radio-container">
                    <!-- Radio signal rings -->
                    <div class="radio-ring"></div>
                    <div class="radio-ring"></div>
                    <div class="radio-ring"></div>
                    <div class="radio-ring"></div>
                    <div class="radio-ring"></div>

                    <!-- Logo image on top of animation -->
                    <img class="logo-img"
                        src="{{ asset('storage/image/logo_mcm.png') }}"
                        alt="MCM Media Network">
                </div>
            </div>
        </div>
    </div>

    <!-- Right Section with Login Form -->
    <div class="flex-1 flex flex-col justify-center p-4 md:p-8 w-full md:w-1/2 mx-auto login-form-container">
        <div class="max-w-md w-full mx-auto rounded-lg shadow-md p-6 md:p-8 backdrop-opacity-100 bg-white/70">
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
                        class="w-full p-3 border border-twitter rounded text-twitter-dark bg-white/70 focus:outline focus:outline-1 focus-outline-twitter"
                        placeholder="Email" required>
                </div>
                <div class="mb-6">
                    <input type="password" name="password"
                        class="w-full p-3 border border-twitter rounded text-twitter-dark bg-white/70 focus:outline focus:outline-1 focus-outline-twitter"
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
                    fontFamily: {
                        'sans': ['Montserrat', 'sans-serif'],
                    },
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
    </script>
</body>
</html>
