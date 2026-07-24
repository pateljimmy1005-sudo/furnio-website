<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $with = ['product'];

    protected $fillable = [
        'product_id',
        'image',
        'sort_order',
        'is_featured',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }



    public function imageUrl(): string
    {
        $image = trim((string) $this->image);

        if ($image !== '') {
            return $this->resolveAssetPath($image);
        }

        $this->loadMissing('product');

        if ($this->product?->image) {
            return $this->product->imageUrl();
        }

        return asset('images/placeholder.svg');
    }



    protected function resolveAssetPath(string $image): string
    {
        if (str_contains($image, '/')) {
            return asset($image);
        }

        if (file_exists(public_path('uploads/products/' . $image))) {
            return asset('uploads/products/' . $image);
        }

        return asset('images/' . ltrim($image, '/'));
    }
}
