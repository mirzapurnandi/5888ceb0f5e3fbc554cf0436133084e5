<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = 'images';

    protected $fillable = [
        'name',
        'file',
        'enable'
    ];

    public function image()
    {
        return $this->belongsToMany(Product::class, 'product_image', 'product_id', 'image_id');
    }
}
