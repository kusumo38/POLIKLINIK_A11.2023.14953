
<x-layouts.app title="Edit Obat">

    {{-- Header --}}
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('obat.index') }}"
            class="flex items-center justify-center w-10 h-10 rounded-lg bg-slate-100 text-slate-600 hover:bg-slate-200 transition">
            <i class="fas fa-arrow-left"></i>
        </a>

        <div>
            <h2 class="text-2xl font-bold text-slate-800">
                Edit Obat
            </h2>
            <p class="text-sm text-slate-500 mt-1">
                Perbarui informasi obat yang dipilih.
            </p>
        </div>
    </div>

    {{-- Error validasi --}}
    @if($errors->any())
        <div class="alert alert-error mb-5 rounded-xl">
            <i class="fas fa-circle-exclamation"></i>
            <div>
                <p class="font-semibold">Periksa kembali input kamu.</p>
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

            <form action="{{ route('obat.update', $obat->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Nama Obat --}}
                <div class="form-control mb-5">
                    <label for="nama_obat" class="label pb-1">
                        <span class="text-sm font-semibold text-slate-700">
                            Nama Obat <span class="text-red-500">*</span>
                        </span>
                    </label>

                    <input
                        type="text"
                        id="nama_obat"
                        name="nama_obat"
                        value="{{ old('nama_obat', $obat->nama_obat) }}"
                        placeholder="Masukkan nama obat"
                        maxlength="255"
                        class="input input-bordered w-full rounded-lg @error('nama_obat') input-error @enderror"
                        required>

                    @error('nama_obat')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kemasan --}}
                <div class="form-control mb-5">
                    <label for="kemasan" class="label pb-1">
                        <span class="text-sm font-semibold text-slate-700">
                            Kemasan <span class="text-red-500">*</span>
                        </span>
                    </label>

                    <input
                        type="text"
                        id="kemasan"
                        name="kemasan"
                        value="{{ old('kemasan', $obat->kemasan) }}"
                        placeholder="Masukkan kemasan obat"
                        maxlength="35"
                        class="input input-bordered w-full rounded-lg @error('kemasan') input-error @enderror"
                        required>

                    @error('kemasan')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Harga --}}
                <div class="form-control mb-7">
                    <label for="harga" class="label pb-1">
                        <span class="text-sm font-semibold text-slate-700">
                            Harga (Rp) <span class="text-red-500">*</span>
                        </span>
                    </label>

                    <label class="input input-bordered flex items-center gap-2 rounded-lg @error('harga') input-error @enderror">
                        <span class="text-slate-500 font-semibold">Rp</span>
                        <input
                            type="number"
                            id="harga"
                            name="harga"
                            value="{{ old('harga', $obat->harga) }}"
                            placeholder="Masukkan harga obat"
                            min="0"
                            step="1"
                            class="grow"
                            required>
                    </label>

                    @error('harga')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tombol --}}
                <div class="flex flex-wrap gap-3">
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-6 py-2.5 bg-[#2d4499] hover:bg-[#1e2d6b] text-white rounded-lg text-sm font-semibold transition">
                        <i class="fas fa-save"></i>
                        Simpan Perubahan
                    </button>

                    <a href="{{ route('obat.index') }}"
                        class="inline-flex items-center gap-2 px-6 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-lg text-sm font-semibold transition">
                        Batal
                    </a>
                </div>

            </form>

        </div>
    </div>

</x-layouts.app>