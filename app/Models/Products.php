<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'name',
        'description',
        'category',
        'is_sale',
        'attribute',
        'stock',
        'status',
        'purchase_price',
        'price',
        'main_image',
        'more_media',
        'category',
        'discount',
        'points',
        'attribute_items',
        'sale_price'
    ];
}
