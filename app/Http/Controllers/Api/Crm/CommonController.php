<?php
namespace App\Http\Controllers\Api\Crm;

use App\Cars;
use App\Clients;
use App\Services;
use App\Employees;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommonController extends Controller{

      public function cars(Request $request){
            $cars = Cars::all();
            $res = [];

            foreach($cars as $car){
                  $res[] = [
                        'carID'=>$car->carID,
                        'carName'=>$car->mark->name.' '.$car->model
                  ];
            }

            return response()->json($res);
      }

      public function services(Request $request){

            $workshopID = '';
            if($request->user()->permission!='admin'){
                  $workshopID = $request->user()->employee->workshopID;
            }
            else{
                  $workshopID = $request->user()->workshop->workshopID;
            }
            $services = Services::where('workshopID', $workshopID)->get();
            $res = [];

            foreach($services as $service){
                  $res[] = [
                        'serviceID'=> $service->serviceID,
                        'serviceName'=> "$service->name, $service->price ₽"
                  ];
            }

            return response()->json($res);
      }

      public function employees(Request $request){

            $workshopID = '';
            if($request->user()->permission!='admin'){
                  $workshopID = $request->user()->employee->workshopID;
            }
            else{
                  $workshopID = $request->user()->workshop->workshopID;
            }
            $employees = Employees::where('workshopID', $workshopID)->get();
            $res = [];

            foreach($employees as $employee){
                  if($employee->user && $employee->user->permission != 'admin'){
                        $res[] = [
                              'employeeID'=> $employee->employeeID,
                              'employeeName'=> $employee->user->name
                        ];
                  }
            }

            return response()->json($res);

      }

      public function clients(Request $request){

            $workshopID = '';
            if($request->user()->permission!='admin'){
                  $workshopID = $request->user()->employee->workshopID;
            }
            else{
                  $workshopID = $request->user()->workshop->workshopID;
            }

            $clients = Clients::where('workshopID', $workshopID)->get();

            $res = [];

            foreach($clients as $client){
                  $res[] = [
                        'clientID'=> $client->clientID,
                        'clientName'=> $client->name
                  ];
            }

            return response()->json($res);
            
      }
}