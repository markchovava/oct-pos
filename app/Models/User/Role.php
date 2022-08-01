<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',	'description', 'level'
    ];

    /* One to Many */
    public function users(){
        return $this->hasMany(User::class, 'role_id', 'id');
    }
}
