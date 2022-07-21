<?php

namespace App\Models\Operation;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'start_time', 'end_time', 'usd_total', 'zwl_total'
    ];

    public function operation_items(){
        return $this->hasMany(OperationItem::class, 'operation_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
}
