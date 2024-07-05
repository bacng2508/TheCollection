<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $table = 'permissions';

    public function permissionGroup() {
        return $this->belongsTo(PermissionGroup::class);
    }

    public function roles() {
        return $this->belongsToMany(Role::class, 'permission_role');
    }
}
