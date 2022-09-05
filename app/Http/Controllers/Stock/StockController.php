<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Operation\Operation;
use App\Models\Product\Product;
use App\Models\Stock\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    public function index(){
        $data['results'] = NULL;
        /* Get Product */
        $products = Product::with('stock')->paginate(10);
        $data['products'] = $products;
        // User Status
        $auth_id = Auth::user()->id;
        $operation_status = Operation::where('user_id', $auth_id)->first();
        $data['operation_status'] = $operation_status;
        
        return view('backend.stock.index', $data);
    }

    public function search(Request $request){
        $name = $request->search;
        $data['products'] = NULL;
        $results = Product::with('stock')->where('name', 'LIKE', '%' . $name . '%')->paginate(10);
        $data['results'] = $results;
        // User Status
        $auth_id = Auth::user()->id;
        $operation_status = Operation::where('user_id', $auth_id)->first();
        $data['operation_status'] = $operation_status;

        return view('backend.stock.index', $data);
    }

    public function edit($id){
        $product = Product::with('stock')->where('id', $id)->first();
        $data['product'] = $product;
        // User Status
        $auth_id = Auth::user()->id;
        $operation_status = Operation::where('user_id', $auth_id)->first();
        $data['operation_status'] = $operation_status;

        return view('backend.stock.edit', $data);
    }

    public function update(Request $request, $id){
        $stock = Stock::where('product_id', $id)->first();
        $stock->quantity = $request->quantity;
        $stock->save();

        $notification = [
            'message' => 'Role Updated Successfully!!...',
            'alert-type' => 'success'
        ];

        return redirect()->route('admin.stock.index')->with($notification);
    }
}
