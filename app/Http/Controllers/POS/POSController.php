<?php

namespace App\Http\Controllers\POS;

use App\Http\Controllers\Controller;
use App\Models\Operation\Operation;
use App\Models\Order\Order;
use App\Models\Order\OrderItem;
use App\Models\Product\Product;
use App\Models\Stock\Stock;
use App\Models\Tax\Tax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class POSController extends Controller
{
    public function index(){
        $tax = Tax::first();
        $data['tax'] = $tax;
        // User Status
        $auth_id = Auth::user()->id;
        $operation_status = Operation::where('user_id', $auth_id)->first();
        $data['operation_status'] = $operation_status;
        
        return view('backend.pos.index', $data);
   }

    public function searchbyname(Request $request){
        $name = $request->name;
        $data['product'] = Product::with(['stock','price'])->where('name', 'LIKE', '%' . $name . '%')->get();
        return response()->json($data);
    }

    public function searchbybarcode(Request $request){
        $barcode = $request->barcode;
        $data['product'] = Product::with(['stock','price'])->where('barcode', 'LIKE', '%' . $barcode . '%')->get();
        return response()->json($data);
    }

    public function process(Request $request){
        if( auth()->check()){
            DB::transaction(function() use($request){
                $transaction_id = date('YmdHi') . rand(0, 100);
               /*   */
                $user_id = Auth::id();
                /**
                 *   Operation
                 */
                $operation = Operation::where('user_id', $user_id)->where('status', 1)->first();
                if( isset($operation) ){
                    if($request->currency == 'ZWL'){
                        $operation->zwl_total += (int)$request->grandtotal;
                    }elseif($request->currency == 'USD'){
                        $operation->usd_total += (int)$request->grandtotal;
                    } else{
                        $operation->usd_total = NULL; 
                        $operation->zwl_total = NULL; 
                    }
                    $operation->save();
                }else{
                    $operation = new Operation();
                    $operation->user_id = $user_id;
                    $operation->status = 1;
                    $operation->created_at = now();
                    $operation->start_time = now();
                    if($request->currency == 'ZWL'){
                        $operation->zwl_total = $request->grandtotal;
                    }elseif($request->currency == 'USD'){
                        $operation->usd_total = $request->grandtotal;
                    } else{
                        $operation->usd_total = NULL; 
                        $operation->zwl_total = NULL; 
                    }
                    $operation->save();
                }  
                /**
                 *    Order
                 **/
                $order = new Order();
                $order->operation_id = $operation->id;
                $order->transaction_id = $transaction_id;
                $order->subtotal = $request->subtotal;
                $order->tax = $request->tax;
                $order->amount_paid = $request->amount_paid;
                $order->customer_change = $request->customer_change;
                $order->grandtotal = $request->grandtotal;
                $order->currency = $request->currency;
                $order->notes = $request->notes;
                $order->created_at = now();
                $order->save();     
                /**
                 *    Order Item  
                 * */	
                if( isset($request->product_id) ){
                    $count_id = count($request->product_id);
                    for($i = 0; $i < $count_id; $i++){
                        $item = OrderItem::where('order_id', $order->id)
                                ->where('product_id', $request->product_id[$i])->first();
                        if( isset($item) ) { 
                            $item->quantity += $request->product_quantity[$i];
                            $item->product_total += $request->product_total[$i];
                            $item->save();
                        }else{
                            $item = new OrderItem();
                            $item->order_id = $order->id;
                            $item->product_id = $request->product_id[$i];
                            $item->product_name = $request->product_name[$i];
                            $item->product_barcode = $request->product_barcode[$i];
                            $item->currency = $request->currency;
                            $item->usd_unit_price = $request->usd_unit_price[$i];
                            $item->zwl_unit_price = $request->zwl_unit_price[$i];
                            $item->quantity = $request->product_quantity[$i];
                            $item->product_total = $request->product_total[$i];
                            $item->created_at = now();
                            $item->save();
                            /* Stock */
                            $stock = Stock::where('product_id', $request->product_id[$i])->first();
                            $stock->quantity -= (int)$request->product_quantity[$i]; // Deduct Stock
                            $stock->save();
                        }
                    }

                }			
                
            });

            $notification = [
                'message' => 'Added Successfully',
                'alert-type' => 'success'
            ];
            return redirect()->route('admin.print')->with($notification);
        }
        return redirect()->route('admin.pos');
    }

}
