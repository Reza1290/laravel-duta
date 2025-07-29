@extends('layouts.app')
@section('content')
<h1 class="text-2xl font-bold text-gray-700 mb-6">Edit Permission</h1>
<div class="bg-white shadow-md rounded-lg p-6">
    <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('permissions.form-fields', ['permission' => $permission])
        <div class="flex items-center justify-end">
            <a href="{{ route('permissions.index') }}" class="text-gray-600 hover:text-gray-800 mr-4">Batal</a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">Perbarui</button>
        </div>
    </form>
</div>
@endsection