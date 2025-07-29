@extends('layouts.app') <!-- Menggunakan layout utama yang sudah ada -->

@section('content')
<div class="bg-white shadow-md rounded-lg p-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-2">Dashboard</h1>
    <p class="text-lg text-gray-600 mb-6">Selamat datang kembali, <span class="font-semibold">{{ $user->cName }}</span>!</p>

    <div class="border-t pt-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Informasi Akun Anda</h2>
        <div class="text-gray-700 space-y-2">
            <p><strong>Username:</strong> {{ $user->username }}</p>
            <p><strong>Kode User:</strong> {{ $user->cKode }}</p>
            <p><strong>Role/Jabatan:</strong>
                @forelse ($user->roles as $role)
                <span class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded-full">{{ $role->cName }}</span>
                @empty
                <span class="bg-gray-100 text-gray-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded-full">Tidak ada role</span>
                @endforelse
            </p>
        </div>

        <div class="mt-8">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg">
                    Logout
                </button>
            </form>
        </div>
    </div>
</div>
@endsection