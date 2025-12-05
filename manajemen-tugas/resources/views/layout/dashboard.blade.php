<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

        <!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body class="font-inter bg-[#ece7ce]">

    <!-- SIDEBAR -->
    <div class="fixed top-0 left-0 h-full w-[250px] bg-[#1E181B] text-white p-6 z-30">
        <h1 class="text-3xl font-bold mb-10 font-poppins">Kerja.in</h1>

        <ul class="flex flex-col gap-4 text-[17px] font-medium">

            <li><a href="/dashboard" class="hover:opacity-75">Dashboard</a></li>
            <li><a href="/tugas" class="hover:opacity-75">Tugas</a></li>
            <li><a href="/proyek" class="hover:opacity-75">Proyek</a></li>
            <li><a href="/kategori" class="hover:opacity-75">Kategori</a></li>
            <li><a href="/laporan" class="hover:opacity-75">Laporan</a></li>
            <li><a href="/pengingat" class="hover:opacity-75">Pengingat</a></li>
            <li><a href="/lampiran" class="hover:opacity-75">Lampiran</a></li>
            <li><a href="/profil" class="hover:opacity-75">Profil</a></li>

        </ul>
    </div>

    <!-- HEADER -->
   <div class="text-white">
    {{ Auth::user()->name }}
   </div>


    <!-- CONTENT -->
    <div class="ml-[250px] mt-[80px] p-10 max-w-[1200px] mx-auto">
        @yield('content')
    </div>

</body>
</html>
