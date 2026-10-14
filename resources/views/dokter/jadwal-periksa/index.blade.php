
<x-layouts.app title="Jadwal Periksa">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">
                Jadwal Periksa
            </h2>
            <p class="text-sm text-slate-500 mt-1">
                Kelola jadwal praktik kamu.
            </p>
        </div>

        <a href="{{ route('jadwal-periksa.create') }}"
            class="inline-flex items-center justify-center gap-2 bg-[#2d4499] hover:bg-[#1e2d6b] text-white rounded-lg px-5 py-2.5 text-sm font-semibold">
            <i class="fas fa-plus"></i>
            Tambah Jadwal
        </a>
    </div>

    @if(session('message'))
        <div class="alert alert-success mb-4">
            {{ session('message') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-error mb-4">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="card bg-base-100 shadow-md rounded-2xl border border-slate-200">
        <div class="card-body p-0">
            <div class="overflow-x-auto">
                <table class="table table-zebra w-full">
                    <thead class="bg-slate-100 text-slate-500">
                        <tr>
                            <th>No.</th>
                            <th>Hari</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                            <th>Status</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($jadwals as $jadwal)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="font-semibold">
                                    {{ $jadwal->hari }}
                                </td>
                                <td>{{ substr($jadwal->jam_mulai, 0, 5) }}</td>
                                <td>{{ substr($jadwal->jam_selesai, 0, 5) }}</td>

                                <td>
                                    @if($jadwal->status)
                                        <span class="badge badge-success">
                                            Aktif
                                        </span>
                                    @else
                                        <span class="badge badge-ghost">
                                            Tidak Aktif
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('jadwal-periksa.edit', $jadwal->id) }}"
                                            class="btn btn-warning btn-sm text-white">
                                            <i class="fas fa-pen"></i>
                                            Edit
                                        </a>

                                        <form action="{{ route('jadwal-periksa.destroy', $jadwal->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="btn btn-error btn-sm text-white">
                                                <i class="fas fa-trash"></i>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-12 text-slate-400">
                                    <i class="fas fa-calendar-days text-3xl mb-3"></i>
                                    <p>Belum ada jadwal periksa.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-layouts.app>