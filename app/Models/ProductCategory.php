<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = [
        'name',
        'image'
    ];

    public function products()
    {
        // satu product category bisa memiliki banyak product (One To Many)
        return $this->hasMany(Product::class);
    }
}
