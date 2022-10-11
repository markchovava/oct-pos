<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Operation\Operation;
use App\Models\Order\Order;
use App\Models\Order\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(){
        $data['orders'] = Order::with(['order_items'])->orderBy('updated_at', 'desc')->paginate(10);
        // User Status
        $auth_id = Auth::user()->id;
        $operation_status = Operation::where('user_id', $auth_id)->first();
        $data['operation_status'] = $operation_status;
        
        return view('backend.order.index', $data);
    }

    public function view($id){
        $orders = Order::where('operation_id', $id)->orderBy('created_at', 'desc')->paginate(10);
        $operation = Operation::where('id', $id)->first();
        $user = User::where('id', $operation->user_id)->first();
        $data['user'] = $user;
        $data['orders'] = $orders;
        $data['results'] = NULL;
        // User Status
        $auth_id = Auth::user()->id;
        $operation_status = Operation::where('user_id', $auth_id)->first();
        $data['operation_status'] = $operation_status;

        return view('backend.order.view', $data);
    }

    public function searchview(Request $request){
        $transaction_id = $request->search;
        
        $order = Order::where('transaction_id', 'LIKE', '%' . $transaction_id . '%')->orderBy('created_at', 'desc')->first();
        $operation = Operation::where('id', $order->operation_id)->first();
        $orders = Order::where('transaction_id', 'LIKE', '%' . $transaction_id . '%')
                                    ->where('operation_id', 'LIKE', '%' . $order->operation_id. '%')
                                    ->orderBy('created_at', 'desc')->paginate(10);
        $user = User::where('id', $operation->user_id)->first();
        $data['user'] = $user;
        $data['results'] = $orders;
        $data['orders'] = NULL;
        // User Status
        $auth_id = Auth::user()->id;
        $operation_status = Operation::where('user_id', $auth_id)->first();
        $data['operation_status'] = $operation_status;

        return view('backend.order.view', $data);
    }

    public function delete($id){
        $order = Order::where('id', $id)->first();
        $items = OrderItem::where('order_id', $order->id)->delete();
        $orders = Order::where('id', $id)->delete();

        $notification = [
            'message' => 'Deleted Successfully',
            'alert-type' => 'danger'
        ];
        return redirect()->back()->with($notification);
    }

    public function daily(){
        $orders = DB::table('orders')
                    ->select(
                        DB::raw('DATE(created_at) as date'), 
                        DB::raw('count(*) as daily_order')
                    )
                    ->groupBy('date')
                    ->paginate(10);
        $data['orders'] = $orders;
        // User Status
        $auth_id = Auth::user()->id;
        $operation_status = Operation::where('user_id', $auth_id)->first();
        $data['operation_status'] = $operation_status;

        return view('backend.order.daily', $data);
    }

    public function daily_view($date){
        $orders = Order::with(['order_items'])->where('created_at', 'LIKE', '%' . $date . '%')->orderBy('updated_at', 'desc')->paginate(10);
        $data['orders'] = $orders;
        // User Status
        $auth_id = Auth::user()->id;
        $operation_status = Operation::where('user_id', $auth_id)->first();
        $data['operation_status'] = $operation_status;

        return view('backend.order.index', $data);
    }

}
