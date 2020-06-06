<?php

namespace App\Http\Controllers\Api\Crm;

use App\Bids;
use App\Clients;
use App\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Services;
use Illuminate\Support\Facades\Auth;

class BidsController extends Controller{

      public function bidLastDay(Request $request)
      {
            $bids = Bids::where('workshopID', $request->user()->workshop->workshopID)->get();

            $res = $this->getBids($bids);

            return response()->json($res,200);
             
      }

      public function index(Request $request){
            if($request->user()->permission!='admin'){
                  $employeeID = $request->user()->employee->employeeID;
                  $workshopID = $request->user()->employee->workshopID;     

                  $bids = Bids::where([
                        ['workshopID', $workshopID],
                        ['employeeID',$employeeID]
                        ])->get();

                  
                  $res = $this->getBids($bids);

                  return response()->json($res,200);
            }

            $bids = Bids::where('workshopID', $request->user()->workshop->workshopID)->get();

            $res = $this->getBids($bids);


            return response()->json($res,200);
      }

      public function store(Request $request){
            
            if($request->user()->permission!='admin'){
                  $clientID = $request->clientID;
                  $workshopID = $request->user()->employee->workshop->workshopID;
                  $employeeID = $request->user()->employee->employeeID;
                  $serviceID = $request->serviceID;
                  $carID = $request->carID;
                  $datetime = $request->datetime;
                  $time = $request->time;
                  $duration = $request->duration;
                  $comment = $request->comment;
      
                  $bidModel = new Bids();
                  $bidModel->clientID = $clientID;
                  $bidModel->workshopID = $workshopID;
                  $bidModel->employeeID = $employeeID;
                  $bidModel->serviceID = $serviceID;
                  $bidModel->carID = $carID;
                  $bidModel->datetime = $datetime;
                  $bidModel->duration = $duration;
                  $bidModel->clientName = Clients::find($clientID)->name;
                  $bidModel->employeeName = Employees::find($employeeID)->user->name;
                  $bidModel->serviceName = Services::find($serviceID)->name;
                  $bidModel->servicePrice = Services::find($serviceID)->price;
                  $bidModel->time = $time;
                  $bidModel->comment = $comment;
                  $bidModel->type = Bids::IN_PROGRESS;
      
                  $bidModel->save();
                  return response()->json([
                        'message'=>'success'
                  ], 200);
            }
            else{
                  $clientID = $request->clientID;
                  $workshopID = Auth::user()->workshop->workshopID;
                  $employeeID = $request->employeeID;
                  $serviceID = $request->serviceID;
                  $carID = $request->carID;
                  $datetime = $request->datetime;
                  $time = $request->time;
                  $duration = $request->duration;
                  $comment = $request->comment;
      
                  $bidModel = new Bids();
                  $bidModel->clientID = $clientID;
                  $bidModel->workshopID = $workshopID;
                  $bidModel->employeeID = $employeeID;
                  $bidModel->serviceID = $serviceID;
                  $bidModel->carID = $carID;
                  $bidModel->datetime = $datetime;
                  $bidModel->duration = $duration;
                  $bidModel->clientName = Clients::find($clientID)->name;
                  $bidModel->employeeName = Employees::find($employeeID)->user->name;
                  $bidModel->serviceName = Services::find($serviceID)->name;
                  $bidModel->servicePrice = Services::find($serviceID)->price;
                  $bidModel->time = $time;
                  $bidModel->comment = $comment;
                  $bidModel->type = Bids::IN_PROGRESS;
      
                  $bidModel->save();
                  return response()->json([
                        'message'=>'success'
                  ], 200);
            }
            
      }

      public function update(Request $request){

            if($request->user()->permission!='admin'){
                  $bidID = $request->bidID;
                  $clientID = $request->clientID;
                  $employeeID = $request->employeeID;
                  $serviceID = $request->serviceID;
                  $carID = $request->carID;
                  $datetime = Carbon::parse($request->datetime)->format('Y-m-d H:m:s');
                  $time = $request->time;
                  $duration = $request->duration;
                  $comment = $request->comment ?? '';
                  $type = $request->type;
      
                  $bidModel = Bids::find($bidID);
                  $bidModel->clientID = $clientID ?? $bidModel->clientID;
                  $bidModel->employeeID = $employeeID ?? $bidModel->employeeID;
                  $bidModel->serviceID = $serviceID ?? $bidModel->serviceID;
                  $bidModel->carID = $carID ?? $bidModel->carID;
                  $bidModel->datetime = $datetime ?? $bidModel->datetime;
                  $bidModel->duration = $duration ?? $bidModel->duration;
                  $bidModel->time = $time ?? $bidModel->time;
                  $bidModel->comment = $comment ?? $bidModel->comment;
                  $bidModel->clientName = Clients::find($clientID)->name ?? $bidModel->clientName;
                  $bidModel->employeeName = Employees::find($employeeID)->user->name ?? $bidModel->employeeName;
                  $bidModel->serviceName = Services::find($serviceID)->name ?? $bidModel->serviceName;
                  $bidModel->servicePrice = Services::find($serviceID)->price ?? $bidModel->servicePrice;
                  $bidModel->type = $type ?? $bidModel->type;
      
                  $bidModel->save();
      
                  return response()->json([
                        'message'=>'success'
                  ], 200);
            }
            else{
                  $bidID = $request->bidID;
                  $clientID = $request->clientID;
                  $employeeID = $request->user()->employee->employeeID;
                  $serviceID = $request->serviceID;
                  $carID = $request->carID;
                  $datetime = Carbon::parse($request->datetime)->format('Y-m-d H:m:s');
                  $time = $request->time;
                  $duration = $request->duration;
                  $comment = $request->comment ?? '';
                  $type = $request->type;
      
                  $bidModel = Bids::find($bidID);
                  $bidModel->clientID = $clientID ?? $bidModel->clientID;
                  $bidModel->employeeID = $employeeID ?? $bidModel->employeeID;
                  $bidModel->serviceID = $serviceID ?? $bidModel->serviceID;
                  $bidModel->carID = $carID ?? $bidModel->carID;
                  $bidModel->datetime = $datetime ?? $bidModel->datetime;
                  $bidModel->duration = $duration ?? $bidModel->duration;
                  $bidModel->time = $time ?? $bidModel->time;
                  $bidModel->comment = $comment ?? $bidModel->comment;
                  $bidModel->clientName = Clients::find($clientID)->name ?? $bidModel->clientName;
                  $bidModel->employeeName = Employees::find($employeeID)->user->name ?? $bidModel->employeeName;
                  $bidModel->serviceName = Services::find($serviceID)->name ?? $bidModel->serviceName;
                  $bidModel->servicePrice = Services::find($serviceID)->price ?? $bidModel->servicePrice;
                  $bidModel->type = $type ?? $bidModel->type;
      
                  $bidModel->save();
      
                  return response()->json([
                        'message'=>'success'
                  ], 200);
            }
            
      }

      public function delete(Request $request){
            $bidID = $request->id;

            $bidModel = Bids::find($bidID);

            $bidModel->delete();

            return response()->json([
                  'message'=>'success'
            ], 200);
      }

      private function statusText(String $data){
            $res = '';

            if($data==Bids::READY){
                  $res = 'Выполнена';
            }
            if($data==Bids::IN_PROGRESS){
                  $res = 'В работе';
            }
            if($data==Bids::DENIED){
                  $res = 'Отменена';
            }

            return $res;
      }

      private function getBids($bids){
            $res = [];
                        
            foreach($bids as $bid){
                  $res[] = [
                        'bidID'=>$bid->bidID,
                        'date'=>Carbon::parse($bid->created_at)->format('Y-m-d'),
                        'title'=>$bid->serviceName ?? 'Услуга удалена',
                        'employee'=>$bid->employeeName ?? 'Сотрудник удален',
                        'status'=>$bid->type,
                        'service'=>$bid->serviceID ?? 0,
                        'duration'=> $bid->duration,
                        'price'=>$bid->servicePrice.' ₽' ?? 'Услуга удалена',
                        'time'=>$bid->time,
                        'statusData'=>[
                              'value'=> $bid->type,
                              'text' => $this->statusText($bid->type),
                        ],
                        'comment'=>$bid->comment ?? '',
                        'employeeData'=>[
                              'employeeID'=>$bid->employee->employeeID ?? 'Сотрудник удален',
                              'employeeName'=>$bid->employee->user->name ?? 'Сотрудник удален'
                        ],
                        'car'=>[
                              'carID'=>$bid->car->carID,
                              'carName'=>$bid->car->mark->name.' '.$bid->car->model,
                        ],
                        'client'=>[
                              'name'=>$bid->clientName ?? 'test',
                              'email'=>$bid->client->email ?? 'Не указан',
                              'phone'=>$bid->client->phone ?? 'Удален',
                              'comment'=>$bid->comment ?? 'Без комментария',
                              'date'=> Carbon::parse($bid->datetime)->format('Y-m-d').', '.$bid->time,
                              'car'=> $bid->car->mark->name.' '.$bid->car->model
                        ],
                        'clientData'=>[
                              'clientID'=>$bid->client->clientID ?? 0,
                              'clientName'=>$bid->clienName ?? $bid->client ? $bid->client->name : $bid->clientName,
                        ],
                        'serviceData'=>[
                              'serviceID'=>$bid->service->serviceID ?? 0,
                              'serviceName'=>$bid->service ? $bid->service->name.', '.$bid->service->price : 'Услуга удалена'
                        ],
                  ];
            }

            return $res;

      }

}