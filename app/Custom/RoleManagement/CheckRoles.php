<?php

namespace App\Actions\RoleManagement;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CheckRoles{

   static public function check_role(){
        /* Role Management */
        if(Auth::check()){
            $id = Auth::id();
            $user = User::where('id', $id)->first();
            $role_id = $user->role_id;
        } else{
            $role_id = 4;
        }
        return $role_id;
    }
}