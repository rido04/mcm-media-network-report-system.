<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="{{ asset('css/tailwind.css') }}" rel="stylesheet">
    <style>
        /* Container glow animation */
        .form-container {
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .form-container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: conic-gradient(
                from 0deg,
                transparent 0%,
                rgba(30, 58, 138, 0.2) 30%,
                rgba(59, 130, 246, 0.4) 70%,
                transparent 100%
            );
            animation: rotate-glow 12s linear infinite;
            z-index: -1;
            opacity: 0.5; /* Tetap terlihat */
            transition: opacity 0.5s ease;
        }

        @keyframes rotate-glow {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        /* Subtle border pulse */
        .form-container::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border: 1px solid transparent;
            border-radius: 0.5rem;
            background: linear-gradient(90deg, rgba(30, 58, 138, 0.2), rgba(59, 130, 246, 0.2)) border-box;
            -webkit-mask: linear-gradient(#fff 0 0) padding-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: destination-out;
            mask-composite: exclude;
            animation: border-pulse 8s infinite alternate;
            pointer-events: none;
            opacity: 0.5; /* Tetap terlihat */
        }

        @keyframes border-pulse {
            0% {
                opacity: 0.3;
            }
            100% {
                opacity: 0.7;
            }
        }

        /* Responsive adjustments */
        /* @media (max-width: 768px) {
            .form-container::before,
            .form-container::after {
                display: none;
            }
        } */

        /* Button loading animation */
        .btn-loading::after {
            content: "";
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            width: 16px;
            height: 16px;
            animation: spin 1s linear infinite;
            margin-left: 8px;
            display: inline-block;
            vertical-align: middle;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="bg-gray-900 flex items-center justify-center min-h-screen p-4">
    <div class="form-container bg-gray-800 p-8 rounded-lg shadow-xl w-full max-w-md relative">
        <!-- Close glow on mobile -->
        <div class="md:hidden absolute inset-0 rounded-lg border border-gray-700 pointer-events-none"></div>

        <!-- Logo/Header -->
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-white">MCM Media Networks</h1>
            <p class="text-gray-400 mt-2">Login</p>
        </div>

        <!-- Form Login -->
        <form method="POST" action="/login" class="space-y-6" id="loginForm">
            @csrf

            @if ($errors->any())
                <div class="bg-red-900/50 text-red-200 p-3 rounded text-sm border border-red-700">
                    {{ $errors->first() }}
                </div>
            @endif

            <div>
                <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                <input type="email" id="email" name="email" placeholder="Masukkan email Terdaftar" required
                    class="w-full bg-gray-700 text-white px-4 py-3 rounded-lg border border-gray-600 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition duration-200">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Password</label>
                <div class="relative">
                    <input type="password" id="password" name="password" placeholder="••••••••" required
                        class="w-full bg-gray-700 text-white px-4 py-3 rounded-lg border border-gray-600 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition duration-200">
                    <button type="button" onclick="togglePassword()" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-blue-400 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox"
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-600 rounded bg-gray-700">
                    <label for="remember" class="ml-2 block text-sm text-gray-300">
                        Remember me
                    </label>
                </div>
                <div class="text-sm">
                    <a href="#" class="font-medium text-blue-400 hover:text-blue-300 transition">
                        Forgot password?
                    </a>
                </div>
            </div>

            <button type="submit" id="submitBtn"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition duration-200 flex justify-center items-center">
                <span id="btnText">Sign in</span>
            </button>
        </form>
    </div>

    <script>
        // Toggle password visibility
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
        }

        // Form submission loading state
        document.getElementById('loginForm').addEventListener('submit', function() {
            const btn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');

            btn.disabled = true;
            btnText.innerHTML = 'Authenticating <span class="btn-loading"></span>';
        });

        // Auto-focus email field on page load
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('email').focus();
        });
    </script>
</body>
</html>
