<x-layouts.admin :role="'admin'" :pageTitle="'Dashboard Admin'">

    <h2 class="text-[#0f172a] text-2xl font-bold mb-6">Dashboard</h2>

    {{-- Cards Row --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        {{-- Card 1 --}}
        <div class="bg-white rounded-xl border border-slate-200 p-6 hover:shadow-md transition-shadow duration-200">
            <div class="w-12 h-12 rounded-lg bg-[#dbeafe] text-[#1e40af] flex items-center justify-center mb-4">
                <i class="fa-solid fa-user-group text-xl"></i>
            </div>
            <p class="text-sm font-semibold text-slate-500 mb-1">Total Nasabah</p>
            <h3 class="text-3xl font-bold text-[#0f172a]">12,459</h3>
        </div>

        {{-- Card 2 --}}
        <div class="bg-white rounded-xl border border-slate-200 p-6 hover:shadow-md transition-shadow duration-200">
            <div class="w-12 h-12 rounded-lg bg-[#cffafe] text-[#0891b2] flex items-center justify-center mb-4">
                <i class="fa-solid fa-bolt text-xl"></i>
            </div>
            <p class="text-sm font-semibold text-slate-500 mb-1">Nasabah Aktif</p>
            <h3 class="text-3xl font-bold text-[#0f172a]">8,922</h3>
        </div>

        {{-- Card 3 --}}
        <div class="bg-white rounded-xl border border-slate-200 p-6 hover:shadow-md transition-shadow duration-200">
            <div class="w-12 h-12 rounded-lg bg-[#fee2e2] text-[#b91c1c] flex items-center justify-center mb-4">
                <i class="fa-solid fa-clipboard-list text-xl"></i>
            </div>
            <p class="text-sm font-semibold text-slate-500 mb-1">Permintaan Baru</p>
            <h3 class="text-3xl font-bold text-[#0f172a]">142</h3>
        </div>
    </div>

    {{-- Chart Card --}}
    <div class="bg-white rounded-xl border border-slate-200">
        <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between">
            <div>
                <h3 class="text-xl font-bold text-[#0f172a] mb-1">Analisis Data Nasabah</h3>
                <p class="text-sm text-slate-500 font-medium">Memantau volume transaksi dan aktivitas nasabah dalam 30 hari terakhir.</p>
            </div>
            <div class="mt-4 sm:mt-0 flex space-x-3">
                <button class="px-4 py-2 border border-slate-300 rounded-lg text-sm font-semibold text-slate-600 hover:bg-slate-50 transition-colors">
                    7 Hari Terakhir
                </button>
                <button class="px-4 py-2 bg-[#004aad] text-white rounded-lg text-sm font-semibold hover:bg-blue-800 transition-colors">
                    Export Laporan
                </button>
            </div>
        </div>
        {{-- Chart placeholder --}}
        <div class="p-6 h-72 flex items-center justify-center relative">
            <div class="absolute inset-0 p-6 pointer-events-none opacity-20">
                <svg class="w-full h-full" preserveAspectRatio="none" viewBox="0 0 100 100">
                    <path d="M0,80 L10,70 L20,75 L40,50 L50,55 L70,30 L85,40 L100,20"
                          fill="none" stroke="#004aad" stroke-width="2" vector-effect="non-scaling-stroke"></path>
                </svg>
            </div>
            <p class="text-slate-400 text-sm font-medium">Chart akan ditampilkan di sini</p>
        </div>
    </div>

</x-layouts.admin>
