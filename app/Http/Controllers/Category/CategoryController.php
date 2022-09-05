<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category\Category;
use App\Models\Operation\Operation;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index(){
        $data['categories'] = Category::orderBy('created_at', 'desc')->paginate(10);
        // User Status
        $auth_id = Auth::user()->id;
        $operation_status = Operation::where('user_id', $auth_id)->first();
        $data['operation_status'] = $operation_status;

        return view('backend.category.index', $data);
    }

    public function add(){
        // User Status
        $auth_id = Auth::user()->id;
        $operation_status = Operation::where('user_id', $auth_id)->first();
        $data['operation_status'] = $operation_status;

        return view('backend.category.add', $data);
    }

    public function store(Request $request){
        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        $notification = [
            'message' => 'Category Added Successfully!!...',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.category.index')->with($notification);
    }

    public function search(Request $request){
        $search = $request->search;
        $data['results'] = Category::where('name', 'LIKE', '%' . $search . '%')->paginate(10);
        // User Status
        $auth_id = Auth::user()->id;
        $operation_status = Operation::where('user_id', $auth_id)->first();
        $data['operation_status'] = $operation_status;

        return view('backend.category.index', $data);
    }

    public function edit($id){
        $data['category'] = Category::where('id', $id)->first();
        // User Status
        $auth_id = Auth::user()->id;
        $operation_status = Operation::where('user_id', $auth_id)->first();
        $data['operation_status'] = $operation_status;
        
        return view('backend.category.edit', $data);
    }

    public function update(Request $request, $id){
        $category = Category::find($id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        $notification = [
            'message' => 'Category Updated Successfully!!...',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.category.index')->with($notification);
    }

    public function delete($id){
        $category = Category::where('id', $id)->delete();
        $notification = [
            'message' => 'Category Updated Successfully!!...',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.category.index')->with($notification);
    }
}
