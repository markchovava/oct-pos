<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Models\Operation\Operation;
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
            ->orderBy('product_name', 'asc')->get();
        $data['results'] = $results;
        // User Status
        $auth_id = Auth::user()->id;
        $operation_status = Operation::where('user_id', $auth_id)->first();
        $data['operation_status'] = $operation_status;

        return view('backend.sale.index', $data);
    }
}
