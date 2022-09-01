<?php

namespace App\Http\Controllers\Tax;

use App\Http\Controllers\Controller;
use App\Models\Tax\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    public function edit(){
        $tax = Tax::first();
        if( isset($tax) ){
            $data['tax'] = $tax;
        }else{
            $data['tax'] = NULL;
        }
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
