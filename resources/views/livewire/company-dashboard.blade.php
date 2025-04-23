@extends('layouts.app')

@section('content')  {{-- Tambahkan ini --}}
@php
$user = auth()->user();
@endphp

<div class="container mx-auto p-4 bg-slate-950 min-h-screen">

<!-- Header Section -->
<div class="backdrop-blur-lg bg-gradient-to-r from-gray-600/0 to-gray-500 rounded-xl shadow-md p-4 mb-6 sticky top-1 z-50">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 sm:gap-6 w-full">

        <!-- User Info and Logout -->
        <div class="flex items-center gap-6">
            <!-- User Info -->
            <div class="flex items-center gap-4">
                @if($user->company_logo)
                    <img src="{{ asset('storage/' . $user->company_logo) }}"
                         alt="Logo"
                         class="h-12 w-12 rounded-full object-cover border-2 border-blue-100 shadow-sm" />
                @else
                    <div class="h-12 w-12 rounded-full bg-gradient-to-r from-blue-500 to-blue-700 text-indigo-300 flex items-center justify-center text-xl font-bold shadow-sm">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                @endif

                <div class="flex flex-col justify-center">
                    <div class="font-semibold text-lg text-white leading-tight">
                        Welcome, {{ $user->name }}
                    </div>
                </div>
            </div>

            <!-- Logout Button with Icon -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-md shadow-sm transition">
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
        </div>

        <!-- Company Info -->
        <div class="flex items-center bg-slate-800 px-4 py-2 rounded-lg">
            <img src="{{ asset('storage/image/logo_mcm.png') }}"
                 alt="MCM Media Network"
                 class="h-12 w-12 rounded-full object-cover border-2 border-blue-100 shadow-sm" />
            <span class="ml-4 text-sm font-semibold text-white">MCM Media Network</span>
        </div>

    </div>
</div>


<!-- Main Content Area -->
<div class="flex flex-col lg:flex-row gap-6">

    <!-- Left Column -->
    <div class="w-full space-y-6">

        <!-- Filters -->
        <div class="w-full">
            @livewire('media-filter')
        </div>

        <!-- Stats Cards -->
        <div class="w-full">
            @livewire('media-overview')
        </div>

        <!-- Chart Section -->
        @livewire('chart-performance')

        @livewire('impression-stats')
        @livewire('ad-display')

    </div>

</div>

</div>
@endsection
