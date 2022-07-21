<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',	'percent', 'description'
    ];

     /* One to One */
     public function product(){
        return $this->hasMany(Product::class, 'discount_id', 'id');
    }
}
