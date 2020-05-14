<?php

namespace App\Http\Controllers\Api\Crm;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller{

      public function index(Request $request)
      {
            $user = $request->user();
            $userWorkshop = $user->workshop;

            $result = [
                  'name'=> $user->name != '' ? $user->name : "Пользователь #$user->userID",
                  'workshopName' => $userWorkshop->name != '' ? $userWorkshop->name : "Мастерская #$userWorkshop->workshopID",
                  'roleName'=> $user->role->name
            ];

            return response()->json($result);
      }
}