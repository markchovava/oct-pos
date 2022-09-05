<?php

namespace App\Http\Controllers\Operation;

use App\Http\Controllers\Controller;
use App\Models\Info\BasicInfo;
use App\Models\Operation\Operation;
use App\Models\User;
use App\Models\User\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class OperationController extends Controller
{
    public function index(){
        $operators = User::with(['role', 'operations'])->where('role_id', '>=', '3')
                                        ->orderBy('updated_at', 'desc')->paginate(10);
        $data['operators'] = $operators;    
        $data['results'] = NULL;
        // User Status
        $auth_id = Auth::user()->id;
        $operation_status = Operation::where('user_id', $auth_id)->first();
        $data['operation_status'] = $operation_status;

        return view('backend.operation.index', $data);
    }
    public function search(Request $request){
        $name = $request->search;
        $results = User::with(['role', 'operations'])->where('role_id', '>=', '3')
            ->where('name', 'LIKE', '%' . $name . '%')->orderBy('updated_at', 'desc')->paginate(15);
        $data['results'] = $results;
        // User Status
        $auth_id = Auth::user()->id;
        $operation_status = Operation::where('user_id', $auth_id)->first();
        $data['operation_status'] = $operation_status;
        
        return view('backend.operation.index', $data);
    }

    public function add(){
        $infos = BasicInfo::orderBy('name', 'asc')->get();
        $data['infos'] = $infos;
        // User Status
        $auth_id = Auth::user()->id;
        $operation_status = Operation::where('user_id', $auth_id)->first();
        $data['operation_status'] = $operation_status;

        return view('backend.operation.add', $data);
    }

    public function store(Request $request){
        $operator = new User();
        $operator->info_id = $request->info_id;
        $operator->first_name = $request->first_name;
        $operator->last_name = $request->last_name;
        $operator->name = $request->first_name . ' ' . $request->last_name;
        $operator->date_of_birth = $request->day . ' ' . $request->month . ' ' . $request->year;
        $operator->address = $request->address;
        $operator->email = $request->email;
        $operator->phone_number = $request->phone_number;
        $operator->role_id = 4; // From Operations
        $operator->gender = $request->gender;
        $operator->created_at = now();
        $code = date('YmdH'); // used as default password generator
        $operator->code = $code;
        $operator->password = Hash::make($code);
        if( $request->file('image') ){
            $image = $request->file('image');
            $image_extension = strtolower($image->getClientOriginalExtension());
            $image_name = date('YmdHi'). '.' . $image_extension;
            $upload_location = 'storage/images/users/';
            if($operator->image){
                if(file_exists(public_path($upload_location . $operator->image))){
                    unlink($upload_location . $operator->image);
                }
                $image->move($upload_location, $image_name);
                $operator->image = $image_name;                    
            }else{
                $image->move($upload_location, $image_name);
                $operator->image = $image_name;
            }              
        }
        $operator->save();

        $notification = [
            'message' => 'Added Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.operation.index')->with($notification);
    }

    public function view($id){
        $operator = User::with(['role'])->where('id', $id)->first();
        $operations = Operation::where('user_id', $id)->paginate(10);
        $data['operator'] = $operator;
        $data['operations'] = $operations;
        $info = BasicInfo::where('id', $operator->info_id)->first();
        $data['info'] = $info;

        // User Status
        $auth_id = Auth::user()->id;
        $operation_status = Operation::where('user_id', $auth_id)->first();
        $data['operation_status'] = $operation_status;

        return view('backend.operation.view', $data);
    }

    public function edit($id){
        $roles = Role::orderBy('name', 'asc')->get();
        $data['roles'] = $roles;
        $operator = User::find($id);
        $data['operator'] = $operator;
        $infos = BasicInfo::orderBy('name', 'asc')->get();
        $data['infos'] = $infos;
        // User Status
        $auth_id = Auth::user()->id;
        $operation_status = Operation::where('user_id', $auth_id)->first();
        $data['operation_status'] = $operation_status;

        return view('backend.operation.edit', $data);
    }

    public function update(Request $request, $id){
        $operator = User::find($id);
        $operator->info_id = $request->info_id;
        $operator->first_name = $request->first_name;
        $operator->last_name = $request->last_name;
        $operator->name = $request->first_name . ' ' . $request->last_name;
        $operator->date_of_birth = $request->day . ' ' . $request->month . ' ' . $request->year;
        $operator->address = $request->address;
        $operator->email = $request->email;
        $operator->phone_number = $request->phone_number;
        $operator->role_id = $request->role_id;
        $operator->gender = $request->gender;
        $operator->updated_at = now();
        /* $code = date('YmdH'); // used as default password generator
        $operator->code = $code;
        $operator->password = Hash::make($code); */
        if( $request->file('image') ){
            $image = $request->file('image');
            $image_extension = strtolower($image->getClientOriginalExtension());
            $image_name = date('YmdHi'). '.' . $image_extension;
            $upload_location = 'storage/images/users/';
            if($operator->image){
                if(file_exists(public_path($upload_location .$operator->image))){
                    unlink($upload_location . $operator->image);
                }
                $image->move($upload_location, $image_name);
                $operator->image = $image_name;                    
            }else{
                $image->move($upload_location, $image_name);
                $operator->image = $image_name;
            }              
        }
        $operator->save();

        $notification = [
            'message' => 'Added Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.operation.index')->with($notification);
    }

    public function delete($id){
        $operator = User::where('id', $id)->delete();
        return redirect()->route('admin.operation.index');
    }

    public function list(){
        $operations = Operation::with('user')->orderBy('updated_at', 'desc')->paginate(10);
        $data['operations'] = $operations;
        $data['results'] = NULL;
        // User Status
        $auth_id = Auth::user()->id;
        $operation_status = Operation::where('user_id', $auth_id)->first();
        $data['operation_status'] = $operation_status;

        return view('backend.operation.list', $data);
    }

    public function deletelist($id){
        $operator =  Operation::with('user')->where('id', $id)->delete();
        
        $notification = [
            'message' => 'Deleted Successfully',
            'alert-type' => 'danger'
        ];
        return redirect()->route('admin.operation.list')->with($notification);
    }

    public function searchlist(Request $request){
        $name = $request->search;
        $user = User::with('operations')->where('name', 'LIKE', '%' . $name . '%')
                        ->orderBy('name', 'desc')->first();
        $operations = Operation::where('user_id', $user->id)->get();
        $data['results'] = $operations;
        $data['operations'] = NULL;
        // User Status
        $auth_id = Auth::user()->id;
        $operation_status = Operation::where('user_id', $auth_id)->first();
        $data['operation_status'] = $operation_status;

        return view('backend.operation.list', $data);
    }

}
