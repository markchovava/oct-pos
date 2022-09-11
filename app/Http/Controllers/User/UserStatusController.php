<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Operation\Operation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserStatusController extends Controller
{
   
    public function status(Request $request){
        $status = (int)$request->status;
        $auth_id = Auth::user()->id;
        if($status == 1){
            $operation = new Operation();
            $operation->status = $status;
            $operation->user_id = $auth_id;
            $operation->created_at = now();
            $operation->start_time = now();
            $operation->save();
            $user_status = $operation->status;
        }
        elseif($status == 0){
            $operation = Operation::where('user_id', $auth_id)->orderBy('created_at', 'desc')->first();
            if(isset($operation)){
                $operation->updated_at = now();
                $operation->end_time = now();
                $operation->status = $status;
                $operation->save();
                $user_status = $operation->status;
            }
            else{
                $user_status = NULL;
            }
        }else{
            $user_status = NULL;
        }

        $data['current_status'] = $user_status;
        return response()->json($data);
    }
    
}
