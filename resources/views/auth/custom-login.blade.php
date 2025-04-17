<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - MCM Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('storage/image/logo_mcm.png') }}" type="image/png">
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
    </style>
</head>
<body class="font-sans flex flex-col md:flex-row min-h-screen overflow-x-hidden bg-gradient-to-r from-gray-600 to-blue-400">
    <!-- Left Section with Hero Content -->
    <div class="flex-1 flex items-center justify-center p-4 md:p-8 min-h-[40vh] md:min-h-screen w-full md:w-1/2">
        <div class="max-w-[280px] md:max-w-[380px] w-full flex flex-col items-center text-center">
            <img class="w-full max-w-[180px] md:max-w-[350px] h-auto mb-8 object-contain mx-auto"
                src="{{ asset('storage/image/logo_mcm.png') }}"
                alt="MCM Media Network">
        </div>
    </div>

    <!-- Right Section with Login Form -->
    <div class="flex-1 flex flex-col justify-center p-4 md:p-8 w-full md:w-1/2 mx-auto">
        <div class="max-w-md w-full mx-auto rounded-lg shadow-md p-6 md:p-8 backdrop-blur-lg bg-white/70">
            <h2 class="text-2xl md:text-3xl font-bold mb-4 text-twitter-dark">MCM Media Network</h2>
            <h4 class="text-lg md:text-xl font-bold mb-6 text-twitter-dark">Login to your account</h4>

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
    </script>
</body>
</html>
