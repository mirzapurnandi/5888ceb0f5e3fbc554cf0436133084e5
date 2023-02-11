<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'enable'
    ];

    public function category()
    {
        return $this->belongsToMany(Category::class, 'category_product', 'category_id', 'product_id');
    }

    public function image()
    {
        return $this->belongsToMany(Image::class, 'product_image', 'product_id', 'image_id');
    }
}
