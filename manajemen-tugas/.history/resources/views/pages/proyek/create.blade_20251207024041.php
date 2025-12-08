@extends('layout.app', ['pageTitle' => 'Tambah Proyek'])

@section('content')

<div class="w-full flex justify-center">

    <!-- CARD WRAPPER -->
    <div class="bg-white w-full max-w-4xl p-10 rounded-3xl shadow-lg">

        <h1 class="text-xl font-semibold mb-8">Tambah Proyek Baru</h1>

        <form action="{{ route('proyek.store') }}" method="POST">
            @csrf

            <!-- NAMA PROYEK -->
            <div class="mb-6">
                <label class="font-medium">Nama Proyek</label>
                <input type="text"
                       name="nama"
                       value="{{ old('nama') }}"
                       placeholder="Masukkan nama proyek"
                       required
                       class="mt-2 w-full px-4 py-3 bg-gray-100 border rounded-xl focus:ring-2 focus:ring-black outline-none">
                @error('nama')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- DESKRIPSI -->
            <div class="mb-6">
                <label class="font-medium">Deskripsi</label>
                <textarea name="deskripsi"
                          placeholder="Deskripsikan detail proyek..."
                          rows="3"
                          class="mt-2 w-full px-4 py-3 bg-gray-100 border rounded-xl focus:ring-2 focus:ring-black outline-none">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- GRID 2 KOLOM -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- STATUS -->
                <div>
                    <label class="font-medium">Status</label>
                    <select name="status"
                            required
                            class="mt-2 w-full px-4 py-3 bg-gray-100 border rounded-xl focus:ring-2 focus:ring-black outline-none">
                        <option value="">Pilih status</option>
                        <option value="Belum Mulai" {{ old('status') == 'Belum Mulai' ? 'selected' : '' }}>Belum Mulai</option>
                        <option value="Proses" {{ old('status') == 'Proses' ? 'selected' : '' }}>Proses</option>
                        <option value="Selesai" {{ old('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- PROGRESS -->
                <div>
                    <label class="font-medium">Progress (%)</label>
                    <input type="number"
                           name="progress"
                           value="{{ old('progress', 0) }}"
                           min="0"
                           max="100"
                           placeholder="0"
                           required
                           class="mt-2 w-full px-4 py-3 bg-gray-100 border rounded-xl focus:ring-2 focus:ring-black outline-none">
                    @error('progress')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- TANGGAL MULAI -->
                <div>
                    <label class="font-medium">Tanggal Mulai</label>
                    <input type="date"
                           name="tanggal_mulai"
                           value="{{ old('tanggal_mulai') }}"
                           required
                           class="mt-2 w-full px-4 py-3 bg-gray-100 border rounded-xl focus:ring-2 focus:ring-black outline-none">
                    @error('tanggal_mulai')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- TANGGAL SELESAI -->
                <div>
                    <label class="font-medium">Tanggal Target Selesai</label>
                    <input type="date"
                           name="tanggal_selesai"
                           value="{{ old('tanggal_selesai') }}"
                           required
                           class="mt-2 w-full px-4 py-3 bg-gray-100 border rounded-xl focus:ring-2 focus:ring-black outline-none">
                    @error('tanggal_selesai')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <!-- BUTTON -->
            <div class="mt-10 flex justify-end gap-3">
                <a href="{{ route('proyek.index') }}"
                   class="px-6 py-2 rounded-xl border bg-gray-200 hover:bg-gray-300 transition">
                    Batal
                </a>

                <button type="submit"
                        class="px-6 py-2 rounded-xl bg-black text-white hover:bg-gray-800 transition">
                    Simpan Proyek
                </button>
            </div>

        </form>

    </div>

</div>

@endsection
