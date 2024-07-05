<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $table = 'attributes';
    protected $fillable = ['name', 'slug'];

    public function attributeOptions() {
        return $this->hasMany(AttributeOption::class);
    }

    public function scopeSearchAttribute($query, $request)
    {
        if ($request->has('q')) {
            $query->where('name', 'LIKE', '%' . $request->q . '%');
        }

        return $query;
    }

    
}
