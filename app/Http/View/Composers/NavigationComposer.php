<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu;

class NavigationComposer
{
   
    public function compose(View $view)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $userPermissionIds = $user->roles()->with('permissions')->get()
                ->pluck('permissions')->flatten()->pluck('id')->unique();

            $accessibleMenus = Menu::whereHas('permissions', function ($query) use ($userPermissionIds) {
                $query->whereIn('id', $userPermissionIds);
            })->orderBy('cKode')->get();

            $view->with('dynamicMenus', $accessibleMenus);
        } else {
            $view->with('dynamicMenus', collect());
        }
    }
}
