<?php

namespace App\Models;

use App\Models\Info\BasicInfo;
use App\Models\Operation\Operation;
use App\Models\User\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
     /**
     *  One to One 
     **/
    public function role(){
        return $this->belongsTo(Role::class, 'role_id', 'level');
    }
    public function info(){
        return $this->belongsTo(BasicInfo::class, 'info_id', 'level');
    }
    /**
     *  One to Many 
     **/
    public function operations(){
        return $this->hasMany(Operation::class, 'user_id', 'id');
    }

    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 'password', 'email', 'role_id', 
        'code',  'first_name', 'last_name', 
        'phone_number', 'address', 'id_number',	
        'date_of_birth', 'gender', 
        'marital_status', 'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

}
