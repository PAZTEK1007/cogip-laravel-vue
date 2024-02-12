<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Role;
use App\Models\Permission;

class RolePermission extends Model
{
    use HasFactory;

    public function role() : BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
    public function permission() : BelongsTo
    {
        return $this->belongsTo(Permission::class);
    }
}
