<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_category_id',
        'thumbnail',
        'name',
        'description',
        'price'
    ];

    public function productCategory()
    {
        // satu product memeiliki satu category
        return $this->belongsTo(ProductCategory::class);
    }
}
