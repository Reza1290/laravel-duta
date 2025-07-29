<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $permissionName, string $menuSlug)
    {
        
        $menuName = ($menuSlug === 'cash/bank') ? 'Cash/Bank' : ucfirst($menuSlug);
        
        if (!Auth::user()->hasPermissionTo($permissionName, $menuName)) {
            abort(403, 'AKSES DITOLAK: ANDA TIDAK MEMILIKI HAK AKSES.');
        }

        return $next($request);
    }
}
