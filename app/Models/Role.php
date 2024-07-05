<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $fillable = ['name', 'display_name'];

    public function permissions() {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }

    public function administrators() {
        return $this->belongsToMany(Administrator::class, 'administrator_role');
    }
}
