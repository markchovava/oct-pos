<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name', 'last_name', 'date_of_birth',	'id_number', 'gender',
        'phone', 'email', 'address'
    ];

    /* One to Many */
    public function orders(){
        return $this->hasMany(Order::class, 'customer_id', 'id');
    }
    
}
