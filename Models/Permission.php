<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\RolePermission;

class Permission extends Model
{
    use HasFactory;
    public function roles_permissions()
    {
        return $this->hasMany(RolePermission::class);
    }
}
