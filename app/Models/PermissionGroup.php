<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionGroup extends Model
{
    use HasFactory;

    protected $table = 'permission_groups';

    public function permissions() {
        return $this->hasMany(Permission::class);
    }
}
