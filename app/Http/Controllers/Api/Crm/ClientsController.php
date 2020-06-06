<?php

namespace App\Http\Controllers\Api\Crm;

use App\Clients;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientsController extends Controller{


      public function index(Request $request)
      {
            $user = $request->user();

            $userWorkshopCleints = $user->workshop->clients;

            $res = [];
            foreach($userWorkshopCleints as $client){
                  $res[] = [
                        'clientID'=>$client->clientID,
                        'title'=>$client->name,
                        'data'=>[
                              'email'=>$client->email,
                              'phone'=>$client->phone,
                              'car'=>[
                                    'carID'=>$client->car->carID,
                                    'carName'=>$client->car->mark->name.' '.$client->car->model
                              ]
                        ]
                  ];
            };


            return response()->json($res);
      }

      public function create(Request $request){

            if(Clients::where('phone',$request->phone)->first()!=null){
                  return response()->json(['message'=>'exists']);
            }

            $client = new Clients([
                  'name'=>$request->name,
                  'phone'=>$request->phone,
                  'email'=>$request->email,
                  'carID'=>$request->carID,
                  'workshopID'=>$request->user()->workshop->workshopID
            ]);

            $client->save();

            return response()->json(['message'=>'success'], 201);
      }

      public function edit(Request $request){
            
            $cleint = Clients::find($request->clientID);

            if(!$cleint){
                  return response()->json(['message'=>'not exists']);
            }


            $cleint->name = $request->name ?? $cleint->name;
            $cleint->phone = $request->phone ?? $cleint->phone;
            $cleint->email = $request->email ?? $cleint->email;
            $cleint->carID = $request->carID ? $request->carID : $cleint->carID ;

            $cleint->save();

            return response()->json(['message'=>'success'], 201);
      }

      public function delete(Request $request){
            
            $cleint = Clients::find($request->id);

            if(!$cleint){
                  return response()->json(['message'=>'not exists']);
            }

            $cleint->delete();
            
            return response()->json(['message'=>'success'], 201);
      }
}