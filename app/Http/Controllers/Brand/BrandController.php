<?php

namespace App\Http\Controllers\Brand;

use App\Http\Controllers\Controller;
use App\Models\Brand\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(){
        $data['brands'] = Brand::orderBy('updated_at','desc')->paginate(10);
        return view('backend.brand.index', $data);
    }

    public function add(){
        return view('backend.brand.add');
    }

    public function store(Request $request){
        $brand = new Brand();
        $brand->name = $request->name;
        if( $request->file('image') ){
            $image = $request->file('image');
            $image_extension = strtolower($image->getClientOriginalExtension());
            $image_name = date('YmdHi'). '.' . $image_extension;
            $upload_location = 'storage/images/brands/';
            if($brand->image){
                if(file_exists(public_path($upload_location . $brand->image))){
                    unlink($upload_location . $brand->image);
                }
                $image->move($upload_location, $image_name);
                $brand->image = $image_name;                    
            }else{
                $image->move($upload_location, $image_name);
                $brand->image = $image_name;
            }              
        }
        $brand->save();

        $notification = [
            'message' => 'Brand Added Successfully!!...',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.brand.index')->with($notification);
    }

    public function edit($id){
        $data['brand'] = Brand::where('id', $id)->first();
        return view('backend.brand.edit', $data);
    }

    public function update(Request $request, $id){
        $brand = Brand::find($id);
        $brand->name = $request->name;
        if( $request->file('image') ){
            $image = $request->file('image');
            $image_extension = strtolower($image->getClientOriginalExtension());
            $image_name = date('YmdHi'). '.' . $image_extension;
            $upload_location = 'storage/images/brands/';
            if($brand->image){
                if(file_exists(public_path($upload_location . $brand->image))){
                    unlink($upload_location . $brand->image);
                }
                $image->move($upload_location, $image_name);
                $brand->image = $image_name;                    
            }else{
                $image->move($upload_location, $image_name);
                $brand->image = $image_name;
            }              
        }
        $brand->save();
        $notification = [
            'message' => 'Brand Updated Successfully!!...',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.brand.index')->with($notification);
    }

    public function delete($id){
        $brand = Brand::where('id', $id)->delete();
        $notification = [
            'message' => 'Brand Deleted Successfully!!...',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.brand.index')->with($notification);
    }

    public function search(Request $request){
        $name = $request->search; 
        $data['results'] = Brand::where('name', 'LIKE', '%' . $name . '%')->get();
        return view('backend.brand.index', $data);
    }

}
