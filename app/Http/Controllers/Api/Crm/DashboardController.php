<?php

namespace App\Http\Controllers\Api\Crm;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller{

      public function index(Request $request)
      {
            return response()->json($request->user());
      }
}