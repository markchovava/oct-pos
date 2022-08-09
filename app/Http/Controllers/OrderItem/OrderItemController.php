<?php

namespace App\Http\Controllers\OrderItem;

use App\Http\Controllers\Controller;
use App\Models\Order\Order;
use App\Models\Order\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function list($id){
        $items = OrderItem::where('order_id', $id)->paginate(15);
        $data['items'] = $items;
        $item = OrderItem::where('order_id', $id)->first();
        $order = Order::where('id', $item->order_id)->first();
        $data['order'] = $order;
        return view('backend.orderitem.list', $data);
    }

    public function searchlist(Request $request){
        $name = $request->search;
        $item = OrderItem::where('product_name', 'LIKE', '%' . $name . '%')->first();
        $order = Order::where('id', $item->order_id)->first();
        $items = OrderItem::where('product_name', 'LIKE', '%' . $name . '%')->where('order_id', $order->id)->paginate(15);
        $data['results'] = $items;
        return view('backend.orderitem.list', $data);
    }
}
