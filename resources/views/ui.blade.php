<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body x-data="{ sidebarOpen: true }" class="bg-[#f8f9fa] text-slate-800 antialiased h-screen flex overflow-hidden">

    <aside :class="sidebarOpen ? 'w-64' : 'w-20'" class="relative bg-white border-r border-slate-200 flex flex-col hidden md:flex z-20 transition-all duration-300" style="overflow: visible;">
        <!-- Logo Area -->
        <div class="h-20 flex items-center px-5 mb-4 mt-2 flex-shrink-0" :class="sidebarOpen ? '' : 'justify-center px-0'">
            <!-- Logo -->
            <div class="flex items-center" :class="sidebarOpen ? '' : 'justify-center'">
                <div class="w-9 h-9 bg-[#1e5bce] rounded-lg flex items-center justify-center text-white flex-shrink-0">
                    <i class="fa-solid fa-shield-halved text-lg"></i>
                </div>
                <div x-show="sidebarOpen" class="ml-3 overflow-hidden whitespace-nowrap" x-transition.opacity.duration.300ms>
                    <h1 class="text-[#1e3a8a] font-bold text-base leading-tight">Admin Panel</h1>
                    <p class="text-slate-400 text-xs">Bersama Kita Sukses</p>
                </div>
            </div>
        </div>

        <!-- Floating Arrow Toggle Button (centered on border line) -->
        <button
            @click="sidebarOpen = !sidebarOpen"
            class="absolute top-1/2 -right-3.5 -translate-y-1/2 z-30 w-7 h-7 bg-white border border-slate-200 rounded-full flex items-center justify-center text-slate-400 hover:text-[#1e5bce] hover:border-[#1e5bce] shadow-sm focus:outline-none transition-all duration-200"
        >
            <i class="fa-solid text-xs transition-transform duration-300" :class="sidebarOpen ? 'fa-chevron-left' : 'fa-chevron-right'"></i>
        </button>

        <!-- Navigation -->
        <nav class="flex-1 px-3 space-y-1" style="overflow: visible;">
            <!-- Active Item -->
            <div class="relative group/dash">
                <a href="#" class="flex items-center py-2.5 bg-[#e4e9f2] text-[#1e5bce] rounded-lg font-medium text-sm transition-all duration-300" :class="sidebarOpen ? 'px-3' : 'justify-center px-0'">
                    <i class="fa-solid fa-table-cells-large text-base w-5 text-center flex-shrink-0" :class="sidebarOpen ? 'mr-3' : 'mr-0'"></i>
                    <span x-show="sidebarOpen" class="whitespace-nowrap" x-transition.opacity.duration.300ms>Dashboard</span>
                </a>
                <!-- Tooltip -->
                <div x-show="!sidebarOpen"
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-3 z-50 pointer-events-none opacity-0 group-hover/dash:opacity-100 transition-opacity duration-200">
                    <div class="relative bg-slate-800 text-white text-xs font-medium px-3 py-1.5 rounded-md whitespace-nowrap">
                        <div class="absolute -left-1 top-1/2 -translate-y-1/2 w-2 h-2 bg-slate-800 rotate-45"></div>
                        Dashboard
                    </div>
                </div>
            </div>

            <!-- Inactive Item -->
            <div class="relative group/nasabah">
                <a href="#" class="flex items-center py-2.5 text-slate-500 hover:bg-slate-100 rounded-lg font-medium text-sm transition-all duration-300" :class="sidebarOpen ? 'px-3' : 'justify-center px-0'">
                    <i class="fa-solid fa-users text-base w-5 text-center flex-shrink-0" :class="sidebarOpen ? 'mr-3' : 'mr-0'"></i>
                    <span x-show="sidebarOpen" class="whitespace-nowrap" x-transition.opacity.duration.300ms>Data Nasabah</span>
                </a>
                <!-- Tooltip -->
                <div x-show="!sidebarOpen"
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-3 z-50 pointer-events-none opacity-0 group-hover/nasabah:opacity-100 transition-opacity duration-200">
                    <div class="relative bg-slate-800 text-white text-xs font-medium px-3 py-1.5 rounded-md whitespace-nowrap">
                        <div class="absolute -left-1 top-1/2 -translate-y-1/2 w-2 h-2 bg-slate-800 rotate-45"></div>
                        Data Nasabah
                    </div>
                </div>
            </div>
        </nav>

        <!-- Profile Section (Bottom) -->
        <div class="flex-shrink-0 border-t border-slate-100 p-3 relative" x-data="{ profileOpen: false }">

            <!-- Profile Popup (saat collapsed) -->
            <div x-show="profileOpen && !sidebarOpen"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-x-2"
                 x-transition:enter-end="opacity-100 translate-x-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-x-0"
                 x-transition:leave-end="opacity-0 -translate-x-2"
                 @click.away="profileOpen = false"
                 class="absolute bottom-2 left-full ml-3 bg-white border border-slate-200 rounded-xl shadow-lg p-3 w-52 z-50">
                <div class="flex items-center gap-3 pb-3 mb-2 border-b border-slate-100">
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Profile" class="w-9 h-9 rounded-full border-2 border-slate-200 object-cover flex-shrink-0">
                    <div>
                        <p class="text-sm font-semibold text-slate-700 leading-none mb-0.5">Administrator</p>
                        <p class="text-xs text-slate-400">Admin</p>
                    </div>
                </div>
                <button class="w-full flex items-center gap-2.5 px-3 py-2 text-sm font-medium text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                    <i class="fa-solid fa-arrow-right-from-bracket text-sm"></i>
                    Logout
                </button>
            </div>

            <div class="flex items-center rounded-lg transition-all duration-300" :class="sidebarOpen ? 'gap-3 px-2 py-2' : 'justify-center py-2'">
                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Profile"
                     class="w-9 h-9 rounded-full border-2 border-slate-200 object-cover flex-shrink-0 transition-all duration-200"
                     :class="!sidebarOpen ? 'cursor-pointer hover:ring-2 hover:ring-[#1e5bce] hover:ring-offset-1' : ''"
                     @click="if (!sidebarOpen) profileOpen = !profileOpen">
                <div x-show="sidebarOpen" class="overflow-hidden" x-transition.opacity.duration.300ms>
                    <p class="text-sm font-semibold text-slate-700 whitespace-nowrap leading-none mb-0.5">Administrator</p>
                    <p class="text-xs text-slate-400 whitespace-nowrap">Admin</p>
                </div>
                <button x-show="sidebarOpen" class="ml-auto text-slate-400 hover:text-red-500 focus:outline-none transition-colors flex-shrink-0" x-transition.opacity.duration.300ms>
                    <i class="fa-solid fa-arrow-right-from-bracket text-sm"></i>
                </button>
            </div>
        </div>
    </aside>

    <!-- Main Content wrapper -->
    <div class="flex-1 flex flex-col min-w-0 bg-[#f8f9fa]">
        
        <!-- Main Area -->
        <main class="flex-1 overflow-y-auto p-8 relative">
            <h2 class="text-[#0f172a] text-2xl font-bold mb-6">Dashboard</h2>

            <!-- Cards Row -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Card 1 -->
                <div class="bg-white rounded-xl border border-slate-200 p-6">
                    <div class="w-12 h-12 rounded-lg bg-[#dbeafe] text-[#1e40af] flex items-center justify-center mb-4">
                        <i class="fa-solid fa-user-group text-xl"></i>
                    </div>
                    <p class="text-sm font-semibold text-slate-500 mb-1">Total Nasabah</p>
                    <h3 class="text-3xl font-bold text-[#0f172a]">12,459</h3>
                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded-xl border border-slate-200 p-6">
                    <div class="w-12 h-12 rounded-lg bg-[#cffafe] text-[#0891b2] flex items-center justify-center mb-4">
                        <i class="fa-solid fa-bolt text-xl"></i>
                    </div>
                    <p class="text-sm font-semibold text-slate-500 mb-1">Active Users</p>
                    <h3 class="text-3xl font-bold text-[#0f172a]">8,922</h3>
                </div>

                <!-- Card 3 -->
                <div class="bg-white rounded-xl border border-slate-200 p-6">
                    <div class="w-12 h-12 rounded-lg bg-[#fee2e2] text-[#b91c1c] flex items-center justify-center mb-4">
                        <i class="fa-solid fa-clipboard-list text-xl"></i>
                    </div>
                    <p class="text-sm font-semibold text-slate-500 mb-1">New Requests</p>
                    <h3 class="text-3xl font-bold text-[#0f172a]">142</h3>
                </div>
            </div>

            <!-- Main Chart Card (Placeholder) -->
            <div class="bg-white rounded-xl border border-slate-200">
                <!-- Card Header -->
                <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between">
                    <div>
                        <h3 class="text-xl font-bold text-[#0f172a] mb-1">Data Trends Analysis</h3>
                        <p class="text-sm text-slate-500 font-medium">Monitoring transaction volume and user engagement over the last 30 days.</p>
                    </div>
                    <div class="mt-4 sm:mt-0 flex space-x-3">
                        <button class="px-4 py-2 border border-slate-300 rounded-lg text-sm font-semibold text-slate-600 hover:bg-slate-50 transition-colors">
                            Last 7 Days
                        </button>
                        <button class="px-4 py-2 bg-[#004aad] text-white rounded-lg text-sm font-semibold hover:bg-blue-800 transition-colors">
                            Export Report
                        </button>
                    </div>
                </div>
                <!-- Card Body (Empty space for chart) -->
                <div class="p-6 h-80 flex items-center justify-center relative">
                    <!-- Chart line placeholder just for visual resemblance -->
                    <div class="absolute inset-0 p-6 pointer-events-none opacity-20">
                        <svg class="w-full h-full" preserveAspectRatio="none" viewBox="0 0 100 100">
                            <path d="M0,80 L10,70 L20,75 L40,50 L50,55 L70,30 L85,40 L100,20" fill="none" stroke="#004aad" stroke-width="2" vector-effect="non-scaling-stroke"></path>
                        </svg>
                    </div>
                </div>
            </div>

        </main>
        
        <!-- Footer -->
        <footer class="border-t border-slate-200 py-4 px-8 bg-[#f8f9fa] mt-auto">
            <p class="text-xs font-semibold text-slate-500">&copy; 2024 Admin Panel v2.4.1</p>
        </footer>
    </div>

</body>
</html>
