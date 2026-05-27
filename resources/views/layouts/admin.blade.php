<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body x-data="{ sidebarOpen: true }" class="bg-[#f8f9fa] text-slate-800 antialiased h-screen flex overflow-hidden">

    {{-- Sidebar --}}
    <x-admin.sidebar :role="$role ?? 'admin'" />

    {{-- Main Content Wrapper --}}
    <div class="flex-1 flex flex-col min-w-0 bg-[#f8f9fa]">

        {{-- Top Header Bar --}}
        <header class="h-16 bg-white border-b border-slate-200 flex items-center px-6 gap-4 flex-shrink-0">
            {{-- Mobile hamburger --}}
            <button @click="sidebarOpen = !sidebarOpen"
                    class="md:hidden text-slate-500 hover:text-primary focus:outline-none transition-colors">
                <i class="fa-solid fa-bars text-xl"></i>
            </button>

            {{-- Page Title --}}
            <div class="flex-1">
                @isset($header)
                    {{ $header }}
                @else
                    <h2 class="text-lg font-bold text-[#0f172a]">{{ $pageTitle ?? 'Dashboard' }}</h2>
                @endisset
            </div>

            {{-- Right side: Notification + Profile --}}
            <div class="flex items-center gap-3">
                {{-- Notification Bell --}}
                <button class="relative w-9 h-9 flex items-center justify-center text-slate-500 hover:text-primary hover:bg-slate-100 rounded-lg transition-colors">
                    <i class="fa-solid fa-bell text-base"></i>
                    <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full border-2 border-white"></span>
                </button>

                {{-- Profile Pill --}}
                <div class="flex items-center gap-2 pl-3 border-l border-slate-200">
                    <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-white font-bold text-xs">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="hidden sm:block">
                        <p class="text-sm font-semibold text-slate-700 leading-none">{{ auth()->user()->name ?? 'User' }}</p>
                        <p class="text-xs text-slate-400 capitalize">{{ $role ?? 'admin' }}</p>
                    </div>
                </div>
            </div>
        </header>

        {{-- Page Content --}}
        <main class="flex-1 overflow-y-auto p-6 md:p-8 relative">
            {{ $slot }}
        </main>

        {{-- Footer --}}
        <footer class="border-t border-slate-200 py-3 px-8 bg-[#f8f9fa]">
            <p class="text-xs font-semibold text-slate-400">&copy; {{ date('Y') }} {{ config('app.name', 'BKS') }} &mdash; All rights reserved.</p>
        </footer>

    </div>

</body>
</html>
