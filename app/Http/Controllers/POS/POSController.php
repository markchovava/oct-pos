<?php

namespace App\Http\Controllers\POS;

use App\Http\Controllers\Controller;
use App\Models\Product\Product;
use Illuminate\Http\Request;

class POSController extends Controller
{
    public function index(){
        return view('backend.pos.index');
   }

    public function searchbyname(Request $request){
        $name = $request->name;
        $data['product'] = Product::with(['stock','price'])->where('name', 'LIKE', '%' . $name . '%')->get();
        return response()->json($data);
    }

}
