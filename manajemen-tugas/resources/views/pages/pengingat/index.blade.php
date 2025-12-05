@extends('layout.app', ['pageTitle' => $pageTitle])

@section('content')

<div class="max-w-3xl">

    <h2 class="text-xl font-semibold mb-4">Pengingat</h2>

    <div class="divide-y">

        @foreach ($pengingat as $item)
        <div class="py-4">
            <p class="font-semibold text-[15px]">{{ $item['tanggal'] }}</p>
            <p class="text-gray-600 text-sm">{{ $item['judul'] }}</p>
        </div>
        @endforeach

    </div>

</div>

@endsection
