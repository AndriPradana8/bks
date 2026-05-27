{{--
    Sidebar Component
    Props:
    - $role : 'admin' | 'superadmin'
--}}
@props(['role' => 'admin'])

<aside :class="sidebarOpen ? 'w-64' : 'w-20'"
       class="relative bg-white border-r border-slate-200 flex flex-col hidden md:flex z-20 transition-all duration-300"
       style="overflow: visible;">

    {{-- Logo Area --}}
    <div class="h-20 flex items-center px-5 mb-4 mt-2 flex-shrink-0"
         :class="sidebarOpen ? '' : 'justify-center px-0'">
        <div class="flex items-center" :class="sidebarOpen ? '' : 'justify-center'">
            <div class="w-9 h-9 bg-[#1e5bce] rounded-lg flex items-center justify-center text-white flex-shrink-0">
                <i class="fa-solid fa-shield-halved text-lg"></i>
            </div>
            <div x-show="sidebarOpen" class="ml-3 overflow-hidden whitespace-nowrap" x-transition.opacity.duration.300ms>
                <h1 class="text-[#1e3a8a] font-bold text-base leading-tight">
                    @if($role === 'superadmin') Super Admin @else Admin Panel @endif
                </h1>
                <p class="text-slate-400 text-xs">Bersama Kita Sukses</p>
            </div>
        </div>
    </div>

    {{-- Floating Arrow Toggle Button --}}
    <button @click="sidebarOpen = !sidebarOpen"
            class="absolute top-1/2 -right-3.5 -translate-y-1/2 z-30 w-7 h-7 bg-white border border-slate-200 rounded-full flex items-center justify-center text-slate-400 hover:text-[#1e5bce] hover:border-[#1e5bce] shadow-sm focus:outline-none transition-all duration-200">
        <i class="fa-solid text-xs transition-transform duration-300"
           :class="sidebarOpen ? 'fa-chevron-left' : 'fa-chevron-right'"></i>
    </button>

    {{-- Navigation --}}
    <nav class="flex-1 px-3 space-y-1" style="overflow: visible;">

        {{-- Label --}}
        <div x-show="sidebarOpen" class="px-3 pt-1 pb-2" x-transition.opacity.duration.300ms>
            <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Menu Utama</p>
        </div>

        {{-- Dashboard --}}
        @php
            $dashboardRoute = $role === 'superadmin' ? 'superadmin.dashboard' : 'admin.dashboard';
            $isDashboard = request()->routeIs($dashboardRoute);
        @endphp
        <div class="relative group/dash">
            <a href="{{ route($dashboardRoute) }}"
               class="flex items-center py-2.5 rounded-lg font-medium text-sm transition-all duration-300
                      {{ $isDashboard ? 'bg-[#e4e9f2] text-[#1e5bce]' : 'text-slate-500 hover:bg-slate-100' }}"
               :class="sidebarOpen ? 'px-3' : 'justify-center px-0'">
                <i class="fa-solid fa-table-cells-large text-base w-5 text-center flex-shrink-0"
                   :class="sidebarOpen ? 'mr-3' : 'mr-0'"></i>
                <span x-show="sidebarOpen" class="whitespace-nowrap" x-transition.opacity.duration.300ms>Dashboard</span>
            </a>
            <div x-show="!sidebarOpen"
                 class="absolute left-full top-1/2 -translate-y-1/2 ml-3 z-50 pointer-events-none opacity-0 group-hover/dash:opacity-100 transition-opacity duration-200">
                <div class="relative bg-slate-800 text-white text-xs font-medium px-3 py-1.5 rounded-md whitespace-nowrap">
                    <div class="absolute -left-1 top-1/2 -translate-y-1/2 w-2 h-2 bg-slate-800 rotate-45"></div>
                    Dashboard
                </div>
            </div>
        </div>

        {{-- Data Nasabah --}}
        @php $isNasabah = request()->routeIs('*.nasabah*'); @endphp
        <div class="relative group/nasabah">
            <a href="#"
               class="flex items-center py-2.5 rounded-lg font-medium text-sm transition-all duration-300
                      {{ $isNasabah ? 'bg-[#e4e9f2] text-[#1e5bce]' : 'text-slate-500 hover:bg-slate-100' }}"
               :class="sidebarOpen ? 'px-3' : 'justify-center px-0'">
                <i class="fa-solid fa-users text-base w-5 text-center flex-shrink-0"
                   :class="sidebarOpen ? 'mr-3' : 'mr-0'"></i>
                <span x-show="sidebarOpen" class="whitespace-nowrap" x-transition.opacity.duration.300ms>Data Nasabah</span>
            </a>
            <div x-show="!sidebarOpen"
                 class="absolute left-full top-1/2 -translate-y-1/2 ml-3 z-50 pointer-events-none opacity-0 group-hover/nasabah:opacity-100 transition-opacity duration-200">
                <div class="relative bg-slate-800 text-white text-xs font-medium px-3 py-1.5 rounded-md whitespace-nowrap">
                    <div class="absolute -left-1 top-1/2 -translate-y-1/2 w-2 h-2 bg-slate-800 rotate-45"></div>
                    Data Nasabah
                </div>
            </div>
        </div>

        {{-- Menu khusus Superadmin --}}
        @if($role === 'superadmin')
            <div x-show="sidebarOpen" class="px-3 pt-4 pb-2" x-transition.opacity.duration.300ms>
                <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Manajemen</p>
            </div>

            {{-- Kelola Admin --}}
            @php $isAdmins = request()->routeIs('superadmin.admins*'); @endphp
            <div class="relative group/admins">
                <a href="#"
                   class="flex items-center py-2.5 rounded-lg font-medium text-sm transition-all duration-300
                          {{ $isAdmins ? 'bg-[#e4e9f2] text-[#1e5bce]' : 'text-slate-500 hover:bg-slate-100' }}"
                   :class="sidebarOpen ? 'px-3' : 'justify-center px-0'">
                    <i class="fa-solid fa-user-tie text-base w-5 text-center flex-shrink-0"
                       :class="sidebarOpen ? 'mr-3' : 'mr-0'"></i>
                    <span x-show="sidebarOpen" class="whitespace-nowrap" x-transition.opacity.duration.300ms>Kelola Admin</span>
                </a>
                <div x-show="!sidebarOpen"
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-3 z-50 pointer-events-none opacity-0 group-hover/admins:opacity-100 transition-opacity duration-200">
                    <div class="relative bg-slate-800 text-white text-xs font-medium px-3 py-1.5 rounded-md whitespace-nowrap">
                        <div class="absolute -left-1 top-1/2 -translate-y-1/2 w-2 h-2 bg-slate-800 rotate-45"></div>
                        Kelola Admin
                    </div>
                </div>
            </div>

            {{-- Laporan --}}
            @php $isLaporan = request()->routeIs('superadmin.laporan*'); @endphp
            <div class="relative group/laporan">
                <a href="#"
                   class="flex items-center py-2.5 rounded-lg font-medium text-sm transition-all duration-300
                          {{ $isLaporan ? 'bg-[#e4e9f2] text-[#1e5bce]' : 'text-slate-500 hover:bg-slate-100' }}"
                   :class="sidebarOpen ? 'px-3' : 'justify-center px-0'">
                    <i class="fa-solid fa-chart-bar text-base w-5 text-center flex-shrink-0"
                       :class="sidebarOpen ? 'mr-3' : 'mr-0'"></i>
                    <span x-show="sidebarOpen" class="whitespace-nowrap" x-transition.opacity.duration.300ms>Laporan</span>
                </a>
                <div x-show="!sidebarOpen"
                     class="absolute left-full top-1/2 -translate-y-1/2 ml-3 z-50 pointer-events-none opacity-0 group-hover/laporan:opacity-100 transition-opacity duration-200">
                    <div class="relative bg-slate-800 text-white text-xs font-medium px-3 py-1.5 rounded-md whitespace-nowrap">
                        <div class="absolute -left-1 top-1/2 -translate-y-1/2 w-2 h-2 bg-slate-800 rotate-45"></div>
                        Laporan
                    </div>
                </div>
            </div>
        @endif

    </nav>

    {{-- Profile Section (Bottom) --}}
    <div class="flex-shrink-0 border-t border-slate-100 p-3 relative" x-data="{ profileOpen: false }">

        {{-- Profile Popup (saat collapsed) --}}
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
                <div class="w-9 h-9 rounded-full bg-[#1e5bce] flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
                <div>
                    <p class="text-sm font-semibold text-slate-700 leading-none mb-0.5">{{ auth()->user()->name ?? 'User' }}</p>
                    <p class="text-xs text-slate-400 capitalize">{{ $role }}</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-2.5 px-3 py-2 text-sm font-medium text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                    <i class="fa-solid fa-arrow-right-from-bracket text-sm"></i>
                    Logout
                </button>
            </form>
        </div>

        <div class="flex items-center rounded-lg transition-all duration-300"
             :class="sidebarOpen ? 'gap-3 px-2 py-2' : 'justify-center py-2'">
            <div class="w-9 h-9 rounded-full bg-[#1e5bce] flex items-center justify-center text-white font-bold text-sm flex-shrink-0 transition-all duration-200"
                 :class="!sidebarOpen ? 'cursor-pointer hover:ring-2 hover:ring-[#1e5bce] hover:ring-offset-1' : ''"
                 @click="if (!sidebarOpen) profileOpen = !profileOpen">
                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
            </div>
            <div x-show="sidebarOpen" class="overflow-hidden" x-transition.opacity.duration.300ms>
                <p class="text-sm font-semibold text-slate-700 whitespace-nowrap leading-none mb-0.5">{{ auth()->user()->name ?? 'User' }}</p>
                <p class="text-xs text-slate-400 whitespace-nowrap capitalize">{{ $role }}</p>
            </div>
            <form x-show="sidebarOpen" method="POST" action="{{ route('logout') }}" class="ml-auto" x-transition.opacity.duration.300ms>
                @csrf
                <button type="submit" class="text-slate-400 hover:text-red-500 focus:outline-none transition-colors flex-shrink-0">
                    <i class="fa-solid fa-arrow-right-from-bracket text-sm"></i>
                </button>
            </form>
        </div>
    </div>

</aside>
