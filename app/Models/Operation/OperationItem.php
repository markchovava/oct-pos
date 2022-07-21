<?php

namespace App\Models\Operation;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id', 'operation_id', 'usd_unit_price',	'zwl_unit_price',
        'quantity',	'usd_product_total', 'zwl_product_total'
    ];

    public function operation(){
        return $this->belongsTo(Operation::class, 'operation_id', 'id');
    }

    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
