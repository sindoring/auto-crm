<?php

namespace App\Http\Controllers\Api\Crm;
;
use App\Bids;
use App\User;
use App\Roles;
use App\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller{

      public function index(Request $request)
      {
            $user = $request->user();

            $userWorkshopEmployees = $user->workshop->employees;

            $res = [];
            foreach($userWorkshopEmployees as $workshopEmployee){
                  if($workshopEmployee->user->permission != 'admin'){
                      $readyBids = $workshopEmployee->bids->where('type', Bids::READY);
                      $readyList = [];

                      $totalPrice = 0;
                      foreach($readyBids as $bid){
                        $readyList[] = [
                              'date'=>Carbon::parse($bid->datetime)->format('Y-m-d').', '.$bid->time,
                              'name'=>$bid->serviceName,
                              'price'=>$bid->servicePrice.' ₽'
                        ];
                        $totalPrice+=$bid->servicePrice;
                      }


                      $res[] = [
                              'employeeID'=>$workshopEmployee->employeeID,
                              'name'=>$workshopEmployee->user->name,
                              'role'=>$workshopEmployee->role->name,
                              'phone'=>$workshopEmployee->user->phone,
                              'bids'=>$workshopEmployee->bids->count(),
                              'complete'=>$workshopEmployee->bids->where('type',Bids::READY)->count(),
                              'progress'=>$workshopEmployee->bids->where('type',Bids::IN_PROGRESS)->count(),
                              'denied'=>$workshopEmployee->bids->where('type',Bids::DENIED)->count(),
                              'services'=>[
                                    'list'=>$readyList,
                                    'total'=>$totalPrice
                              ]
                        ];  
                  }
                  
            };

            return response()->json($res);
      }

      public function create(Request $request){
            
            $user = $request->user();

     
            if(User::where('phone',$request->phone)->first()!=null){
                  return response()->json(['message'=>'phone exists']);
            }

            $newEmpoyeeUser = new User();

            $newEmpoyeeUser->name = $request->name;
            $newEmpoyeeUser->phone = $request->phone;
            $newEmpoyeeUser->password = bcrypt($request->password);
            $newEmpoyeeUser->permission = 'employee';

            $newEmpoyeeUser->save();

            if(Roles::where('name',$request->roleName)->first()!=null){
                  $role = Roles::where('name',$request->roleName)->first();
            }else{
                  $role = new Roles();
                  $role->name = $request->roleName;
                  $role->workshopID = $user->workshop->workshopID;
                  $role->save();
            }

            $newEmployee = new Employees();
            $newEmployee->userID = $newEmpoyeeUser->userID;
            $newEmployee->workshopID = $user->workshop->workshopID;
            $newEmployee->roleID = $role->roleID;
            $newEmployee->save();

            return response()->json(['message'=>'success'], 201);
      }

      public function edit(Request $request){

            $employee = Employees::find($request->employeeID);

            if(!$employee){
                  return response()->json(['message'=>'not exists']);
            }

            $user = $employee->user;

            $user->name = $request->name;
            $user->phone = $request->phone;
            if(isset($request->password) && $request->password!=''){
                  $user->password = bcrypt($request->password) ?? $user->password;
            }

            if($user->phone != $request->phone){
                  if(User::where('phone',$request->phone)->first()!=null){
                        return response()->json(['message'=>'exists']);
                  }
            }

            if(Roles::where('name',$request->roleName)->first()!=null){
                  $role = Roles::where('name',$request->roleName)->first();
            }else{
                  $role = new Roles();
                  $role->name = $request->roleName;
                  $role->workshopID = $request->user()->workshop->workshopID;
                  $role->save();
            }

            $role = $employee->role;
            $role->name = $request->roleName ?? $role->name;

            $role->save();
            $user->save();
            return response()->json(['message'=>'success']);

      }

      public function delete(Request $request){
            $employee = Employees::find($request->id);
            $user = $employee->user;

            if(!$employee){
                  return response()->json(['message'=>'employee not exists']);
            }
            

            $employee->delete();
            $user->delete();

            return response()->json(['message'=>'success']);
      }
      
}