<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\User\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function view(){
        $id = Auth::id();
        $profile = User::where('id', $id)->first();
        $data['profile'] = $profile;
        return view('backend.profile.view', $data);
    }

    public function edit(){
        $id = Auth::id();
        $roles = Role::orderBy('name', 'asc')->get();
        $data['roles'] = $roles;
        $profile = User::find($id);
        $data['profile'] = $profile;
        return view('backend.profile.edit', $data);
    }

    public function update(Request $request){
        $id = Auth::id();
        $profile = User::find($id);
        $profile->first_name = $request->first_name;
        $profile->last_name = $request->last_name;
        $profile->name = $request->first_name . ' ' . $request->last_name;
        $profile->date_of_birth = $request->day . ' ' . $request->month . ' ' . $request->year;
        $profile->address = $request->address;
        $profile->email = $request->email;
        $profile->phone_number = $request->phone_number;
        $profile->role_id = $request->role_id;
        $profile->gender = $request->gender;
        $profile->updated_at = now();
        /* $code = date('YmdH'); // used as default password generator
        $profile->code = $code;
        $profile->password = Hash::make($code); */
        if( $request->file('image') ){
            $image = $request->file('image');
            $image_extension = strtolower($image->getClientOriginalExtension());
            $image_name = date('YmdHi'). '.' . $image_extension;
            $upload_location = 'storage/images/users/';
            if($profile->image){
                if(file_exists(public_path($upload_location .$profile->image))){
                    unlink($upload_location . $profile->image);
                }
                $image->move($upload_location, $image_name);
                $profile->image = $image_name;                    
            }else{
                $image->move($upload_location, $image_name);
                $profile->image = $image_name;
            }              
        }
        $profile->save();

        return redirect()->route('admin.profile.view');
    }

    public function password(){
        return view('backend.auth.password');
    }

    public function password_update(Request $request){
        $validatedData = $request->validate([
            'password' => 'required|confirmed',
        ]); 

        $id = Auth::id();
        $profile = User::find($id);
        $password = $request->password;
        $profile->password = Hash::make($password);
        $profile->save();
        return redirect()->route('admin.profile.view');
    }
}
