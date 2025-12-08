
@extends('layout.app', ['pageTitle' => 'Dashboard'])

@section('content')

<div class="space-y-12">    
<h2 class="text-2xl font-semibold">
    Halo {{ Auth::user()->name }}! 💪  
    <span class="block text-gray-500 text-lg">Ayo selesaikan targetmu satu per satu!</span>
</h2>

    <!-- GRID 2x2 -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-8 mt-8">

        <!-- CARD TOTAL TUGAS -->
        <div class="bg-white rounded-2xl p-6 shadow-[0_4px_12px_rgba(0,0,0,0.1)]
       transition-all duration-300 transform hover:-translate-y-2 hover:shadow-xl">

            <div class="flex items-center gap-6">

                <div class="w-16 h-16 bg-[#e8edff] rounded-full flex items-center justify-center">
                    <img src="/icons/TotalTugasIcon.svg"class="w-8 opacity-80">
                </div>

                <div class="flex flex-col">
                    <span class="text-4xl font-bold font-poppins">{{ $totalTugas }}</span>
                    <span class="text-gray-700 font-medium text-lg">Total Tugas</span>
                </div>

            </div>
        </div>

        <!-- CARD TUGAS SELESAI-->
        <div class="bg-white rounded-2xl p-6 shadow-[0_4px_12px_rgba(0,0,0,0.1)]
        transition-all duration-300 transform hover:-translate-y-2 hover:shadow-xl">

            <div class="flex items-center gap-6">

                <div class="w-16 h-16 bg-[#d7ffd6] rounded-full flex items-center justify-center">
                    <img src="/icons/Done.svg" class="w-10 opacity-80">
                </div>

                <div class="flex flex-col">
                    <span class="text-4xl font-bold font-poppins">{{ $tugasSelesai }}</span>
                    <span class="text-gray-700 font-medium text-lg">Tugas Selesai</span>
                </div>

            </div>
        </div>

        <!-- CARD MENDEKATI DEADLINE-->
        <div class="bg-white rounded-2xl p-6 shadow-[0_4px_12px_rgba(0,0,0,0.1)]
        transition-all duration-300 transform hover:-translate-y-2 hover:shadow-xl">

            <div class="flex items-center gap-6">

                <div class="w-16 h-16 bg-[#fff0bd] rounded-full flex items-center justify-center">
                    <img src="/icons/Group.svg" class="w-8 opacity-80">
                </div>

                <div class="flex flex-col">
                    <span class="text-4xl font-bold font-poppins">{{ $deadlineDekat }}</span>
                    <span class="text-gray-700 font-medium text-lg">Mendekati Deadline</span>

                </div>

            </div>
        </div>

        <!-- CARD PROYEK AKTIF-->
        <div class="bg-white rounded-2xl p-6 shadow-[0_4px_12px_rgba(0,0,0,0.1)]
        transition-all duration-300 transform hover:-translate-y-2 hover:shadow-xl">

            <div class="flex items-center gap-6">

                <div class="w-16 h-16 bg-[#ffe3f6] rounded-full flex items-center justify-center">
                    <img src="/icons/Icon.svg" class="w-8 opacity-80">
                </div>

                <div class="flex flex-col">
                    <span class="text-4xl font-bold font-poppins">{{ $proyekAktif }}</span>
                    <span class="text-gray-700 font-medium text-lg">Proyek Aktif</span>
                </div>

            </div>
        </div>

    </div>


  
<!-- LIST TUGAS TERBARU -->
<div class="bg-white p-6 rounded-3xl shadow-lg mt-10">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold">Tugas Terbaru</h2>
        <a href="/tugas" class="text-blue-600 hover:text-blue-800 text-sm">Lihat Semua</a>
    </div>

    <div class="space-y-4">
        @foreach ($tugas as $item)
            <div class="flex items-center justify-between p-4 bg-gray-50 hover:bg-gray-100 rounded-xl transition">
                <!-- LEFT -->
                <div class="flex gap-4">
                    <input type="checkbox" class="w-5 h-5 mt-1">
                    <div>
                        <p class="font-semibold text-lg">{{ $item->judul }}</p>
                        <p class="text-sm text-gray-600">
                            Status: <span class="font-medium">{{ $item->status }}</span>
                            • Deadline: <span class="font-medium">{{ $item->deadline }}</span>
                        </p>
                    </div>
                </div>

                <!-- RIGHT -->
            </div>
        @endforeach
    </div>
</div>
</div>

@endsection
