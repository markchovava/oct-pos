<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Models\Product\Product;
use App\Models\Stock\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index(){
        $data['results'] = NULL;
        /* Get Product */
        $products = Product::with('stock')->get();
        $data['products'] = $products;
        return view('backend.stock.index', $data);
    }

    public function search(Request $request){
        $name = $request->search;
        $data['products'] = NULL;
        $results = Product::with('stock')->where('name', 'LIKE', '%' . $name . '%')->get();
        $data['results'] = $results;
        return view('backend.stock.index', $data);
    }

    public function edit($id){
        $product = Product::with('stock')->where('id', $id)->first();
        $data['product'] = $product;
        //dd($data['product']->name);
        return view('backend.stock.edit', $data);
    }

    public function update(Request $request, $id){
        $stock = Stock::where('product_id', $id)->first();
        $stock->quantity = $request->quantity;
        $stock->save();
        return redirect()->route('admin.stock.index');
    }
}
