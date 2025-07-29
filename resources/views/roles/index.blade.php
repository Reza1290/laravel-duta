@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-700">Daftar Role</h1>
    <a href="{{ route('roles.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
        Buat Role Baru
    </a>
</div>

@if (session('success'))
<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
    <span class="block sm:inline">{{ session('success') }}</span>
</div>
@endif
@if (session('error'))
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
    <span class="block sm:inline">{{ session('error') }}</span>
</div>
@endif

<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <table class="min-w-full leading-normal">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kode</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Role</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Jumlah Hak Akses</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($roles as $role)
            <tr class="hover:bg-gray-50">
                <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm">{{ $role->cKode }}</td>
                <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm">{{ $role->cName }}</td>
                <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm">{{ $role->permissions_count }}</td>
                <td class="px-5 py-4 border-b border-gray-200 bg-white text-sm">
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('roles.edit', $role->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus role ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center py-10 text-gray-500">Tidak ada data role.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
        {{ $roles->links() }}
    </div>
</div>
@endsection