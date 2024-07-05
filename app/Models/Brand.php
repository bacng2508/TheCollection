<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'brands';
    protected $fillable = ['name', 'slug', 'logo'];

    public function scopeSearchBrand($query, $request)
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
