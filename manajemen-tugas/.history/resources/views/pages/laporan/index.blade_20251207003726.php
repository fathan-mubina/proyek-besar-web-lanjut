@extends('layout.app', ['pageTitle' => 'Laporan'])

@section('content')

<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900">Laporan Aktivitas 📊</h1>
    <p class="text-gray-600 mt-2">Ringkasan performa tugas dan proyek Anda</p>
</div>

{{-- STATISTIK CARDS --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

    {{-- Total Tugas --}}
    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-lg p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-blue-100 text-sm font-medium">Total Tugas</p>
                <h3 class="text-3xl font-bold mt-2">{{ $totalTugas }}</h3>
            </div>
            <div class="bg-white/20 rounded-full p-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>
        </div>
    </div>

    {{-- Tugas Selesai --}}
    <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl shadow-lg p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-green-100 text-sm font-medium">Tugas Selesai</p>
                <h3 class="text-3xl font-bold mt-2">{{ $tugasSelesai }}</h3>
                @if($totalTugas > 0)
                    <p class="text-green-100 text-xs mt-1">{{ round(($tugasSelesai / $totalTugas) * 100) }}% dari total</p>
                @endif
            </div>
            <div class="bg-white/20 rounded-full p-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
    </div>

    {{-- Tugas Proses --}}
    <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-2xl shadow-lg p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-yellow-100 text-sm font-medium">Dalam Proses</p>
                <h3 class="text-3xl font-bold mt-2">{{ $tugasProses }}</h3>
            </div>
            <div class="bg-white/20 rounded-full p-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
    </div>

    {{-- Tugas Terlambat --}}
    <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-2xl shadow-lg p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-red-100 text-sm font-medium">Terlambat</p>
                <h3 class="text-3xl font-bold mt-2">{{ $tugasTerlambat }}</h3>
            </div>
            <div class="bg-white/20 rounded-full p-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
        </div>
    </div>

</div>

{{-- DETAIL STATISTIK --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

    {{-- Status Breakdown --}}
    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-200">
        <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
            Status Tugas
        </h3>

        <div class="space-y-3">
            {{-- Belum Mulai --}}
            <div class="flex items-center justify-between p-3 bg-red-50 rounded-xl">
                <div class="flex items-center gap-3">
                    <div class="w-3 h-3 rounded-full bg-red-500"></div>
                    <span class="font-medium text-gray-700">Belum Mulai</span>
                </div>
                <span class="font-bold text-red-600">{{ $tugasBelumMulai }}</span>
            </div>

            {{-- Proses --}}
            <div class="flex items-center justify-between p-3 bg-yellow-50 rounded-xl">
                <div class="flex items-center gap-3">
                    <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                    <span class="font-medium text-gray-700">Dalam Proses</span>
                </div>
                <span class="font-bold text-yellow-600">{{ $tugasProses }}</span>
            </div>

            {{-- Selesai --}}
            <div class="flex items-center justify-between p-3 bg-green-50 rounded-xl">
                <div class="flex items-center gap-3">
                    <div class="w-3 h-3 rounded-full bg-green-500"></div>
                    <span class="font-medium text-gray-700">Selesai</span>
                </div>
                <span class="font-bold text-green-600">{{ $tugasSelesai }}</span>
            </div>
        </div>
    </div>

    {{-- Statistik Proyek --}}
    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-200">
        <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
            </svg>
            Statistik Proyek
        </h3>

        <div class="space-y-4">
            <div class="flex items-center justify-between p-4 bg-purple-50 rounded-xl">
                <span class="font-medium text-gray-700">Total Proyek</span>
                <span class="text-2xl font-bold text-purple-600">{{ $totalProyek }}</span>
            </div>

            <div class="flex items-center justify-between p-4 bg-green-50 rounded-xl">
                <span class="font-medium text-gray-700">Proyek Selesai</span>
                <span class="text-2xl font-bold text-green-600">{{ $proyekSelesai }}</span>
            </div>

            <div class="flex items-center justify-between p-4 bg-blue-50 rounded-xl">
                <span class="font-medium text-gray-700">Proyek Aktif</span>
                <span class="text-2xl font-bold text-blue-600">{{ $totalProyek - $proyekSelesai }}</span>
            </div>
        </div>
    </div>

</div>

{{-- TUGAS PER KATEGORI --}}
@if($tugasPerKategori->count() > 0)
<div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-200">
    <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
        </svg>
        Tugas per Kategori
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($tugasPerKategori as $kategori => $jumlah)
            <div class="p-4 bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-xl border border-indigo-200">
                <p class="text-sm text-indigo-700 font-medium mb-1">{{ $kategori ?: 'Tanpa Kategori' }}</p>
                <p class="text-2xl font-bold text-indigo-900">{{ $jumlah }} tugas</p>
            </div>
        @endforeach
    </div>
</div>
@endif

{{-- PERFORMANCE SUMMARY --}}
<div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl shadow-lg p-8 mt-8 text-white">
    <div class="flex items-center justify-between">
        <div>
            <h3 class="text-2xl font-bold mb-2">Performa Keseluruhan</h3>
            <p class="text-blue-100">
                @if($totalTugas > 0)
                    Anda telah menyelesaikan {{ $tugasSelesai }} dari {{ $totalTugas }} tugas
                    ({{ round(($tugasSelesai / $totalTugas) * 100, 1) }}%)
                @else
                    Belum ada tugas yang tercatat
                @endif
            </p>

            @if($tugasTerlambat > 0)
                <p class="text-red-200 mt-2 font-medium">
                    ⚠️ {{ $tugasTerlambat }} tugas melewati deadline
                </p>
            @endif
        </div>

        <div class="hidden md:block">
            @if($totalTugas > 0)
                <div class="text-center">
                    <div class="text-5xl font-bold">{{ round(($tugasSelesai / $totalTugas) * 100) }}%</div>
                    <div class="text-blue-100 text-sm mt-1">Completion Rate</div>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- ACTION BUTTONS --}}
<div class="mt-8 flex justify-center gap-4">
    <a href="{{ route('tugas.index') }}"
       class="px-6 py-3 bg-black text-white rounded-xl shadow-lg hover:bg-gray-800 transition font-medium">
        Lihat Semua Tugas
    </a>
    <a href="{{ route('proyek.index') }}"
       class="px-6 py-3 bg-white border-2 border-black text-black rounded-xl shadow-lg hover:bg-gray-100 transition font-medium">
        Lihat Semua Proyek
    </a>
</div>

@endsection
