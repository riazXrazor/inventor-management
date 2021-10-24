<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ["name", "category_id", "stock", "price"];


    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }
}
