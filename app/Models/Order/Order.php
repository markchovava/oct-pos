<?php

namespace App\Models\Order;

use App\Models\Operation\Operation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'operation_id', 'customer_id', 'currency', 'order_number',	'delivery',	'usd_delivery_fee',	
        'zwl_delivery_fee',	'usd_subtotal',	'zwl_subtotal',	'tax',	'discount',
        'usd_grandtotal', 'zwl_grandtotal',	'notes'	
    ];

    /* One to One BelongsTo */
    public function operation(){
        return $this->belongsTo(Operation::class, 'operation_id', 'id');
    }
    /* One to One belongsTo */
    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    /* One to many */
    public function order_items(){
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }
}
