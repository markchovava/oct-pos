<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Models\Operation\Operation;
use App\Models\Order\OrderItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index(){
        $sales = DB::table('order_items')
            ->select('product_name', 'currency',
            DB::raw('sum(quantity) as quantity'), 
            DB::raw('sum(product_total) as product_total'),
            )->groupBy(['product_name', 'currency'])
            ->orderBy('product_name', 'asc')->paginate(10);
        $data['sales'] = $sales;
        
        $data['results'] = null;
        // User Status
        $auth_id = Auth::user()->id;
        $operation_status = Operation::where('user_id', $auth_id)->first();
        $data['operation_status'] = $operation_status;

        return view('backend.sale.index', $data);
    }

    public function search(Request $request){
        $name = $request->search;
        $data['sales'] = NULL;
        $results = DB::table('order_items')
            ->where('product_name', 'LIKE', '%'. $name . '%')
            ->select('product_name', 'currency',
            DB::raw('sum(quantity) as quantity'), 
            DB::raw('sum(product_total) as product_total'),
            )->groupBy(['product_name', 'currency'])
            ->orderBy('product_name', 'asc')->paginate(10);
        $data['results'] = $results;
        // User Status
        $auth_id = Auth::user()->id;
        $operation_status = Operation::where('user_id', $auth_id)->first();
        $data['operation_status'] = $operation_status;

        return view('backend.sale.index', $data);
    }

    public function daily(){
        $daily = DB::table('order_items')
                ->select(
                    DB::raw('DATE(created_at) as date'), 
                    DB::raw('currency as currency'), 
                    DB::raw('sum(product_total) as product_total'),
                    DB::raw('sum(quantity) as quantity')
                )
                ->groupBy(['date', 'currency'])
                ->orderBy('created_at', 'DESC')
                ->paginate(15);
        $data['sales'] = $daily;
        $data['results'] = null;
        // User Status
        $user_id = Auth::user()->id;
        $operation_status = Operation::where('user_id', $user_id)->first();
        $data['operation_status'] = $operation_status;
        /*  */
        return view('backend.sale.daily', $data);
    }

    public function daily_list($date){
        $daily = OrderItem::where('created_at', 'LIKE', '%' . $date . '%')
                            ->orderBy('updated_at', 'desc')
                            ->paginate(10);
        $data['sales'] = $daily;
        $data['date'] = Carbon::parse($date)->format('j M Y');
        // User Status
        $user_id = Auth::user()->id;
        $operation_status = Operation::where('user_id', $user_id)->first();
        $data['operation_status'] = $operation_status;

        return view('backend.sale.list', $data);
    }

}
