<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['cKode', 'cName','username',
        'password'];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }


    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }


    public function hasRole($roleName)
    {
        return $this->roles->contains('cName', $roleName);
    }

    public function hasPermissionTo(string $permissionName, string $menuName): bool
    {
        foreach ($this->roles as $role) {
            $hasPermission = $role->permissions()
                ->where('cName', $permissionName)
                ->whereHas('menu', function ($query) use ($menuName) {
                    $query->where('cName', $menuName);
                })
                ->exists();

            if ($hasPermission) {
                return true;
            }
        }

        return false;
    }
}
