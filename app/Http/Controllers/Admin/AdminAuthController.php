<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Info\BasicInfo;
use App\Models\Operation\Operation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminAuthController extends Controller
{
    public function login(){
        return view('backend.auth.login');
    }

    public function register(){
        $infos = BasicInfo::orderBy('name', 'asc')->paginate(15);
        $data['infos'] = $infos;
        return view('backend.auth.register', $data);
    }

    public function register_process(Request $request){
        $request->validate([
            'name' => 'required',
            'info_id' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);
        $user = new User();
        $user->role_id = 4;
        $user->info_id = $request->info_id;
        $user->name = $request->name;
        $name = explode(" ", $request->name);
        $user->first_name = isset($name[0]) ? $name[0] : '';
        $user->last_name = isset($name[1]) ? $name[1] : '' ;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->password = Hash::make($request->password);
        $user->date_of_birth = $request->day . ' ' . $request->month . ' ' . $request->year;
        $register = $user->save();
        if( $register != false ){
            $notification = [
                'message' => 'Registered Successfully!!...',
                'alert-type' => 'success'
            ];
            return redirect()->route('login')->with($notification);
        } else{
            return redirect()->back();
        }
    
    }

    public function logout(){
        $user_id = Auth::id();
        /* Insert End Time of a session */
        $operation = Operation::where('user_id', $user_id)->first();
        if( isset($operation) ){
            $operation->status = 0;
            $operation->end_time = now();
            $operation->save();
        }
        /*  */
        Session::flush();
        Auth::logout();
        return redirect()->route('login');
    }
}
