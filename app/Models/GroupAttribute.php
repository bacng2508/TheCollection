<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupAttribute extends Model
{
    use HasFactory;

    protected $table = 'group_attributes';
    protected $fillable = ['name'];

    public function attribute() {
        return $this->hasMany(Attribute::class);
    }
}
