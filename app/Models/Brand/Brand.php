<?php

namespace App\Models\Brand;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'image'
    ];

    public function products(){
        return $this->belongsToMany(Product::class, 'product_brands', 'brand_id', 'product_id')
            ->withTimestamps();
    }
}
