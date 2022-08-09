<?php

namespace App\Models\Tax;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'percent'
    ];

      /* One to One */
      public function product(){
        return $this->hasMany(Product::class, 'tax_id', 'id');
    }
}
