@extends('layout.main')

@section('title', 'Kerja.in')

@section('content')

<!-- CREAM FULL SECTION -->
<section class="w-full bg-[#EAE4C9] pb-36 pt-8">

    <!-- NAVBAR -->
    <nav class="max-w-7xl mx-auto flex justify-between items-center px-8">
        <div class="flex items-center gap-3">
            <img src="/icons/Logo.svg" class="w-10 h-10" alt="">
            <span class="text-2xl text-color [#E5E3E3] font-bold">Kerja.in</span>
        </div>

        <div class="flex items-center gap-10 text-lg font-semibold">
            <a href="{{ route('login') }}" class="pb-1 border-b-2 border-transparent hover:border-black transition">
                Login
            </a>
            <a href="{{ route('register') }}" class="pb-1 border-b-2 border-transparent hover:border-black transition">
                Register
            </a>
        </div>
    </nav>

    <!-- HERO TITLE -->
    <div class="text-center mt-20 px-6">
        <h1 class="text-4xl md:text-5xl font-bold leading-snug max-w-3xl mx-auto text-[#1e1e1e]">
            Mulai catat tugasmu di sini <br>
            untuk hari yang lebih rapi dan <br>
            produktif
        </h1>
    </div>

</section>


<!-- BLACK ROUNDED SECTION -->
<section class="relative w-full bg-[#1E181B] rounded-t-[150px] px-6 pt-32 pb-24">

    <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-16">

        <!-- CARD TUGAS -->
    <div class="w-[280px] h-[280px] bg-[#EAE4C9] rounded-2xl 
       flex flex-col items-center justify-start 
       pt-10 gap-4 cursor-pointer
       transition-all duration-300 transform
       hover:-translate-y-3 hover:scale-[1.03]">

    <!-- ICON (pastel) -->
    <div class="w-14 h-14 rounded-full bg-[#e8edff] flex items-center justify-center">
        <img src="/icons/TotalTugasIcon.svg" class="w-6 h-6 opacity-80" />
    </div>

    <!-- TITLE -->
    <h3 class="font-poppins text-2xl font-bold text-black">Tugas Saya</h3>

    <!-- SUBTEXT -->
    <p class="text-center text-[15px] leading-[20px] text-gray-700">
        Taklukkan Hari,<br>
        Satu Checklist<br>
        Selesai
    </p>

</div>

        <!-- CARD PROYEK -->
    <div class="w-[280px] h-[280px] bg-[#EAE4C9] rounded-2xl 
       flex flex-col items-center justify-self-end
       pt-10 gap-4 cursor-pointer
       transition-all duration-300 transform
       hover:-translate-y-3 hover:scale-[1.03] ">

    <div class="w-14 h-14 rounded-full bg-[#ffe3f6] flex items-center justify-center">
        <img src="/icons/Icon.svg" class="w-6 h-6 opacity-80" />
    </div>

    <h3 class="text-xl font-bold text-black">Proyek</h3>

    <p class="text-center text-[15px] leading-[20px] text-gray-700">
        Wujudkan Hasil<br>
        Terbaik<br>
        Bersama Tim
    </p>

</div>


    </div>

</section>

@endsection
