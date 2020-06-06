<?php

namespace App\Http\Controllers\Api\Crm;

use Auth;
use App\Bids;
use App\User;
use App\Services;
use Carbon\Carbon;
use App\ServiceCategories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Analythics\BidsAnalythics;

class ServicesController extends Controller{

      public function index(Request $request)
      {
            $user = $request->user();

            $userWorkshopServiceCategories = $user->workshop->serviceCategories;

            $res = [];
            foreach($userWorkshopServiceCategories as $serviceCategory){
                  $res[] = [
                        'category'=>[
                              'id'=>$serviceCategory->serviceCategoryID,
                              'name'=>$serviceCategory->name,
                        ],
                        'services'=>$serviceCategory->services
                  ];
            };


            return response()->json($res);
      }

      public function createCategory(Request $request){
            
            $user = $request->user();

            if(ServiceCategories::where('name',$request->name)->first()!=null){
                  return response()->json(['message'=>'exists']);
            }

            $serviceCategory = new ServiceCategories();
            $serviceCategory->name = $request->name;
            $serviceCategory->workshopID = Auth::user()->workshop->workshopID;

            $serviceCategory->save();

            return response()->json(['message'=>'success'], 201);
      }

      public function editCategory(Request $request){
            
            $user = $request->user();

            $serviceCategory = ServiceCategories::find($request->serviceCategoryID);

            if($serviceCategory->name != $request->name){
                  if(ServiceCategories::where('name',$request->name)->first()!=null){
                        return response()->json(['message'=>'exists']);
                  }
            }

            $serviceCategory->name = $request->name;
            $serviceCategory->workshopID = Auth::user()->workshop->workshopID;

            $serviceCategory->save();

            return response()->json(['message'=>'success'], 201);
      }

      public function deleteCategory(Request $request){
            
            $serviceCategory = ServiceCategories::find($request->id);

            if(!$serviceCategory){
                  return response()->json(['message'=>'not exists']);
            }

            $serviceCategoryServices = $serviceCategory->services;
            if($serviceCategoryServices){
                  foreach($serviceCategoryServices as $service){
                        $service->delete();
                  }
            }

            $serviceCategory->delete();

            return response()->json(['message'=>'success'], 201);
      }

      public function createService(Request $request){
            
            $user = $request->user();

            if(Services::where('name',$request->name)->first()!=null){
                  return response()->json(['message'=>'exists']);
            }

            $serviceCategory = new Services();

            $serviceCategory->name = $request->name;
            $serviceCategory->categoryID = $request->categoryID;
            $serviceCategory->price = $request->price;
            $serviceCategory->workshopID = Auth::user()->workshop->workshopID;

            $serviceCategory->save();

            return response()->json(['message'=>'success'], 201);
      }

      public function editService(Request $request){
            

            $service = Services::find($request->serviceID);

            if($service->name != $request->name){
                  if(Services::where('name',$request->name)->first()!=null){
                        return response()->json(['message'=>'exists']);
                  }
            }


            $name = $service->name;
            $price = $service->name;

            $service->name = $request->name ?? $name;
            $service->price = $request->price ?? $price;

            $service->save();

            return response()->json(['message'=>'success'], 201);
      }

      public function deleteService(Request $request){
            $service = Services::find($request->id);
            if(!$service){
                  return response()->json(['message'=>'not exists']);
            }

            $service->delete();

            return response()->json(['message'=>'success'], 201);
      }
}