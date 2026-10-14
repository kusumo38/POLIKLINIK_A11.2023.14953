
<x-layouts.app title="Edit Jadwal Periksa">

    {{-- Header --}}
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('jadwal-periksa.index') }}"
            class="flex items-center justify-center w-10 h-10 rounded-lg bg-slate-100 text-slate-600 hover:bg-slate-200 transition">
            <i class="fas fa-arrow-left"></i>
        </a>

        <div>
            <h2 class="text-2xl font-bold text-slate-800">
                Edit Jadwal Periksa
            </h2>
            <p class="text-sm text-slate-500 mt-1">
                Perbarui jadwal praktik kamu.
            </p>
        </div>
    </div>

    {{-- Error validasi --}}
    @if($errors->any())
        <div class="alert alert-error mb-5 rounded-xl">
            <i class="fas fa-circle-exclamation"></i>
            <div>
                <p class="font-semibold">Periksa kembali data jadwal.</p>
                <ul class="list-disc ml-5 mt-1 text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    {{-- Form --}}
    <div class="card bg-base-100 shadow-md rounded-2xl border border-slate-200">
        <div class="card-body p-6 sm:p-8">

            <form action="{{ route('jadwal-periksa.update', $jadwal->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Hari --}}
                <div class="form-control mb-5">
                    <label for="hari" class="label pb-1">
                        <span class="text-sm font-semibold text-slate-700">
                            Hari Praktik <span class="text-red-500">*</span>
                        </span>
                    </label>

                    <select
                        id="hari"
                        name="hari"
                        class="select select-bordered w-full rounded-lg @error('hari') select-error @enderror"
                        required>
                        <option value="">-- Pilih Hari --</option>

                        @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $hari)
                            <option value="{{ $hari }}"
                                {{ old('hari', $jadwal->hari) === $hari ? 'selected' : '' }}>
                                {{ $hari }}
                            </option>
                        @endforeach
                    </select>

                    @error('hari')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Jam Mulai --}}
                <div class="form-control mb-5">
                    <label for="jam_mulai" class="label pb-1">
                        <span class="text-sm font-semibold text-slate-700">
                            Jam Mulai <span class="text-red-500">*</span>
                        </span>
                    </label>

                    <input
                        type="time"
                        id="jam_mulai"
                        name="jam_mulai"
                        value="{{ old('jam_mulai', substr($jadwal->jam_mulai, 0, 5)) }}"
                        class="input input-bordered w-full rounded-lg @error('jam_mulai') input-error @enderror"
                        required>

                    @error('jam_mulai')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Jam Selesai --}}
                <div class="form-control mb-7">
                    <label for="jam_selesai" class="label pb-1">
                        <span class="text-sm font-semibold text-slate-700">
                            Jam Selesai <span class="text-red-500">*</span>
                        </span>
                    </label>

                    <input
                        type="time"
                        id="jam_selesai"
                        name="jam_selesai"
                        value="{{ old('jam_selesai', substr($jadwal->jam_selesai, 0, 5)) }}"
                        class="input input-bordered w-full rounded-lg @error('jam_selesai') input-error @enderror"
                        required>

                    @error('jam_selesai')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status jadwal --}}
                <div class="form-control mb-7">
                    <label for="status" class="label pb-1">
                        <span class="text-sm font-semibold text-slate-700">
                            Status Jadwal
                        </span>
                    </label>

                    <select
                        id="status"
                        name="status"
                        class="select select-bordered w-full rounded-lg"
                        required>
                        <option value="1"
                            {{ (string) old('status', (int) $jadwal->status) === '1' ? 'selected' : '' }}>
                            Aktif
                        </option>
                        <option value="0"
                            {{ (string) old('status', (int) $jadwal->status) === '0' ? 'selected' : '' }}>
                            Tidak Aktif
                        </option>
                    </select>
                </div>

                {{-- Tombol --}}
                <div class="flex flex-wrap gap-3">
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-6 py-2.5 bg-[#2d4499] hover:bg-[#1e2d6b] text-white rounded-lg text-sm font-semibold transition">
                        <i class="fas fa-save"></i>
                        Simpan Perubahan
                    </button>

                    <a href="{{ route('jadwal-periksa.index') }}"
                        class="inline-flex items-center gap-2 px-6 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-lg text-sm font-semibold transition">
                        Batal
                    </a>
                </div>

            </form>
        </div>
    </div>

</x-layouts.app>