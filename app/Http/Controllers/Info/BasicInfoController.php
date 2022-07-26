<?php

namespace App\Http\Controllers\Info;

use App\Http\Controllers\Controller;
use App\Models\Info\BasicInfo;
use App\Models\Operation\Operation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasicInfoController extends Controller
{
    public function index(){
        $infos = BasicInfo::orderBy('name', 'asc')->paginate(10);
        $data['infos'] = $infos;
        // User Status
        $auth_id = Auth::user()->id;
        $operation_status = Operation::where('user_id', $auth_id)->first();
        $data['operation_status'] = $operation_status;

        return view('backend.info.index', $data);
    }

    public function add(){
        // User Status
        $auth_id = Auth::user()->id;
        $operation_status = Operation::where('user_id', $auth_id)->first();
        $data['operation_status'] = $operation_status;

        return view('backend.info.add', $data);
    }


    public function store(Request $request){
        $info = new BasicInfo();
        $info->name = $request->name;
        $info->address = $request->address;
        $info->phone = $request->phone;
        $info->email = $request->email;
        $info->vat_number = $request->vat_number;
        if( $request->file('image') ){
            $image = $request->file('image');
            $image_extension = strtolower($image->getClientOriginalExtension());
            $image_name = date('YmdHi'). '.' . $image_extension;
            $upload_location = 'storage/images/logos/';
            if($info->image){
                if(file_exists(public_path($upload_location . $info->image))){
                    unlink($upload_location . $info->image);
                }
                $image->move($upload_location, $image_name);
                $info->image = $image_name;                    
            }else{
                $image->move($upload_location, $image_name);
                $info->image = $image_name;
            }              
        }
        $info->save();

        $notification = [
            'message' => 'Added Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.info.index')->with($notification);
    }

    public function update(Request $request, $id){
        $info = BasicInfo::find($id);
        $info->info_id = $request->info_id;
        $info->name = $request->name;
        $info->address = $request->address;
        $info->phone = $request->phone;
        $info->email = $request->email;
        $info->vat_number = $request->vat_number;
        if( $request->file('image') ){
            $image = $request->file('image');
            $image_extension = strtolower($image->getClientOriginalExtension());
            $image_name = date('YmdHi'). '.' . $image_extension;
            $upload_location = 'storage/images/logos/';
            if($info->image){
                if(file_exists(public_path($upload_location . $info->image))){
                    unlink($upload_location . $info->image);
                }
                $image->move($upload_location, $image_name);
                $info->image = $image_name;                    
            }else{
                $image->move($upload_location, $image_name);
                $info->image = $image_name;
            }              
        }
        $info->save();
        
        $notification = [
            'message' => 'Added Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.info.index')->with($notification);
    }

    public function edit($id){
        $info = BasicInfo::find($id);
        $data['info'] = $info;
        // User Status
        $auth_id = Auth::user()->id;
        $operation_status = Operation::where('user_id', $auth_id)->first();
        $data['operation_status'] = $operation_status;

        return view('backend.info.edit', $data);
    }

    public function view($id){
        $info = BasicInfo::find($id);
        $data['info'] = $info;
        // User Status
        $auth_id = Auth::user()->id;
        $operation_status = Operation::where('user_id', $auth_id)->first();
        $data['operation_status'] = $operation_status;

        return view('backend.info.view', $data);
    }

    public function delete($id){
        $info = BasicInfo::where('id', $id)->delete();

        $notification = [
            'message' => 'Deleted Successfully',
            'alert-type' => 'danger'
        ];
        return redirect()->route('admin.info.index')->with($notification);
    }

    public function search(Request $request){
        $name = $request->search; 
        $data['results'] = BasicInfo::where('name', 'LIKE', '%' . $name . '%')->get();
        // User Status
        $auth_id = Auth::user()->id;
        $operation_status = Operation::where('user_id', $auth_id)->first();
        $data['operation_status'] = $operation_status;

        return view('backend.info.index', $data);
    }
}
