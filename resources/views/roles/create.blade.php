@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold text-gray-700 mb-6">Buat Role Baru</h1>

<div class="bg-white shadow-md rounded-lg p-6">
    <form action="{{ route('roles.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="cKode" class="block text-gray-700 text-sm font-bold mb-2">Kode Role:</label>
            <input type="text" name="cKode" id="cKode" value="{{ old('cKode') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('cKode') border-red-500 @enderror" required>
            @error('cKode') <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="cName" class="block text-gray-700 text-sm font-bold mb-2">Nama Role:</label>
            <input type="text" name="cName" id="cName" value="{{ old('cName') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('cName') border-red-500 @enderror" required>
            @error('cName') <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Hak Akses (Permissions):</label>
            <div class="space-y-4">
                @foreach ($permissions as $menuName => $menuPermissions)
                <div class="border rounded-lg p-4">
                    <h3 class="font-semibold text-gray-800 border-b pb-2 mb-3">{{ $menuName }}</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                        @foreach ($menuPermissions as $permission)
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" class="form-checkbox h-5 w-5 text-blue-600">
                            <span class="text-gray-700">{{ $permission->cName }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
            @error('permissions') <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center justify-end">
            <a href="{{ route('roles.index') }}" class="text-gray-600 hover:text-gray-800 mr-4">Batal</a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection