
<x-layouts.app title="Manajemen Obat">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">
                Manajemen Obat
            </h2>
            <p class="text-sm text-slate-500 mt-1">
                Kelola data obat yang tersedia di poliklinik.
            </p>
        </div>

        <a href="{{ route('obat.create') }}"
            class="inline-flex items-center justify-center gap-2 bg-[#2d4499] hover:bg-[#1e2d6b] text-white rounded-lg px-5 py-2.5 text-sm font-semibold transition">
            <i class="fas fa-plus"></i>
            Tambah Obat
        </a>
    </div>

    {{-- Notifikasi sukses --}}
    @if(session('message'))
        <div class="alert alert-success mb-4 rounded-xl shadow-sm">
            <i class="fas fa-circle-check"></i>
            <span>{{ session('message') }}</span>
        </div>
    @endif

    {{-- Notifikasi error --}}
    @if(session('error'))
        <div class="alert alert-error mb-4 rounded-xl shadow-sm">
            <i class="fas fa-circle-xmark"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    {{-- Ringkasan --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
        <div class="card bg-base-100 border border-slate-200 shadow-sm rounded-2xl">
            <div class="card-body p-5 flex-row items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center">
                    <i class="fas fa-pills text-xl"></i>
                </div>
                <div>
                    <p class="text-sm text-slate-500">Total Jenis Obat</p>
                    <h3 class="text-2xl font-bold text-slate-800">
                        {{ $obats->count() }}
                    </h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel Obat --}}
    <div class="card bg-base-100 shadow-md rounded-2xl border border-slate-200">
        <div class="card-body p-0">
            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">

                    <thead class="bg-slate-100 text-slate-500 text-xs uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-4">No.</th>
                            <th class="px-6 py-4">Nama Obat</th>
                            <th class="px-6 py-4">Kemasan</th>
                            <th class="px-6 py-4">Harga</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($obats as $obat)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4 text-slate-500">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-6 py-4 font-semibold text-slate-800">
                                    {{ $obat->nama_obat }}
                                </td>

                                <td class="px-6 py-4 text-slate-600">
                                    {{ $obat->kemasan }}
                                </td>

                                <td class="px-6 py-4 font-semibold text-slate-800">
                                    Rp {{ number_format($obat->harga, 0, ',', '.') }}
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex justify-end items-center gap-2">

                                        {{-- Edit --}}
                                        <a href="{{ route('obat.edit', $obat->id) }}"
                                            class="inline-flex items-center gap-1 px-3 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-lg text-xs font-semibold transition">
                                            <i class="fas fa-pen-to-square"></i>
                                            Edit
                                        </a>

                                        {{-- Hapus --}}
                                        <form action="{{ route('obat.destroy', $obat->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus obat {{ addslashes($obat->nama_obat) }}?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="inline-flex items-center gap-1 px-3 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg text-xs font-semibold transition">
                                                <i class="fas fa-trash"></i>
                                                Hapus
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-14 text-slate-400">
                                    <i class="fas fa-pills text-3xl mb-3 block"></i>
                                    <p class="font-semibold">Belum ada data obat</p>
                                    <p class="text-sm mt-1">
                                        Klik tombol Tambah Obat untuk memasukkan data.
                                    </p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>

</x-layouts.app>