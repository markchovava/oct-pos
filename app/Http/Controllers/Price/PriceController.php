<?php

namespace App\Http\Controllers\Price;

use App\Http\Controllers\Controller;
use App\Models\Operation\Operation;
use App\Models\Price\Price;
use App\Models\Product\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PriceController extends Controller
{
    public function index(){
        $data['results'] = NULL;
        $products = Product::with('price')->paginate(10);
        $data['products'] = $products;
        // User Status
        $auth_id = Auth::user()->id;
        $operation_status = Operation::where('user_id', $auth_id)->first();
        $data['operation_status'] = $operation_status;

        return view('backend.price.index', $data);
    }

    public function edit($id){
        $product = Product::with(['price','stock'])->where('id', $id)->first();
        $data['product'] = $product;
        // User Status
        $auth_id = Auth::user()->id;
        $operation_status = Operation::where('user_id', $auth_id)->first();
        $data['operation_status'] = $operation_status;

        return view('backend.price.edit', $data);
    }

    public function update(Request $request, $id){
        $price = Price::where('product_id', $id)->first();
        $price->usd = $request->usd;
        $price->zwl = $request->zwl;
        $price->save();

        $notification = [
            'message' => 'Updated Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('admin.price.index')->with($notification);
    }
}
