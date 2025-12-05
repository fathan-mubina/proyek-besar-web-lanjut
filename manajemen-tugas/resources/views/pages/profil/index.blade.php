@extends('layout.app', ['pageTitle' => 'Profil'])


@section('content')

<div class="space-y-10">
    <h1 class="text-3xl font-bold text-gray-900">
        Profil Kamu 😄✨
    </h1>



    {{-- BARIS ATAS: Informasi Profil & Foto --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        {{-- KARTU INFORMASI --}}
        <div class="bg-white p-8 rounded-2xl shadow">
            
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-semibold">Informasi Profil</h3>
        
            </div>

            <div class="space-y-4">

                <div>
                    <p class="text-gray-600 text-sm">Nama Lengkap</p>
                    <p class="font-medium">{{ $user->name }}</p>
                </div>

                <div>
                    <p class="text-gray-600 text-sm">Email</p>
                    <p class="font-medium">{{ $user->email }}</p>
                </div>

                <div>
                    <p class="text-gray-600 text-sm">Tanggal Bergabung</p>
                    <p class="font-medium">
                        {{ $user->created_at->translatedFormat('d F Y') }}
                    </p>
                </div>

            </div>

        </div>

        {{-- KARTU FOTO --}}
<div class="bg-white p-8 rounded-2xl shadow flex flex-col items-center">

    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&size=200"
        class="rounded-full w-40 mb-4">

    <p class="text-lg font-semibold mb-6">{{ $user->name }}</p>

   <div class="w-full flex flex-col items-center gap-3 mt-4">

    {{-- EDIT PROFIL --}}
    <a href="{{ route('profil.edit') }}"
        class="
            px-6 py-2 
            bg-[#E5E3E3] hover:bg-blue-600
            text-black font-medium 
            rounded-lg shadow 
            transition duration-200
        ">
        Edit Profil
    </a>

    {{-- LOGOUT --}}
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button 
            class="
                px-6 py-2 
                bg-[#E5E3E3] hover:bg-red-600 
                text-black font-medium 
                rounded-lg shadow
                transition duration-200
            ">
            Logout
        </button>
    </form>

</div>


</div>

</div>

@endsection