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

        .logo-animation-container {
            position: relative;
            width: 100%;
            aspect-ratio: 1/1;
            z-index: 1;
            max-height: 300px;
            margin: 0 auto;
        }

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
            box-shadow: 0 0 15px rgba(62, 23, 204, 0.4);
        }

        .radio-ring {
            position: absolute;
            border-radius: 50%;
            border: 4px solid #3e17cc;
            opacity: 0;
            animation: radioPulse 2s infinite ease-out;
            z-index: 0;
            box-shadow: 0 0 10px rgba(62, 23, 204, 0.5);
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
                opacity: 1;
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
            filter: drop-shadow(0 0 8px rgba(255, 255, 255, 0.6));
        }

        .login-form-container {
            position: relative;
            z-index: 10;
        }

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

        .form-input-container {
        position: relative;
        margin-bottom: 1.5rem;
        }

        .form-input {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid #CFD9DE;
        border-radius: 0.5rem;
        background-color: rgba(255, 255, 255, 0.8);
        transition: all 0.3s ease;
        z-index: 1;
        }

        .form-input:focus {
        border-color: #3e17cc;
        box-shadow: 0 0 0 3px rgba(62, 23, 204, 0.2);
        background-color: white;
        }

        .form-label {
        position: absolute;
        left: 1rem;
        top: 0.75rem;
        color: #536471;
        pointer-events: none;
        transition: all 0.2s ease;
        z-index: 0;
        background-color: transparent;
        padding: 0 4px;
        }

        .form-input:focus + .form-label,
        .form-input:not(:placeholder-shown) + .form-label {
        transform: translateY(-1.4rem) scale(0.85);
        color: #3e17cc;
        font-weight: 500;
        z-index: 2;
        background-color: rgb(255, 255, 255);
        border-radius: 5px;
        }

        .form-input::placeholder {
        color: transparent;
        opacity: 0;
        }

        .login-btn {
          background: linear-gradient(135deg, #3e17cc, #4c6ef5);
          transition: all 0.3s ease;
          position: relative;
          overflow: hidden;
        }

        .login-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(62, 23, 204, 0.4);
        }

        .login-btn:active {
        transform: translateY(0);
        }
    </style>
</head>
<body class="font-[Montserrat] flex flex-col md:flex-row min-h-screen overflow-x-hidden bg-gradient-to-br from-slate-950 to-slate-800">
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
        <div class="max-w-md w-full mx-auto rounded-2xl p-6 md:p-8 ">
            <h2 class="text-2xl md:text-3xl font-semibold mb-2 text-white text-center md:text-left sm:text-left">MCM Portal</h2>
            <h4 class="text-lg md:text-xl font-medium mb-8 text-white text-center md:text-left sm:text-left">login to your account</h4>

            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            @if($errors->has('email'))
                                <p class="text-sm text-red-600">
                                    @if($errors->first('email') == 'The email field is required.')
                                        Email is required
                                    @elseif($errors->first('email') == 'The email must be a valid email address.')
                                        Please enter a valid email address
                                    @elseif($errors->first('email') == 'These credentials do not match our records.')
                                        Invalid email or password
                                    @else
                                        {{ $errors->first('email') }}
                                    @endif
                                </p>
                            @elseif($errors->has('password'))
                                <p class="text-sm text-red-600">
                                    @if($errors->first('password') == 'The password field is required.')
                                        Password is required
                                    @elseif($errors->first('password') == 'The password must be at least 8 characters.')
                                        Password must be at least 8 characters
                                    @elseif($errors->first('password') == 'These credentials do not match our records.')
                                        Invalid email or password
                                    @else
                                        {{ $errors->first('password') }}
                                    @endif
                                </p>
                            @else
                                <p class="text-sm text-red-600">{{ $errors->first() }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-input-container">
                    <input type="email" name="email" value="{{ old('email') }}" class="form-input" id="email" placeholder="Email" required>
                    <label for="email" class="form-label">Email</label>
                </div>

                <div class="form-input-container">
                    <input type="password" name="password" class="form-input" id="password" placeholder="Password" required>
                    <label for="password" class="form-label">Password</label>
                </div>

                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <label for="remember" class="ml-2 block text-sm text-white">Remember me</label>
                    </div>
                    <div class="text-sm">
                        <a href="#" class="text-indigo-400 hover:text-indigo-800 font-medium">Forgot password?</a>
                    </div>
                </div>

                <button type="submit" class="login-btn w-full py-3 px-4 rounded-xl font-bold text-white mb-4 transition duration-300 ease-in-out">
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
