@extends('layout.app', ['pageTitle' => 'Proyek'])

@section('content')
<div class="px-8 py-6">

    {{-- Header --}}
    <h1 class="text-2xl font-semibold mb-1">Proyek</h1>

    <div class="mb-6">
        <h2 class="text-xl font-semibold">{{ $project->nama }}</h2>
        <p class="text-gray-600">{{ $project->deskripsi }}</p>

        <div class="flex items-center text-gray-500 text-sm gap-6 mt-2">
            <span>
                {{ $project->tanggal_mulai->format('d/M/Y') }} –
                {{ $project->tanggal_selesai->format('d/M/Y') }}
            </span>

            <span>Dibuat oleh {{ $project->creator->name }}</span>
        </div>
    </div>

   <div class="grid grid-cols-12 gap-6">


        {{-- Daftar Tugas --}}
 <div class="col-span-8 bg-white p-6 rounded-2xl shadow-md border border-gray-100 hover:shadow-lg transition-all">

    <div class="flex justify-between items-center mb-5">
        <h3 class="text-xl font-semibold text-gray-800">Daftar Tugas</h3>

        <a href="{{ route('tugas.create', ['project_id' => $project->id]) }}"
           class="px-4 py-2 rounded-xl bg-gray-900 text-white text-sm hover:bg-gray-700 transition">
            + Tambah Tugas
        </a>
    </div>

    @forelse ($project->tasks as $task)

    {{-- Card Modern --}}
    <div class="p-5 mb-4 rounded-xl border border-gray-200 bg-white shadow-sm hover:shadow-md transition-all">
        
        {{-- Header --}}
        <div class="flex justify-between items-start">
            <div>
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
            @endphp

            <span class="px-3 py-1 text-xs rounded-full border
                {{ $statusStyle[$task->status] ?? 'bg-gray-200 text-gray-700 border-gray-300' }}">
                {{ $task->status }}
            </span>
        </div>

        {{-- Detail --}}
        <div class="mt-4 flex items-center gap-6 text-sm text-gray-600">

            {{-- Assigned --}}
            <div class="flex items-center gap-2">
                <span class="font-semibold">👤 Assigned:</span>
                <span>{{ $task->assignedTo->name ?? 'Belum ada' }}</span>
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
        <div class="mt-4 flex justify-end">

            <a href="{{ route('tugas.edit', $task->id) }}"
               class="px-3 py-1.5 text-xs bg-gray-100 border border-gray-300 text-gray-800 rounded-lg 
                      hover:bg-blue-600 hover:text-white hover:border-blue-600 transition">
                Edit Tugas
            </a>
        </div>
    </div>

    @empty
        <p class="text-gray-500 text-sm italic mt-4">Belum ada tugas di proyek ini.</p>
    @endforelse

</div>

        {{-- Add Anggota Tim --}}
        <div class="col-span-4 bg-white p-6 rounded-2xl shadow-sm border border-gray-200">

    <h3 class="text-xl font-semibold mb-4 flex items-center gap-2">
        👥 Anggota Tim
    </h3>

    <!-- Pilihan Tambah Anggota -->
    <form action="{{ route('proyek.addMember', $project->id) }}" method="POST" class="flex gap-3 mb-6">
        @csrf

        <select 
            name="user_id"
            class="flex-1 px-4 py-2 rounded-xl border border-gray-300 bg-gray-50 
                   focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition">
            <option disabled selected>Pilih anggota...</option>
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

    <!-- Daftar Anggota -->
    <div class="space-y-3">
    @forelse ($project->anggota as $m)
        <div class="flex items-center justify-between bg-gray-50 p-3 rounded-xl border border-gray-200">
            
            <div class="flex items-center gap-3">
                <!-- Avatar otomatis -->
                <div class="w-10 h-10 rounded-full bg-indigo-200 flex items-center justify-center font-bold text-indigo-700">
                    {{ strtoupper(substr($m->name, 0, 1)) }}
                </div>

                <div>
                    <p class="font-medium text-gray-900">{{ $m->name }}</p>
                    <p class="text-gray-500 text-sm">{{ $m->pivot->role ?? 'Anggota' }}</p>
                </div>
            </div>

            <!-- Tombol hapus anggota -->
            <form action="{{ route('proyek.removeMember', [$project->id, $m->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button 
                    class="text-red-500 hover:text-red-700 text-sm font-medium">
                    Hapus
                </button>
            </form>

        </div>
    @empty
        <p class="text-gray-500 text-sm">Belum ada anggota tim.</p>
    @endforelse
</div>
                 
</div>


    </div>

    {{-- Komentar --}}
    <div class="bg-white p-5 rounded-xl shadow mt-6">
        <h3 class="text-lg font-semibold mb-4">Komentar</h3>

@foreach ($project->komentar as $c)
    <div class="mb-3">
        <p class="font-medium">{{ $c->user->name }}</p>
        <p class="text-gray-600">{{ $c->isi_komentar }}</p>
    </div>
@endforeach

        <form method="POST" action="{{ route('proyek.komentar.store', $project->id) }}">
    @csrf
    <div class="flex gap-3 mt-3">
        <input type="text" name="isi_komentar" 
               class="flex-1 p-3 bg-gray-100 rounded-lg"
               placeholder="Tulis komentar...">

        <button class="px-4 py-2 bg-black text-white rounded-lg">
            Kirim
        </button>
    </div>
</form>
    </div>

</div>
@endsection
