<?php

namespace App\Models\Info;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasicInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','phone','email', 'address', 'vat_number', 'image'
    ];

    public function users(){
        return $this->hasMany(User::class, 'info_id', 'id');
    }
}
