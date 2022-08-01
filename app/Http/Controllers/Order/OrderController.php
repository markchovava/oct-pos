<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Order\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $data['orders'] = Order::with(['operation', 'order_items'])->orderBy('updated_at', 'desc')->get();
        return view('backend.order.index', $data);
    }
}
