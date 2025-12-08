@extends('layout.app', ['pageTitle' => 'Tugas'])

@section('content')

<div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold text-gray-900">
        Daftar Tugas Kamu 🚀
    </h1>

    <a href="{{ route('tugas.create') }}"
       class="px-4 py-2 bg-black text-white rounded-lg shadow hover:bg-gray-800 font-medium">
        + Tambah Tugas
    </a>
</div>

{{-- SUCCESS MESSAGE --}}
@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
        {{ session('success') }}
    </div>
@endif

<div class="space-y-6">

    @forelse ($tugas as $item)
        <div class="bg-white rounded-xl shadow p-5 border border-gray-200">

            <!-- TOP ROW -->
            <div class="flex justify-between items-start">

                <!-- LEFT -->
                <div class="flex-1">
                    <p class="font-semibold text-lg">{{ $item->judul }}</p>
                    <p class="text-gray-600 text-sm mt-1">{{ $item->deskripsi }}</p>

                    <!-- Tanggal & Kategori -->
                    <div class="flex items-center gap-4 mt-3 text-gray-500 text-sm">
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            {{ \Carbon\Carbon::parse($item->tanggal_deadline)->format('d F Y') }}
                        </div>

                        @if($item->category)
                            <div class="flex items-center gap-2 bg-gray-100 px-3 py-1 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                                {{ $item->category->nama_kategori }}
                            </div>
                        @endif
                    </div>
                </div>

                <!-- STATUS + BUTTONS -->
                <div class="flex flex-col items-end gap-2">

                    {{-- BADGE STATUS --}}
                    @php
                        $statusColor = [
                            'Belum Mulai' => 'bg-red-100 text-red-600',
                            'Sedang'      => 'bg-yellow-100 text-yellow-700',
                            'Proses'      => 'bg-blue-100 text-blue-600',
                            'Selesai'     => 'bg-green-100 text-green-700',
                        ];

                        $prioritasColor = [
                            'rendah' => 'bg-gray-100 text-gray-600',
                            'sedang' => 'bg-orange-100 text-orange-600',
                            'tinggi' => 'bg-red-100 text-red-600',
                        ];
                    @endphp

                    <span class="px-3 py-1 text-xs rounded-lg font-medium
                        {{ $statusColor[$item->status] ?? 'bg-gray-100 text-gray-600' }}">
                        {{ $item->status }}
                    </span>

                    {{-- BADGE PRIORITAS --}}
                    <span class="px-3 py-1 text-xs rounded-lg font-medium
                        {{ $prioritasColor[$item->prioritas] ?? 'bg-gray-100 text-gray-600' }}">
                        {{ ucfirst($item->prioritas) }}
                    </span>

                    {{-- BADGE TUGAS PROYEK --}}
                    @if ($item->project)
                        <a href="{{ route('proyek.detail', $item->project_id) }}"
                           class="inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-gradient-to-r from-purple-500/10 to-purple-500/20 border border-purple-300 text-purple-700 text-xs font-semibold hover:from-purple-500/20 hover:to-purple-500/30 transition-all duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" class="w-4 h-4">
                                <path d="M2 4a2 2 0 012-2h4l2 2h6a2 2 0 012 2v2H2V4zm18 4v8a2 2 0 01-2 2H4a2 2 0 01-2-2V8h18z"/>
                            </svg>
                            Proyek: <span class="font-bold">{{ $item->project->nama }}</span>
                        </a>
                    @endif

                    {{-- ACTION BUTTONS --}}
                    <div class="flex gap-2 mt-2">
                        <button onclick="openDeleteModal({{ $item->id }})"
                                class="px-3 py-1 text-xs bg-red-500 hover:bg-red-600 text-white rounded-lg shadow">
                            Hapus
                        </button>

                        <a href="{{ route('tugas.edit', $item->id) }}"
                           class="px-3 py-1 text-xs bg-blue-500 hover:bg-blue-600 text-white rounded-lg shadow">
                            Edit
                        </a>
                    </div>

                </div>
            </div>
        </div>
    @empty
        <div class="bg-gray-100 rounded-xl p-8 text-center">
            <p class="text-gray-500 mb-4">Belum ada tugas. Yuk buat tugas pertamamu! 🎯</p>
            <a href="{{ route('tugas.create') }}"
               class="inline-block px-6 py-2 bg-black text-white rounded-lg hover:bg-gray-800">
                + Tambah Tugas
            </a>
        </div>
    @endforelse

</div>

{{-- DELETE MODAL --}}
<div id="deleteModal"
     class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-white p-6 rounded-2xl shadow-xl w-80 text-center">

        <h2 class="text-lg font-semibold mb-2">Hapus Tugas?</h2>
        <p class="text-gray-600 text-sm mb-6">
            Tugas yang dihapus tidak dapat dikembalikan.
        </p>

        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')

            <div class="flex justify-center gap-3">
                <button type="button"
                        onclick="closeDeleteModal()"
                        class="px-6 py-2 rounded-xl bg-gray-300 hover:bg-gray-400">
                    Batal
                </button>

                <button type="submit"
                        class="px-6 py-2 rounded-xl bg-red-600 text-white hover:bg-red-700">
                    Hapus
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openDeleteModal(id) {
    const form = document.getElementById('deleteForm');
    form.action = "/tugas/" + id;

    const modal = document.getElementById('deleteModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeDeleteModal() {
    const modal = document.getElementById('deleteModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
</script>

@endsection
