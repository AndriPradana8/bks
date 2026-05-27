<x-layouts.admin :role="auth()->user()->role ?? 'admin'" :pageTitle="'Data Tabungan'">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-[#0f172a] text-2xl font-bold">Data Tabungan</h2>
    </div>

    <div class="bg-white rounded-xl border border-slate-200 p-6 min-h-[400px] flex items-center justify-center">
        <div class="text-center">
            <div class="w-16 h-16 bg-blue-50 text-primary rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fa-solid fa-wallet text-2xl"></i>
            </div>
            <h3 class="text-lg font-bold text-slate-800 mb-1">Modul Tabungan</h3>
            <p class="text-slate-500 text-sm">Halaman ini siap untuk dikembangkan.</p>
        </div>
    </div>
</x-layouts.admin>
