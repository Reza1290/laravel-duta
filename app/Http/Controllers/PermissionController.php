<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::with('menu')->latest()->paginate(15);
        return view('permissions.index', compact('permissions'));
    }

    public function create()
    {
        $menus = Menu::all();
        return view('permissions.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cKode' => 'required|string|max:255|unique:permissions,cKode',
            'cName' => 'required|string|max:255',
            'menu_id' => 'required|exists:menus,id',
        ]);

        $isExists = Permission::where('cName', $request->cName)
                                ->where('menu_id', $request->menu_id)
                                ->exists();

        if ($isExists) {
            return back()->withInput()->withErrors(['cName' => 'Nama permission sudah ada untuk menu ini.']);
        }

        Permission::create($request->all());

        return redirect()->route('permissions.index')->with('success', 'Permission berhasil dibuat.');
    }

    public function edit(Permission $permission)
    {
        $menus = Menu::all();
        return view('permissions.edit', compact('permission', 'menus'));
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'cKode' => ['required', 'string', 'max:255', Rule::unique('permissions')->ignore($permission->id)],
            'cName' => 'required|string|max:255',
            'menu_id' => 'required|exists:menus,id',
        ]);

        $isExists = Permission::where('cName', $request->cName)
                                ->where('menu_id', $request->menu_id)
                                ->where('id', '!=', $permission->id)
                                ->exists();
        
        if ($isExists) {
            return back()->withInput()->withErrors(['cName' => 'Nama permission sudah ada untuk menu ini.']);
        }

        $permission->update($request->all());

        return redirect()->route('permissions.index')->with('success', 'Permission berhasil diperbarui.');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('permissions.index')->with('success', 'Permission berhasil dihapus.');
    }
}
