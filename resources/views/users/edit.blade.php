@extends('layouts.app')
@section('content')
<h1 class="text-2xl font-bold text-gray-700 mb-6">Edit User & Assign Roles</h1>
<div class="bg-white shadow-md rounded-lg p-6">
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('users.form-fields', ['user' => $user])
        <div class="flex items-center justify-end">
            <a href="{{ route('users.index') }}" class="text-gray-600 hover:text-gray-800 mr-4">Batal</a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">Perbarui</button>
        </div>
    </form>
</div>
@endsection