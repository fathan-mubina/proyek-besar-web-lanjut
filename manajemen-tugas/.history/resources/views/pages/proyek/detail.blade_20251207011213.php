
@extends('layout.app', ['pageTitle' => 'Proyek'])

@section('content')
<div class="px-8 py-6">

    <h1 class="text-2xl font-semibold mb-6">Tambah Proyek Baru</h1>

    <form action="{{ route('proyek.store') }}" method="POST" class="max-w-2xl space-y-6">
        @csrf

        {{-- Nama Proyek --}}
        <div>
            <label class="font-medium">Nama Proyek</label>
            <input type="text"
                   name="nama"
                   required
                   class="w-full mt-1 p-3 bg-gray-100 rounded-lg border focus:ring-2 focus:ring-black outline-none"
                   placeholder="Masukkan nama proyek">
            @error('nama')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Deskripsi --}}
        <div>
            <label class="font-medium">Deskripsi</label>
            <textarea name="deskripsi"
                      rows="4"
                      class="w-full mt-1 p-3 bg-gray-100 rounded-lg border focus:ring-2 focus:ring-black outline-none"
                      placeholder="Deskripsikan detail proyek..."></textarea>
            @error('deskripsi')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Grid 2 Kolom --}}
        <div class="grid grid-cols-2 gap-6">

            {{-- Status --}}
            <div>
                <label class="font-medium">Status</label>
                <select name="status"
                        required
                        class="w-full mt-1 p-3 bg-gray-100 rounded-lg border focus:ring-2 focus:ring-black outline-none">
                    <option value="">Pilih Status</option>
                    <option value="Belum Mulai">Belum Mulai</option>
                    <option value="Proses">Proses</option>
                    <option value="Selesai">Selesai</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Progress --}}
            <div>
                <label class="font-medium">Progress (%)</label>
                <input type="number"
                       name="progress"
                       min="0"
                       max="100"
                       value="0"
                       class="w-full mt-1 p-3 bg-gray-100 rounded-lg border focus:ring-2 focus:ring-black outline-none"
                       placeholder="0-100">
                @error('progress')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tanggal Mulai --}}
            <div>
                <label class="font-medium">Tanggal Mulai</label>
                <input type="date"
                       name="tanggal_mulai"
                       required
                       class="w-full mt-1 p-3 bg-gray-100 rounded-lg border focus:ring-2 focus:ring-black outline-none">
                @error('tanggal_mulai')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tanggal Selesai --}}
            <div>
                <label class="font-medium">Tanggal Selesai</label>
                <input type="date"
                       name="tanggal_selesai"
                       required
                       class="w-full mt-1 p-3 bg-gray-100 rounded-lg border focus:ring-2 focus:ring-black outline-none">
                @error('tanggal_selesai')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

        </div>

        {{-- Buttons --}}
        <div class="flex gap-3">
            <a href="{{ route('proyek.index') }}"
               class="px-6 py-2 bg-gray-200 text-black rounded-lg shadow hover:bg-gray-300 font-medium">
                Batal
            </a>
            <button type="submit"
                    class="px-6 py-2 bg-black text-white rounded-lg shadow hover:bg-gray-800 font-medium">
                Simpan Proyek
            </button>
        </div>

    </form>

</div>
@endsection

{{-- ========================================
     2. DETAIL.BLADE.PHP - DIPERBAIKI
     ======================================== --}}
@extends('layout.app', ['pageTitle' => 'Detail Proyek'])

@section('content')
<div class="px-8 py-6">

    {{-- Header --}}
    <div class="mb-6">
        <div class="flex items-center justify-between mb-4">
            <h1 class="text-2xl font-semibold">Detail Proyek</h1>
            <a href="{{ route('proyek.index') }}"
               class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                ← Kembali
            </a>
        </div>

        <h2 class="text-xl font-semibold">{{ $project->nama }}</h2>
        <p class="text-gray-600">{{ $project->deskripsi ?? 'Tidak ada deskripsi' }}</p>

        <div class="flex items-center text-gray-500 text-sm gap-6 mt-2">
            <span>
                📅 {{ $project->tanggal_mulai->format('d M Y') }} –
                {{ $project->tanggal_selesai->format('d M Y') }}
            </span>

            <span>👤 Dibuat oleh {{ $project->user->name }}</span>

            {{-- Progress Badge --}}
            <span class="px-3 py-1 rounded-full text-xs font-medium
                @if($project->progress < 50) bg-red-100 text-red-700
                @elseif($project->progress < 100) bg-yellow-100 text-yellow-700
                @else bg-green-100 text-green-700
                @endif">
                Progress: {{ $project->progress }}%
            </span>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-6">

        {{-- Daftar Tugas --}}
        <div class="col-span-8 bg-white p-6 rounded-2xl shadow-md border border-gray-100">

            <div class="flex justify-between items-center mb-5">
                <h3 class="text-xl font-semibold text-gray-800">Daftar Tugas</h3>

                <a href="{{ route('tugas.create', ['project_id' => $project->id]) }}"
                   class="px-4 py-2 rounded-xl bg-black text-white text-sm hover:bg-gray-800 transition">
                    + Tambah Tugas
                </a>
            </div>

            @forelse ($project->tasks as $task)

            {{-- Card Tugas --}}
            <div class="p-5 mb-4 rounded-xl border border-gray-200 bg-white shadow-sm hover:shadow-md transition-all">

                {{-- Header --}}
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <p class="text-lg font-semibold text-gray-900">{{ $task->judul }}</p>
                        <p class="text-gray-500 text-sm mt-1">{{ $task->deskripsi }}</p>
                    </div>

                    {{-- Badge Status --}}
                    @php
                        $statusStyle = [
                            'Belum Mulai' => 'bg-red-100 text-red-600 border-red-300',
                            'Proses'      => 'bg-blue-100 text-blue-600 border-blue-300',
                            'Sedang'      => 'bg-yellow-100 text-yellow-700 border-yellow-300',
                            'Selesai'     => 'bg-green-100 text-green-700 border-green-300',
                        ];

                        $prioritasStyle = [
                            'rendah' => 'bg-gray-100 text-gray-600',
                            'sedang' => 'bg-orange-100 text-orange-600',
                            'tinggi' => 'bg-red-100 text-red-600',
                        ];
                    @endphp

                    <div class="flex flex-col gap-2">
                        <span class="px-3 py-1 text-xs rounded-full border
                            {{ $statusStyle[$task->status] ?? 'bg-gray-200 text-gray-700 border-gray-300' }}">
                            {{ $task->status }}
                        </span>

                        <span class="px-3 py-1 text-xs rounded-full
                            {{ $prioritasStyle[$task->prioritas] ?? 'bg-gray-200 text-gray-700' }}">
                            {{ ucfirst($task->prioritas) }}
                        </span>
                    </div>
                </div>

                {{-- Detail --}}
                <div class="mt-4 flex items-center gap-6 text-sm text-gray-600">

                    {{-- Assigned --}}
                    <div class="flex items-center gap-2">
                        <span class="font-semibold">👤 Assigned:</span>
                        <span>{{ $task->assignedTo->name ?? 'Belum ditugaskan' }}</span>
                    </div>

                    {{-- Deadline --}}
                    <div class="flex items-center gap-2">
                        <span class="font-semibold">⏳ Deadline:</span>
                        @if ($task->tanggal_deadline)
                            <span>{{ \Carbon\Carbon::parse($task->tanggal_deadline)->format('d M Y') }}</span>
                        @else
                            <span class="text-gray-400">Tidak ada deadline</span>
                        @endif
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="mt-4 flex justify-end gap-2">
                    <a href="{{ route('tugas.edit', $task->id) }}"
                       class="px-3 py-1.5 text-xs bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                        Edit Tugas
                    </a>
                </div>
            </div>

            @empty
                <div class="text-center py-8 text-gray-500">
                    <p class="mb-4">Belum ada tugas di proyek ini.</p>
                    <a href="{{ route('tugas.create', ['project_id' => $project->id]) }}"
                       class="inline-block px-6 py-2 bg-black text-white rounded-lg hover:bg-gray-800">
                        + Buat Tugas Pertama
                    </a>
                </div>
            @endforelse

        </div>

        {{-- Anggota Tim --}}
        <div class="col-span-4 bg-white p-6 rounded-2xl shadow-sm border border-gray-200">

            <h3 class="text-xl font-semibold mb-4 flex items-center gap-2">
                👥 Anggota Tim
            </h3>

            {{-- Form Tambah Anggota --}}
            <form action="{{ route('proyek.addMember', $project->id) }}" method="POST" class="flex gap-3 mb-6">
                @csrf

                <select
                    name="user_id"
                    required
                    class="flex-1 px-4 py-2 rounded-xl border border-gray-300 bg-gray-50
                           focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition">
                    <option value="" disabled selected>Pilih anggota...</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>

                <button
                    type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-xl shadow
                           hover:bg-indigo-700 transition">
                    Tambah
                </button>
            </form>

            {{-- Success/Error Messages --}}
            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-lg text-sm">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Daftar Anggota --}}
            <div class="space-y-3">
                @forelse ($project->anggota as $member)
                    <div class="flex items-center justify-between bg-gray-50 p-3 rounded-xl border border-gray-200">

                        <div class="flex items-center gap-3">
                            {{-- Avatar --}}
                            <div class="w-10 h-10 rounded-full bg-indigo-200 flex items-center justify-center font-bold text-indigo-700">
                                {{ strtoupper(substr($member->name, 0, 1)) }}
                            </div>

                            <div>
                                <p class="font-medium text-gray-900">{{ $member->name }}</p>
                                <p class="text-gray-500 text-xs">{{ $member->email }}</p>
                            </div>
                        </div>

                        {{-- Tombol Hapus --}}
                        <form action="{{ route('proyek.removeMember', [$project->id, $member->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                onclick="return confirm('Hapus anggota ini?')"
                                class="text-red-500 hover:text-red-700 text-sm font-medium">
                                Hapus
                            </button>
                        </form>

                    </div>
                @empty
                    <p class="text-gray-500 text-sm text-center py-4">Belum ada anggota tim.</p>
                @endforelse
            </div>

        </div>

    </div>

    {{-- Komentar --}}
    <div class="bg-white p-6 rounded-xl shadow mt-6">
        <h3 class="text-lg font-semibold mb-4">💬 Komentar</h3>

        {{-- List Komentar --}}
        <div class="space-y-4 mb-6">
            @forelse ($project->komentar as $comment)
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <div class="flex items-center justify-between mb-2">
                        <p class="font-medium text-gray-900">{{ $comment->user->name }}</p>
                        <span class="text-xs text-gray-500">
                            {{ $comment->created_at->diffForHumans() }}
                        </span>
                    </div>
                    <p class="text-gray-600">{{ $comment->isi_komentar }}</p>
                </div>
            @empty
                <p class="text-gray-500 text-sm text-center py-4">Belum ada komentar.</p>
            @endforelse
        </div>

        {{-- Form Komentar --}}
        <form method="POST" action="{{ route('proyek.komentar.store', $project->id) }}">
            @csrf
            <div class="flex gap-3">
                <input type="text"
                       name="isi_komentar"
                       required
                       class="flex-1 p-3 bg-gray-100 rounded-lg border focus:ring-2 focus:ring-black outline-none"
                       placeholder="Tulis komentar...">

                <button type="submit"
                        class="px-6 py-3 bg-black text-white rounded-lg hover:bg-gray-800 transition">
                    Kirim
                </button>
            </div>
        </form>
    </div>

</div>
