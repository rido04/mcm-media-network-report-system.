<!DOCTYPE html>
<html class="scroll-smooth" lang="en">
<head>
    <meta charset="UTF-8">
    <title>MCM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @livewireStyles
    @stack('styles')
    <style>
        html {
            scroll-behavior: smooth;
        }

        /* Style untuk menu aktif */
        .nav-link.active {
            border-bottom: 2px solid #3b82f6;
        }

        /* Mobile dropdown style */
        .mobile-dropdown {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .mobile-dropdown.open {
            max-height: 400px; /* Adjust based on your content */
        }
    </style>
</head>
<body class="bg-slate-950 text-gray-800">
@php
    $user = auth()->user();
@endphp

<div class="bg-slate-950 min-h-screen transition-all duration-1000 ease-out transform opacity-0 translate-y-4"
    x-data="{
        shown: false,
        dropdownOpen: false,
        activeMenu: 'dashboard',
        init() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    this.shown = entry.isIntersecting;
                    if (entry.isIntersecting) observer.unobserve(this.$el);
                });
            });
            observer.observe(this.$el);
        },
        toggleDropdown() {
            this.dropdownOpen = !this.dropdownOpen;
        },
        setActiveMenu(menu) {
            this.activeMenu = menu;
            this.dropdownOpen = false;
        }
    }"
    x-bind:class="{
        'opacity-100 translate-y-0': shown,
        'opacity-0 translate-y-4': !shown
    }">

    <!-- Header/Navbar -->
    <header class="backdrop-blur-lg bg-gradient-to-r from-slate-700/50 to-slate-600/50 shadow-md p-4 sm:p-6 mb-6 sticky top-0 z-50">
        <div class="flex justify-between items-center">
            <!-- Left section with logo and user info -->
            <div class="flex items-center gap-4">
                <!-- Mobile dropdown toggle -->
                <button @click="toggleDropdown" class="lg:hidden text-white flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>

                <!-- Logo -->
                <a href="#" class="flex items-center">
                    <img src="{{ asset('storage/image/logo_mcm.png') }}"
                        alt="MCM Media Network"
                        class="h-10 w-10 rounded-full object-cover border-2 border-blue-100" />
                    <span class="ml-2 text-white text-sm sm:text-base font-semibold hidden sm:inline">MCM Media Network</span>
                </a>

                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex items-center ml-8 space-x-6">
                    <a href="#"
                        @click="setActiveMenu('dashboard')"
                        :class="{'active': activeMenu === 'dashboard'}"
                        class="nav-link text-white hover:text-blue-300 transition-colors duration-200 px-1 py-1">
                        Dashboard
                    </a>
                    <a href="{{ route('profile') }}"
                        class="nav-link text-white hover:text-blue-300 transition-colors duration-200 px-1 py-1">
                        Profile
                    </a>
                </nav>
            </div>

            <!-- Right section with user profile and logout -->
            <div class="flex items-center gap-4">
                <!-- User Info -->
                <div class="flex items-center gap-3">
                    @if($user->company_logo)
                        <img src="{{ asset('storage/' . $user->company_logo) }}"
                            alt="Logo"
                            class="h-10 w-10 sm:h-10 sm:w-10 rounded-full object-cover border-2 border-blue-100 shadow-sm" />
                    @else
                        <div class="h-8 w-8 sm:h-10 sm:w-10 rounded-full bg-gradient-to-r from-blue-500 to-blue-700 text-white flex items-center justify-center text-sm sm:text-lg font-bold shadow-sm">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif
                    <div class="flex flex-col justify-center sm:block">
                        <div class="font-semibold text-sm text-white leading-tight whitespace-nowrap">
                            {{ $user->name }}
                        </div>
                    </div>
                </div>

                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}" class="hidden sm:block">
                    @csrf
                    <button type="submit"
                            class="border inline-flex items-center justify-center gap-2 px-3 py-1.5 text-xs font-medium text-white hover:bg-red-700/80 rounded-md shadow-sm transition border-red-600 bg-red-700/40">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3-3H9m0 0l3-3m-3 3l3 3" />
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Mobile Dropdown Menu -->
        <div
            class="mobile-dropdown w-full lg:hidden overflow-hidden mt-2 bg-slate-800/90 rounded-lg shadow-lg"
            :class="{'open': dropdownOpen}"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform -translate-y-4"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform -translate-y-4">

            <div class="p-4">
                <!-- User Profile in Dropdown -->
                <div class="flex items-center gap-3 mb-4 pb-3 border-b border-slate-700">
                    @if($user->company_logo)
                        <img src="{{ asset('storage/' . $user->company_logo) }}"
                            alt="Logo"
                            class="h-10 w-10 rounded-full object-cover border-2 border-blue-100 shadow-sm" />
                    @else
                        <div class="h-10 w-10 rounded-full bg-gradient-to-r from-blue-500 to-blue-700 text-white flex items-center justify-center text-lg font-bold shadow-sm">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif
                    <div class="flex flex-col">
                        <div class="font-semibold text-white">{{ $user->name }}</div>
                        @if($user->email)
                            <div class="text-xs text-slate-300 truncate max-w-full">{{ $user->email }}</div>
                        @endif
                    </div>
                </div>

                <!-- Mobile Menu Items -->
                <nav class="flex flex-col space-y-1">
                    <a href="#"
                       @click="setActiveMenu('dashboard')"
                       :class="{'bg-blue-900/30 border-l-2 border-blue-400': activeMenu === 'dashboard'}"
                       class="px-3 py-2 rounded-md text-white hover:bg-slate-700/50 flex items-center space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                        </svg>
                        <span>Dashboard</span>
                    </a>
                    <a href="{{ route('profile') }}"
                       class="px-3 py-2 rounded-md text-white hover:bg-slate-700/50 flex items-center space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>Profile</span>
                    </a>

                    <!-- Logout Button -->
                    <form method="POST" action="{{ route('logout') }}" class="mt-4">
                        @csrf
                        <button type="submit"
                                class="w-full bg-red-700/30 hover:bg-red-700/50 text-white py-2 px-4 rounded-md flex items-center justify-center gap-2 transition duration-300 border border-red-600/30">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3-3H9m0 0l3-3m-3 3l3 3" />
                            </svg>
                            Logout
                        </button>
                    </form>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="p-2 sm:p-4 space-y-6">
        <div id="media-filter">
            @livewire('media-filter')
        </div>

        <div id="media-overview">
            @livewire('media-overview')
        </div>

        <div id="performance">
            @livewire('chart-performance')
        </div>

        <div id="impressions">
            @livewire('impression-stats')
        </div>

        <div id="ads">
            @livewire('ad-display')
        </div>

        <div id="stats">
            @livewire('commuterline-user-chart')

            <div class="flex flex-col sm:flex-row gap-4 mt-6">
                <div class="w-full sm:w-1/2">
                    @livewire('transjakarta')
                </div>
                <div class="w-full sm:w-1/2">
                    @livewire('road-traffic')
                </div>
            </div>

            @livewire('total-performance')
            @livewire('tabs-sum')
        </div>

    </main>
    <div class="mt-8">
        @livewire('footer')
    </div>
</div>

@livewireScripts
<script type="module" src="{{ mix('../resources/js/app.js') }}"></script>
@stack('scripts')
</body>
</html>
