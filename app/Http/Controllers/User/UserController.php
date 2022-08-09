<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\User\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $id = Auth::id();
        $users = User::where('id', '!=', $id)->orderBy('name', 'asc')->get();
        $data['users'] = $users;
        $data['results'] = NULL;
        return view('backend.user.index', $data);
    }

    public function add(){
        $roles = Role::orderBy('name', 'asc')->get();
        $data['roles'] = $roles;
        return view('backend.user.add', $data);
    }

    public function store(Request $request){
        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->name = $request->first_name . ' ' . $request->last_name;
        $user->date_of_birth = $request->day . ' ' . $request->month . ' ' . $request->year;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->role_id = $request->role_id;
        $user->gender = $request->gender;
        $user->created_at = now();
        $code = date('YmdH'); // used as default password generator
        $user->code = $code;
        $user->password = Hash::make($code);
        if( $request->file('image') ){
            $image = $request->file('image');
            $image_extension = strtolower($image->getClientOriginalExtension());
            $image_name = date('YmdHi'). '.' . $image_extension;
            $upload_location = 'storage/images/users/';
            if($user->image){
                if(file_exists(public_path($upload_location .$user->image))){
                    unlink($upload_location . $user->image);
                }
                $image->move($upload_location, $image_name);
                $user->image = $image_name;                    
            }else{
                $image->move($upload_location, $image_name);
                $user->image = $image_name;
            }              
        }
        $user->save();

        return redirect()->route('admin.user.index');
    }
    public function edit($id){
        $roles = Role::orderBy('name', 'asc')->get();
        $data['roles'] = $roles;
        $user = User::find($id);
        $data['user'] = $user;
        return view('backend.user.edit', $data);
    }
    public function view($id){
        $user = User::with('role')->find($id);
        $data['user'] = $user;
        return view('backend.user.view', $data);
    }
    public function search(Request $request){
        $name = $request->search;
        $results = User::where('name', 'LIKE', '%' . $name . '%')->get();
        $data['results'] = $results;
        $data['users'] = NULL;
        return view('backend.user.index', $data);
    }
    
    public function update(Request $request, $id){
        $user = User::find($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->name = $request->first_name . ' ' . $request->last_name;
        $user->date_of_birth = $request->day . ' ' . $request->month . ' ' . $request->year;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->role_id = $request->role_id;
        $user->gender = $request->gender;
        $user->updated_at = now();
        /* $code = date('YmdH'); // used as default password generator
        $user->code = $code;
        $user->password = Hash::make($code); */
        if( $request->file('image') ){
            $image = $request->file('image');
            $image_extension = strtolower($image->getClientOriginalExtension());
            $image_name = date('YmdHi'). '.' . $image_extension;
            $upload_location = 'storage/images/users/';
            if($user->image){
                if(file_exists(public_path($upload_location .$user->image))){
                    unlink($upload_location . $user->image);
                }
                $image->move($upload_location, $image_name);
                $user->image = $image_name;                    
            }else{
                $image->move($upload_location, $image_name);
                $user->image = $image_name;
            }              
        }
        $user->save();

        return redirect()->route('admin.user.index');
    }
 
    public function delete($id){
        $user = User::where('id', $id)->delete();
        return redirect()->route('admin.user.index');
    }
}
