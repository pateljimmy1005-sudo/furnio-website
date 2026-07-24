<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'category',
        'price',
        'description',
        'image',
        'material',
        'color',
        'stock',
        'discount',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount' => 'integer',
        'stock' => 'integer',
    ];

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function featuredImage()
    {
        return $this->hasOne(ProductImage::class)->where('is_featured', true);
    }

    public function imageUrl(): string
    {
        $image = trim((string) $this->image);

        if ($image === '') {
            $featured = $this->relationLoaded('images')
                ? $this->images->firstWhere('is_featured', true) ?? $this->images->first()
                : $this->images()->where('is_featured', true)->first()
                    ?? $this->images()->orderBy('sort_order')->first();

            return $featured ? $featured->imageUrl() : asset('images/placeholder.svg');
        }

        if (str_contains($image, '/')) {
            return asset($image);
        }

        if (file_exists(public_path('uploads/products/' . $image))) {
            return asset('uploads/products/' . $image);
        }

        return asset('images/' . ltrim($image, '/'));
    }

    public function hasInvalidPrice(): bool
    {
        return (float) $this->price <= 0;
    }

    public function finalPrice(): float
    {
        $discountAmount = ($this->price * $this->discount) / 100;
        return (float) $this->price - $discountAmount;
    }

    public function catalogName(): string
    {
        return $this->name ?? 'Product';
    }

    public function catalogPrice(): float
    {
        return (float) $this->price;
    }

    public function catalogDiscount(): int
    {
        return (int) $this->discount;
    }

    public function catalogDescription(): string
    {
        return (string) $this->description;
    }

    public function catalogMaterial(): string
    {
        return (string) $this->material;
    }

    public function catalogStock(): int
    {
        return (int) $this->stock;
    }

    public function reviews()
  {
    return $this->hasMany(Review::class);
  }

}
