@extends('layout.app', ['pageTitle' => 'Edit Profil'])

@section('content')

<div class="max-w-2xl bg-white p-8 rounded-2xl shadow">

    <h2 class="text-xl font-semibold mb-6">Edit Profil</h2>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('profil.update') }}" method="POST">
    @csrf
    @method('PUT')

        {{-- NAMA --}}
        <div class="mb-5">
            <label class="block text-gray-700 font-medium mb-1">Nama Lengkap</label>
            <input type="text" name="name" value="{{ $user->name }}"
                class="w-full border rounded-lg px-4 py-2" required>
        </div>

        {{-- EMAIL --}}
        <div class="mb-5">
            <label class="block text-gray-700 font-medium mb-1">Email</label>
            <input type="email" name="email" value="{{ $user->email }}"
                class="w-full border rounded-lg px-4 py-2" required>
        </div>

        {{-- PASSWORD BARU --}}
        <div class="mb-5">
            <label class="block text-gray-700 font-medium mb-1">Password Baru (opsional)</label>
            <input type="password" name="password"
                class="w-full border rounded-lg px-4 py-2"
                placeholder="Kosongkan jika tidak ingin mengubah">
        </div>

        <div class="flex justify-end gap-3 mt-6">
            <a href="{{ route('profil.index') }}"
                class="px-4 py-2 border rounded-lg">Batal</a>

            <button class="px-4 py-2 bg-[#E5E3E3] ext-black rounded-lg shadow hover:bg-gray-300 font-medium">
                Simpan
            </button>
        </div>

    </form>
</div>

@endsection
