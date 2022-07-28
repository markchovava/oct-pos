<?php

namespace App\Http\Controllers\POS;

use App\Http\Controllers\Controller;
use App\Models\Operation\Operation;
use App\Models\Order\Order;
use App\Models\Order\OrderItem;
use App\Models\Product\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class POSController extends Controller
{
    public function index(){
        return view('backend.pos.index');
   }

    public function searchbyname(Request $request){
        $name = $request->name;
        $data['product'] = Product::with(['stock','price'])->where('name', 'LIKE', '%' . $name . '%')->get();
        return response()->json($data);
    }

    public function process(Request $request){
        DB::transaction(function() use($request){
            $transaction_id = date('YmdHi') . rand(0, 100);
           /*  */
            $user_id = Auth::id();
            $operation = Operation::where('user_id', $user_id)->first();
            $operation_id = $operation->id;
            /*  */
            $order = new Order();
            $order->operation_id = $operation_id;
            $order->transaction_id = $transaction_id;
            $order->subtotal = $request->subtotal;
            $order->discount = $request->discount;
            $order->tax = $request->tax;
            $order->grandtotal = $request->grandtotal;
            $order->currency = $request->currency;
            $order->notes = $request->notes;
            $order->save();
          	/*  */				
            $product_id = count($request->product_id);
            for($i = 0; $i < $product_id; $i++){
                $item = new OrderItem();
                $item->order_id = $order->id;
                $item->product_id = $request->product_id;
                $item->product_name = $request->product_name;
                $item->product_barcode = $request->product_barcode;
                $item->currency = $request->currency;
                $item->usd_unit_price = $request->usd_unit_price;
                $item->zwl_unit_price = $request->zwl_unit_price;
                $item->quantity = $request->quantity;
                $item->product_total = $request->product_total;
                $item->save();
            }
        });
    }

}
