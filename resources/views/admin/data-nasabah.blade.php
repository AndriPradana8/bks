<x-layouts.admin :role="auth()->user()->role ?? 'admin'" :pageTitle="'Data Nasabah'">
    <h2 class="text-[#0f172a] text-2xl font-bold mb-6">Data Nasabah</h2>

    <div class="bg-white rounded-xl border border-slate-200 p-6">
        <!-- Toast Notifications -->
        <div class="fixed top-5 right-5 z-[60] flex flex-col gap-3 pointer-events-none">
            @if (session('success'))
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition.duration.500ms class="pointer-events-auto flex items-center w-full max-w-xs p-4 text-green-800 bg-green-50 border border-green-400 rounded-lg" role="alert">
                    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg">
                        <i class="fa-solid fa-check"></i>
                    </div>
                    <div class="ms-3 text-sm font-medium text-green-800">{{ session('success') }}</div>
                </div>
            @endif
            @if (session('error'))
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition.duration.500ms class="pointer-events-auto flex items-center w-full max-w-xs p-4 text-red-800 bg-red-50 border border-red-400 rounded-lg" role="alert">
                    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg">
                        <i class="fa-solid fa-xmark"></i>
                    </div>
                    <div class="ms-3 text-sm font-medium text-red-800">{{ session('error') }}</div>
                </div>
            @endif
            @if ($errors->any())
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show" x-transition.duration.500ms class="pointer-events-auto flex items-start w-full max-w-xs p-4 text-red-800 bg-red-50 border border-red-400 rounded-lg" role="alert">
                    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg mt-0.5">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
                        </svg>
                    </div>
                    <div class="ms-3 text-sm font-medium text-red-800">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button @click="show = false" type="button" class="ms-auto -mx-1.5 -my-1.5 bg-transparent text-red-600 hover:bg-red-100 hover:text-red-900 rounded-lg p-1.5 inline-flex items-center justify-center h-8 w-8">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
            @endif
        </div>
        <div class="relative overflow-x-auto bg-white rounded-xl border border-slate-200">
            <div class="p-4 flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="relative w-full md:w-1/3" x-data="{
                    search: '{{ $search ?? '' }}',
                    timer: null,
                    doSearch() {
                        clearTimeout(this.timer);
                        this.timer = setTimeout(() => {
                            const url = new URL(window.location.href);
                            if (this.search) {
                                url.searchParams.set('search', this.search);
                            } else {
                                url.searchParams.delete('search');
                            }
                            url.searchParams.delete('page');
                            window.location.href = url.toString();
                        }, 400);
                    }
                }">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                        <i class="fa-solid fa-magnifying-glass text-sm"></i>
                    </div>
                    <input type="text" x-model="search" @input="doSearch()"
                        class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-xl focus:outline-none focus:ring-primary focus:border-primary block w-full pl-10 p-2.5 transition-all duration-200"
                        placeholder="Cari Nasabah...">
                </div>
                <button type="button" data-modal-target="tambahNasabahModal" data-modal-toggle="tambahNasabahModal"
                    class="w-full md:w-auto flex items-center justify-center gap-2 bg-primary text-white hover:bg-blue-800 font-medium rounded-xl text-sm px-4 py-2.5 transition-colors">
                    <i class="fa-solid fa-plus text-xs"></i>
                    Tambah Data
                </button>
            </div>
            <table class="w-full text-sm text-left rtl:text-right text-body">
                <thead class="text-sm text-body bg-primary-light border-b border-t border-default-medium">
                    <tr>
                        <th scope="col" class="px-6 py-3 font-medium">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3 font-medium">
                            NIK
                        </th>
                        <th scope="col" class="px-6 py-3 font-medium">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3 font-medium">
                            Tanggal Lahir
                        </th>
                        <th scope="col" class="px-6 py-3 font-medium">
                            No. Telp
                        </th>
                        <th scope="col" class="px-6 py-3 font-medium">
                            Alamat
                        </th>
                        <th scope="col" class="px-6 py-3 font-medium">

                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($nasabahs as $nasabah)
                        <tr class="bg-neutral-primary-soft border-b border-default hover:bg-neutral-secondary-medium">
                            <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                                {{ $nasabahs->firstItem() + $loop->index }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $nasabah->nik }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $nasabah->nama_lengkap }}
                            </td>
                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($nasabah->tanggal_lahir)->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $nasabah->no_hp }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $nasabah->alamat }}
                            </td>
                            <td class="px-6 py-4">
                                <button type="button" data-modal-target="editNasabahModal-{{ $nasabah->id }}" data-modal-toggle="editNasabahModal-{{ $nasabah->id }}" class="text-yellow-500 hover:text-yellow-600">
                                    <i class="fa-regular fa-pen-to-square text-lg"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Edit Modal for Nasabah -->
                        <div id="editNasabahModal-{{ $nasabah->id }}" tabindex="-1" aria-hidden="true"
                            class="hidden bg-slate-900/50 overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-full max-h-full">
                            <div class="relative p-4 w-full max-w-2xl max-h-full">
                                <div class="relative bg-white rounded-xl shadow">
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                        <h3 class="text-xl font-semibold text-gray-900">Edit Data Nasabah</h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="editNasabahModal-{{ $nasabah->id }}">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Tutup modal</span>
                                        </button>
                                    </div>
                                    <div class="p-4 md:p-5 space-y-4">
                                        <form action="{{ route(auth()->user()->role === 'superadmin' ? 'superadmin.nasabah.update' : 'admin.nasabah.update', $nasabah->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="grid gap-4 mb-4 grid-cols-2">
                                                <div class="col-span-2 sm:col-span-1">
                                                    <label class="block mb-2 text-sm font-medium text-gray-900">NIK</label>
                                                    <input type="text" name="nik" value="{{ $nasabah->nik }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" required>
                                                </div>
                                                <div class="col-span-2 sm:col-span-1">
                                                    <label class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                                                    <input type="text" name="nama_lengkap" value="{{ $nasabah->nama_lengkap }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" required>
                                                </div>
                                                <div class="col-span-2 sm:col-span-1">
                                                    <label class="block mb-2 text-sm font-medium text-gray-900">Tanggal Lahir</label>
                                                    <input type="date" name="tanggal_lahir" value="{{ $nasabah->tanggal_lahir }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" required>
                                                </div>
                                                <div class="col-span-2 sm:col-span-1">
                                                    <label class="block mb-2 text-sm font-medium text-gray-900">No. Handphone</label>
                                                    <input type="text" name="no_hp" value="{{ $nasabah->no_hp }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" required>
                                                </div>
                                                <div class="col-span-2">
                                                    <label class="block mb-2 text-sm font-medium text-gray-900">Alamat</label>
                                                    <textarea name="alamat" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary">{{ $nasabah->alamat }}</textarea>
                                                </div>
                                            </div>
                                            <div class="flex justify-end gap-2 border-t pt-4 mt-4">
                                                <button data-modal-hide="editNasabahModal-{{ $nasabah->id }}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary focus:z-10 focus:ring-4 focus:ring-gray-100">Batal</button>
                                                <button type="submit" class="text-white bg-primary hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-slate-500">
                                Belum ada data nasabah.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <div class="flex flex-col md:flex-row items-center justify-between gap-3 mt-5">
            <p class="text-sm text-slate-500">
                Menampilkan <span class="font-semibold text-slate-700">{{ $nasabahs->count() }}</span> data dari <span class="font-semibold text-slate-700">{{ $nasabahs->total() }}</span> data
            </p>
            @if ($nasabahs->hasPages())
                <nav aria-label="Pagination">
                    <ul class="flex items-center -space-x-px text-sm">
                        {{-- Previous --}}
                        <li>
                            <a href="{{ $nasabahs->previousPageUrl() ?? '#' }}" class="flex items-center justify-center w-9 h-9 border border-slate-300 rounded-l-lg {{ $nasabahs->onFirstPage() ? 'text-slate-300 cursor-not-allowed bg-slate-50' : 'text-slate-600 bg-white hover:bg-primary-light hover:text-primary' }} transition-colors">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7"/></svg>
                            </a>
                        </li>
                        {{-- Page Numbers --}}
                        @foreach ($nasabahs->getUrlRange(1, $nasabahs->lastPage()) as $page => $url)
                            <li>
                                <a href="{{ $url }}" class="flex items-center justify-center w-9 h-9 border border-slate-300 text-sm font-medium transition-colors {{ $page == $nasabahs->currentPage() ? 'bg-primary text-white border-primary' : 'bg-white text-slate-600 hover:bg-primary-light hover:text-primary' }}">{{ $page }}</a>
                            </li>
                        @endforeach
                        {{-- Next --}}
                        <li>
                            <a href="{{ $nasabahs->nextPageUrl() ?? '#' }}" class="flex items-center justify-center w-9 h-9 border border-slate-300 rounded-r-lg {{ $nasabahs->hasMorePages() ? 'text-slate-600 bg-white hover:bg-primary-light hover:text-primary' : 'text-slate-300 cursor-not-allowed bg-slate-50' }} transition-colors">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/></svg>
                            </a>
                        </li>
                    </ul>
                </nav>
            @endif
        </div>

    </div>

    <!-- Main modal -->
    <div id="tambahNasabahModal" tabindex="-1" aria-hidden="true"
        class="hidden bg-slate-900/50 overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-full max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-xl shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Tambah Data Nasabah
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="tambahNasabahModal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Tutup modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <form action="{{ route(auth()->user()->role === 'superadmin' ? 'superadmin.nasabah.store' : 'admin.nasabah.store') }}" method="POST">
                        @csrf
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-2 sm:col-span-1">
                                <label for="nik" class="block mb-2 text-sm font-medium text-gray-900">NIK</label>
                                <input type="text" name="nik" id="nik"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5" placeholder="Masukkan NIK "
                                    required>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="nama_lengkap" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                                <input type="text" name="nama_lengkap" id="nama_lengkap"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                                    placeholder="Masukkan nama" required>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="tanggal_lahir" class="block mb-2 text-sm font-medium text-gray-900">Tanggal
                                    Lahir</label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                                    required>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="no_hp" class="block mb-2 text-sm font-medium text-gray-900">No.
                                    Handphone</label>
                                <input type="text" name="no_hp" id="no_hp"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                                    placeholder="Masukkan nomor handphone" required>
                            </div>
                            <div class="col-span-2">
                                <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900">Alamat</label>
                                <textarea id="alamat" name="alamat" rows="4"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary"
                                    placeholder="Masukkan alamat"></textarea>
                            </div>
                        </div>
                        <div class="flex justify-end gap-2 border-t pt-4 mt-4">
                            <button data-modal-hide="tambahNasabahModal" type="button"
                                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary focus:z-10 focus:ring-4 focus:ring-gray-100">Batal</button>
                            <button type="submit"
                                class="text-white bg-primary hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>