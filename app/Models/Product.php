<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [

    'vendor_id',
    'category_id',
    'brand_id',
    'name',
    'slug',
    'sku',
    'price',
    'sale_price',
    'stock',
    'description',
    'thumbnail',
    'featured',
    'status',

];

public function category()
{
    return $this->belongsTo(Category::class);
}

public function brand()
{
    return $this->belongsTo(Brand::class);
}

public function vendor()
{
    return $this->belongsTo(User::class,'vendor_id');
}

public function productImages()
{
    return $this->hasMany(ProductImage::class, 'product_id', 'id');
}

}
