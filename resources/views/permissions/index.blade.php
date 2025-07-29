@extends('layouts.app')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-700">Daftar Hak Akses (Permission)</h1>
    <a href="{{ route('permissions.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
        Buat Permission Baru
    </a>
</div>
@include('partials.alerts')
<div class="bg-white shadow-md rounded-lg overflow-x-auto">
    <table class="min-w-full leading-normal">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase">Kode</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase">Nama Permission</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase">Menu</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($permissions as $permission)
            <tr class="hover:bg-gray-50">
                <td class="px-5 py-4 border-b border-gray-200 text-sm">{{ $permission->cKode }}</td>
                <td class="px-5 py-4 border-b border-gray-200 text-sm">{{ $permission->cName }}</td>
                <td class="px-5 py-4 border-b border-gray-200 text-sm">
                    <span class="bg-gray-200 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded-full">{{ $permission->menu->cName }}</span>
                </td>
                <td class="px-5 py-4 border-b border-gray-200 text-sm">
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('permissions.edit', $permission->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center py-10 text-gray-500">Tidak ada data.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection