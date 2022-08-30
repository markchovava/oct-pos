<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

        return view('backend.sale.index', $data);
    }
}
