@if ($errors->any())
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
        <p class="font-bold">Terjadi Kesalahan</p>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">Detail User</h3>
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div>
        <label for="cKode" class="block text-gray-700 text-sm font-bold mb-2">Kode User:</label>
        <input type="text" name="cKode" id="cKode" value="{{ old('cKode', $user->cKode ?? '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
    </div>
    <div>
        <label for="cName" class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap:</label>
        <input type="text" name="cName" id="cName" value="{{ old('cName', $user->cName ?? '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
    </div>
    <div>
        <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username:</label>
        <input type="text" name="username" id="username" value="{{ old('username', $user->username ?? '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
    </div>
</div>

<h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">Password</h3>
<p class="text-sm text-gray-500 mb-4">Kosongkan jika tidak ingin mengubah password.</p>
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div>
        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password Baru:</label>
        <input type="password" name="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
    </div>
    <div>
        <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Konfirmasi Password:</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
    </div>
</div>

<h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">Assign Roles</h3>
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    @foreach ($roles as $role)
    <label class="flex items-center space-x-2">
        <input type="checkbox" name="roles[]" value="{{ $role->id }}" class="form-checkbox h-5 w-5 text-blue-600"
               {{ (isset($userRoles) && in_array($role->id, $userRoles)) ? 'checked' : '' }}>
        <span class="text-gray-700">{{ $role->cName }}</span>
    </label>
    @endforeach
</div>