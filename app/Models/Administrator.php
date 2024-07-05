<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;

class Administrator extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;

    protected $table = 'administrators';
    protected $fillable = ['name', 'avatar', 'email', 'password', 'tel', 'status'];

    public function scopeSearchAdministrator($query, $request) {
        if ($request->has('q') && $request->q != null) {
            $query->where('name', 'LIKE', '%' . $request->q . '%')->orWhere('email', 'LIKE', '%' . $request->q . '%');
        }

        if ($request->has('administrator_status') && $request->administrator_status != null) {
            $query->where('status', $request->administrator_status);
        }

        return $query;
    }

    public function roles() {
        return $this->belongsToMany(Role::class, 'administrator_role');
    }

    public function checkPermissionAccess() {
        return 3;   
    }
}
