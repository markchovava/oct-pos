<?php

namespace App\Http\Controllers\POS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class POSController extends Controller
{
    public function index(){
        return view('backend.pos.index');
   }
}
