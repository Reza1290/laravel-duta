@if ($errors->any())
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="mb-4">
    <label for="cKode" class="block text-gray-700 text-sm font-bold mb-2">Kode:</label>
    <input type="text" name="cKode" id="cKode" value="{{ old('cKode', $permission->cKode ?? '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
</div>
<div class="mb-4">
    <label for="cName" class="block text-gray-700 text-sm font-bold mb-2">Nama Permission:</label>
    <input type="text" name="cName" id="cName" value="{{ old('cName', $permission->cName ?? '') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
</div>
<div class="mb-6">
    <label for="menu_id" class="block text-gray-700 text-sm font-bold mb-2">Menu:</label>
    <select name="menu_id" id="menu_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
        <option value="">Pilih Menu</option>
        @foreach($menus as $menu)
            <option value="{{ $menu->id }}" {{ (old('menu_id', $permission->menu_id ?? '') == $menu->id) ? 'selected' : '' }}>
                {{ $menu->cName }}
            </option>
        @endforeach
    </select>
</div>