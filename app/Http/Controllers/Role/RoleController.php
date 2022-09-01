<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Models\User\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(){
        $data['roles'] = Role::orderBy('level', 'asc')->paginate(10);
        return view('backend.role.index', $data);
    }

    public function add(){
        return view('backend.role.add');
    }

    public function store(Request $request){
        $role = new Role();
        $role->name = $request->name;
        $role->description = $request->description;
        $role->level = (int)$request->level;
        $role->save();

        $notification = [
            'message' => 'Role Added Successfully!!...',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.role.index')->with($notification);
    }
    public function edit($id){
        $data['role'] = Role::where('id', $id)->first();
        return view('backend.role.edit', $data);
    }

    public function update(Request $request, $id){
        $role = Role::find($id);
        $role->name = $request->name;
        $role->description = $request->description;
        $role->level = (int)$request->level;
        $role->save();

        $notification = [
            'message' => 'Role Updated Successfully!!...',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.role.index')->with($notification);
    }

    public function delete($id){
        $role = Role::where('id', $id)->delete();

        $notification = [
            'message' => 'Deleted Successfully!!...',
            'alert-type' => 'danger'
        ];
        return redirect()->route('admin.role.index')->with($notification);
    }

    public function search(Request $request){
        $search = $request->search;
        $data['results'] = Role::where('name', 'LIKE', '%' . $search . '%')->get();
        return view('backend.role.index', $data);
    }
}
