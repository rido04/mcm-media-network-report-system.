@extends('layouts.app')

@section('content')
@php
    $user = auth()->user();
@endphp

<div class="bg-slate-950 min-h-screen p-4 sm:p-6 transition-all duration-1000 ease-out transform opacity-0 translate-y-4"
    x-data="{
        shown: false,
        init() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    this.shown = entry.isIntersecting;
                    if (entry.isIntersecting) observer.unobserve(this.$el);
                });
            });
            observer.observe(this.$el);
        }
    }"
    x-bind:class="{
        'opacity-100 translate-y-0': shown,
        'opacity-0 translate-y-4': !shown
    }">

    <!-- Header -->
    <header class="backdrop-blur-lg bg-gradient-to-r from-slate-700/30 to-slate-600/20 rounded-xl shadow-md p-4 sm:p-6 mb-6 sticky -top-32 sm:-top-28 z-50">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6 w-full">
            <div class="flex flex-col xs:flex-row items-start xs:items-center gap-3 sm:gap-6 w-full sm:w-auto">

                <!-- User Info -->
                <div class="flex items-center gap-3">
                    @if($user->company_logo)
                        <img src="{{ asset('storage/' . $user->company_logo) }}"
                            alt="Logo"
                            class="h-10 w-10 sm:h-12 sm:w-12 rounded-full object-cover border-2 border-blue-100 shadow-sm" />
                    @else
                        <div class="h-10 w-10 sm:h-12 sm:w-12 rounded-full bg-gradient-to-r from-blue-500 to-blue-700 text-white flex items-center justify-center text-lg sm:text-xl font-bold shadow-sm">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif
                    <div class="flex flex-col justify-center">
                        <div class="font-semibold text-sm sm:text-lg text-white leading-tight whitespace-nowrap">
                            Welcome, {{ $user->name }}
                        </div>
                        <div class="text-xs text-gray-300 hidden sm:block">
                            {{ $user->email }}
                        </div>
                    </div>
                </div>

                <!-- Logout Button with Icon -->
                <form method="POST" action="{{ route('logout') }}" class="w-full xs:w-auto">
                    @csrf
                    <button type="submit"
                            class="w-full mt-4 xs:w-auto border-2 inline-flex items-center justify-center gap-2 px-3 py-1.5 sm:px-4 sm:py-2 text-xs sm:text-sm font-medium text-white hover:bg-red-700/80 rounded-md shadow-sm transition border-red-600 bg-red-700/40">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-4 h-4 sm:w-5 sm:h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3-3H9m0 0l3-3m-3 3l3 3" />
                        </svg>
                        Logout
                    </button>
                </form>
            </div>

            <!-- Company Info -->
            <a href="https://www.mcmmedianetworks.com/" target="_blank" class="flex items-center bg-slate-800 px-4 py-2 rounded-lg shadow-sm w-full sm:w-auto hover:bg-gradient-to-br from-gray-800 via-gray-700 to-gray-800 transition">
                <img src="{{ asset('storage/image/logo_mcm.png') }}"
                    alt="MCM Media Network"
                    class="h-10 w-10 rounded-full object-cover border-2 border-blue-100" />
                <span class="ml-4 text-white text-sm sm:text-base font-semibold">MCM Media Network</span>
            </a>
        </div>
    </header>

    <!-- Content Area -->
    <main class="flex flex-col lg:flex-row gap-6">
        <div class="w-full space-y-6">
            @livewire('media-filter')
            @livewire('media-overview')
            @livewire('chart-performance')
            @livewire('impression-stats')
            @livewire('ad-display')
            @livewire('commuterline-user-chart')
            <div class="flex flex-col sm:flex-row gap-4">
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
        <div class="mx-[-1rem] sm:mx-[-1.5rem] -mb-4 sm:-mb-6 mt-6">
            @livewire('footer')
        </div>
</div>
@endsection
