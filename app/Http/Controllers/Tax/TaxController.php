<?php

namespace App\Http\Controllers\Tax;

use App\Http\Controllers\Controller;
use App\Models\Operation\Operation;
use App\Models\Tax\Tax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaxController extends Controller
{
    public function edit(){
        $tax = Tax::first();
        if( isset($tax) ){
            $data['tax'] = $tax;
        }else{
            $data['tax'] = NULL;
        }
        // User Status
        $auth_id = Auth::user()->id;
        $operation_status = Operation::where('user_id', $auth_id)->first();
        $data['operation_status'] = $operation_status;
        return view('backend.tax.edit', $data);
    }

    public function update(Request $request){
        $tax = Tax::first();
        if( isset($tax) ){
            $tax->name = $request->name;
            $tax->percent = $request->percent;
            $tax->save();
        } else{
            $tax = new Tax();
            $tax->name = $request->name;
            $tax->percent = $request->percent;
            $tax->save();
        }

        $notification = [
            'message' => 'Updated Successfully!!...',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.tax.edit')->with($notification);
    }
}
