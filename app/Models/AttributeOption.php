<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeOption extends Model
{
    use HasFactory;

    protected $table = 'attribute_options';
    protected $fillable = ['value', 'slug', 'attribute_id'];

    public function scopeSearchAttributeOption($query, $request)
    {
        if ($request->has('q') && $request->q != null) {
            $query->where('value', 'LIKE', '%' . $request->q . '%');
        }

        if ($request->has('attribute_id') && $request->attribute_id != null) {
            $query->where('attribute_id', $request->attribute_id);
        }

        return $query;
    }

    public function attribute() {
        return $this->belongsTo(Attribute::class);
    }

    public function productAttributes() {
        return $this->hasMany(ProductAttribute::class);
    }
}
