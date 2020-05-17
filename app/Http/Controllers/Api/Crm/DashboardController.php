<?php

namespace App\Http\Controllers\Api\Crm;

use App\Bids;
use App\Http\Analythics\BidsAnalythics;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class DashboardController extends Controller{

      public function index(Request $request)
      {
            $user = $request->user();
            $userWorkshop = $user->workshop;

            $result = [
                  'user'=>[
                        'name'=> $user->name != '' ? $user->name : "Пользователь #$user->userID",
                        'role'=> $user->role->name,
                  ],
                  'workshop'=>[
                        'name' => $userWorkshop->name != '' ? $userWorkshop->name : "Мастерская #$userWorkshop->workshopID",
                        'address' => $userWorkshop->address != '' ? $userWorkshop->address : 'Введите адрес в настройках'
                  ]
            ];

            return response()->json($result);
      }
}