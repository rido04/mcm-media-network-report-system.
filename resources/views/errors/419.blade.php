<!DOCTYPE html>
<html>
<head>
    <title>419 Session Expired</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('storage/image/logo_mcm.png') }}">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'timeout': 'timeout 2s ease-out infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        timeout: {
                            '0%, 100%': { opacity: '0.7' },
                            '50%': { opacity: '1' },
                        },
                    },
                },
            },
        };
    </script>
</head>
<body class="bg-gray-900 text-gray-100">
    <!-- Film reel background -->
    <div class="absolute inset-0 -z-10 opacity-10 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMDAiIGhlaWdodD0iMTAwIiB2aWV3Qm94PSIwIDAgMTAwIDEwMCI+PHBhdGggZD0iTTAgMGgyMHYxMDBIMHoiIGZpbGw9IiNGRkYiIG9wYWNpdHk9IjAuMSIvPjxwYXRoIGQ9Ik00MCAwaDIwdjEwMEg0MHoiIGZpbGw9IiNGRkYiIG9wYWNpdHk9IjAuMSIvPjxwYXRoIGQ9Ik04MCAwaDIwdjEwMEg4MHoiIGZpbGw9IiNGRkYiIG9wYWNpdHk9IjAuMSIvPjwvc3ZnPg==')]"></div>

    <!-- Main content -->
    <div class="flex flex-col items-center justify-center min-h-screen px-4 text-center">
        <div class="w-full max-w-md mx-auto space-y-6 animate-fade-in">
            <!-- Expired film canister graphic -->
            <div class="relative mx-auto w-fit mb-8">
                <div class="w-48 h-48 bg-gray-700 rounded-full border-4 border-red-500 flex items-center justify-center">
                    <div class="w-40 h-40 rounded-full bg-gray-800 flex items-center justify-center">
                        <span class="text-6xl font-bold text-red-500 animate-timeout">419</span>
                    </div>
                </div>
                <div class="absolute -bottom-4 left-1/2 -translate-x-1/2 w-24 h-8 bg-gray-600 rounded-full"></div>
            </div>

            <h1 class="text-3xl md:text-4xl font-bold text-red-500">SESSION EXPIRED</h1>

            <p class="text-lg md:text-xl text-gray-300">
                Your session has timed out
            </p>

            <!-- Camera button -->
            <div class="pt-8 flex flex-col items-center">
                <a href="{{ url('/login') }}" class="relative group">
                    <div class="w-16 h-16 rounded-full bg-red-600 flex items-center justify-center shadow-lg transition-all duration-300 group-hover:bg-red-700 group-hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <span class="block mt-2 text-sm text-gray-400 group-hover:text-white">REFRESH SESSION</span>
                </a>
            </div>

            <!-- Security indicator -->
            <div class="pt-12 flex justify-center items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                <span class="text-xs text-gray-500">MCM MEDIA NETWORK</span>
            </div>
        </div>
    </div>
</body>
</html>
