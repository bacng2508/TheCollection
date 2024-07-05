<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdministratorRole extends Model
{
    use HasFactory;

    protected $table = 'administrator_role';

    public function role() {
        return $this->belongsTo(Permission::class);
    }
}
