<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
    'name', 'brand', 'rating', 'price', 'discount',
    'category', 'stock', 'status', 'image_path', 'image_path2', 'description'
];


    public function getStockStatusAttribute(): string
    {
        if ($this->stock <= 0) return 'Out of Stock';
        if ($this->stock <= 5) return 'Low Stock';
        return 'In Stock';
    }
}
