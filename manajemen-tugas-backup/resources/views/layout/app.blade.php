<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Kerja.in' }}</title>

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="bg-[#EEEBD9] overflow-x-hidden">
<div class="min-h-screen flex overflow-hidden">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-[#282427] text-white flex-shrink-0">
        <div class="p-6 text-2xl font-bold">Kerja.in</div>

        <nav class="px-4 space-y-2">
            <a href="/dashboard" class="nav-item text-white">🏠 Dashboard</a>
            <a href="/tugas" class="nav-item text-white">📝 Tugas</a>
            <a href="/proyek" class="nav-item text-white">📁 Proyek</a>
            <a href="/kategori" class="nav-item text-white">🏷️ Kategori</a>
            <a href="/laporan" class="nav-item text-white">📄 Laporan</a>
            <a href="/pengingat" class="nav-item text-white">🔔 Pengingat</a>
            <a href="/lampiran" class="nav-item text-white">📎 Lampiran</a>
            <a href="/profil" class="nav-item text-white">👤 Profil</a>
        </nav>
    </aside>

    {{-- MAIN CONTENT AREA --}}
    <div class="flex-1 flex flex-col overflow-hidden">

        {{-- NAVBAR --}}
        <header class="bg-[#282427] text-white px-6 py-4 flex justify-between items-center shadow w-full box-border">
            <h1 class="text-xl font-semibold">{{ $pageTitle ?? '' }}</h1>
            <div>
             
        </header>
        {{-- PAGE CONTENT --}}
        <main class="flex-1 overflow-y-auto p-8">
            @yield('content')
        </main>

    </div>

</div>

</body>
</html>
