<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Operation\Operation;
use App\Models\Order\Order;
use App\Models\Product\Product;
use App\Models\Stock\Stock;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
   public function index(){
      // User Status
      $user_id = Auth::id();
      $operation_status = Operation::where('user_id', $user_id)->first();
      $data['operation_status'] = $operation_status;
      // Active Operators
      $operation = Operation::where('status', 1)->get();
      $data['operations'] = $operation;
      //Stock
      $stock = Stock::sum('quantity');
      $data['stock'] = $stock;
      // USD Sales
      $items = DB::table('order_items')
                ->whereDate('created_at', Carbon::today())
                ->where('currency', 'USD')
                ->get();
      $data['usd_sales'] = $items->sum('product_total');
      // ZWL Sales
      $items = DB::table('order_items')
                ->whereDate('created_at', Carbon::today())
                ->where('currency', 'ZWL')
                ->get();
      $data['zwl_sales'] = $items->sum('product_total');
      // Products
      $products = Product::get();
      $data['products'] = $products;
      // Daily Orders
      $orders = Order::whereDate('created_at', Carbon::today())->get();
      $data['orders'] = $orders;


      return view('backend.dashboard.index', $data);
   }

}
