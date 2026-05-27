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
