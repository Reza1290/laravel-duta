@extends('layouts.app')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-700">Daftar Pengguna</h1>
</div>
@include('partials.alerts')
<div class="bg-white shadow-md rounded-lg overflow-x-auto">
    <table class="min-w-full leading-normal">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase">Nama</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase">Username</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase">Roles</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
            <tr class="hover:bg-gray-50">
                <td class="px-5 py-4 border-b border-gray-200 text-sm">{{ $user->cName }}</td>
                <td class="px-5 py-4 border-b border-gray-200 text-sm">{{ $user->username }}</td>
                <td class="px-5 py-4 border-b border-gray-200 text-sm">
                    @forelse($user->roles as $role)
                        <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">{{ $role->cName }}</span>
                    @empty
                        -
                    @endforelse
                </td>
                <td class="px-5 py-4 border-b border-gray-200 text-sm">
                    <a href="{{ route('users.edit', $user->id) }}" class="text-indigo-600 hover:text-indigo-900">Assign Roles / Edit</a>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="text-center py-10 text-gray-500">Tidak ada data.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection