<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $fillable = ['name', 'slug'];

    public function scopeSearchCategory($query, $request)
    {
        if ($request->has('q')) {
            $query->where('name', 'LIKE', '%' . $request->q . '%');
        }

        return $query;
    }

    public function products() {
        return $this->hasMany(Product::class);
    }

}
