<?php

namespace App\Http\Controllers\Price;

use App\Http\Controllers\Controller;
use App\Models\Price\Price;
use App\Models\Product\Product;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function index(){
        $data['results'] = NULL;
        $products = Product::with('price')->get();
        $data['products'] = $products;
        return view('backend.price.index', $data);
    }

    public function edit($id){
        $product = Product::with(['price','stock'])->where('id', $id)->first();
        $data['product'] = $product;
        return view('backend.price.edit', $data);
    }

    public function update(Request $request, $id){
        $price = Price::where('product_id', $id)->first();
        $price->usd = $request->usd;
        $price->zwl = $request->zwl;
        $price->save();

        return redirect()->route('admin.price.index');
    }
}
