<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = [
    'product_id',
    'name',
    'image',
    'price',
    'description',
    'material',
    'stock'
];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
