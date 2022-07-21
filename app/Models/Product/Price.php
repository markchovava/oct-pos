<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'usd', 'zwl' 
    ];

    /* One to One */
    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

}
