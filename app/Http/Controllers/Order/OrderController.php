<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Operation\Operation;
use App\Models\Order\Order;
use App\Models\Order\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $data['orders'] = Order::with(['order_items'])->orderBy('updated_at', 'desc')->get();
        return view('backend.order.index', $data);
    }

    public function view($id){
        $orders = Order::where('operation_id', $id)->orderBy('created_at', 'desc')->paginate(15);
        $operation = Operation::where('id', $id)->first();
        $user = User::where('id', $operation->user_id)->first();
        $data['user'] = $user;
        $data['orders'] = $orders;
        $data['results'] = NULL;
        return view('backend.order.view', $data);
    }

    public function searchview(Request $request){
        $transaction_id = $request->search;
        
        $order = Order::where('transaction_id', 'LIKE', '%' . $transaction_id . '%')->orderBy('created_at', 'desc')->first();
        $operation = Operation::where('id', $order->operation_id)->first();
        $orders = Order::where('transaction_id', 'LIKE', '%' . $transaction_id . '%')
                                    ->where('operation_id', 'LIKE', '%' . $order->operation_id. '%')
                                    ->orderBy('created_at', 'desc')->paginate(15);
        $user = User::where('id', $operation->user_id)->first();
        $data['user'] = $user;
        $data['results'] = $orders;
        $data['orders'] = NULL;
        return view('backend.order.view', $data);
    }

    public function delete($id){
        $order = Order::where('id', $id)->first();
        $items = OrderItem::where('order_id', $order->id)->delete();
        $orders = Order::where('id', $id)->delete();
        return redirect()->back();
    }
}
