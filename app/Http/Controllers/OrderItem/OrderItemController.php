<?php

namespace App\Http\Controllers\OrderItem;

use App\Http\Controllers\Controller;
use App\Models\Operation\Operation;
use App\Models\Order\Order;
use App\Models\Order\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderItemController extends Controller
{
    public function list($id){
        $items = OrderItem::where('order_id', $id)->paginate(15);
        $data['items'] = $items;
        $item = OrderItem::where('order_id', $id)->first();
        $order = Order::where('id', $item->order_id)->first();
        $data['order'] = $order;
        // User Status
        $auth_id = Auth::user()->id;
        $operation_status = Operation::where('user_id', $auth_id)->first();
        $data['operation_status'] = $operation_status;

        return view('backend.orderitem.list', $data);
    }

    public function searchlist(Request $request){
        $name = $request->search;
        $item = OrderItem::where('product_name', 'LIKE', '%' . $name . '%')->first();
        $order = Order::where('id', $item->order_id)->first();
        $items = OrderItem::where('product_name', 'LIKE', '%' . $name . '%')->where('order_id', $order->id)->paginate(15);
        $data['results'] = $items;
        // User Status
        $auth_id = Auth::user()->id;
        $operation_status = Operation::where('user_id', $auth_id)->first();
        $data['operation_status'] = $operation_status;

        return view('backend.orderitem.list', $data);
    }
}
