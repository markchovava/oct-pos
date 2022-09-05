<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Operation\Operation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
   public function index(){
      // User Status
      $auth_id = Auth::user()->id;
      $operation_status = Operation::where('user_id', $auth_id)->first();
      $data['operation_status'] = $operation_status;
      
      return view('backend.dashboard.index', $data);
   }
}
