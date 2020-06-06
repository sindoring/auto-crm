<?php

namespace App\Http\Controllers\Api\Crm;

use Auth;
use App\Goods;
use App\GoodsCategories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodsController extends Controller{

      public function index(Request $request){
            $user = $request->user();

            $userWorkshopGoodsCategories = $user->workshop->goodsCategories;

            $res = [];
            foreach($userWorkshopGoodsCategories as $goodCategory){
                  $res[] = [
                        'category'=>[
                              'id'=>$goodCategory->goodCategoryID,
                              'name'=>$goodCategory->name,
                        ],
                        'goods'=>$goodCategory->goods
                  ];
            };


            return response()->json($res);
      }

      public function createCategory(Request $request){
            $user = $request->user();

            if(GoodsCategories::where('name',$request->name)->first()!=null){
                  return response()->json(['message'=>'exists']);
            }

            $goodCategory = new GoodsCategories();
            $goodCategory->name = $request->name;
            $goodCategory->workshopID = Auth::user()->workshop->workshopID;

            $goodCategory->save();

            return response()->json(['message'=>'success'], 201);
      }

      public function editCategory(Request $request){

            $user = $request->user();

            $goodCategory = GoodsCategories::find($request->goodCategoryID);

            if($goodCategory->name != $request->name){
                  if(GoodsCategories::where('name',$request->name)->first()!=null){
                        return response()->json(['message'=>'exists']);
                  }
            }

            $goodCategory->name = $request->name;

            $goodCategory->save();

            return response()->json(['message'=>'success'], 201);
      }

      public function deleteCategory(Request $request){

            $goodCategory = GoodsCategories::find($request->id);

            if(!$goodCategory){
                  return response()->json(['message'=>'not exists']);
            }

            $goodCategoryGoods = $goodCategory->goods;
            if($goodCategoryGoods){
                  foreach($goodCategoryGoods as $good){
                        $good->delete();
                  }
            }

            $goodCategory->delete();

            return response()->json(['message'=>'success'], 201);
      }

      public function createGood(Request $request){
            $user = $request->user();

            if(Goods::where('article',$request->article)->first()!=null){
                  return response()->json(['message'=>'exists']);
            }

            $good = new Goods();

            $good->name = $request->name;
            $good->count = $request->count;
            $good->price = $request->price;
            $good->article = $request->article;
            $good->categoryID = $request->categoryID;
            $good->workshopID = Auth::user()->workshop->workshopID;

            $good->save();

            return response()->json(['message'=>'success'], 201);
      }

      public function editGood(Request $request){
            $good = Goods::find($request->goodID);

            if($good->article != $request->article){
                  if(Goods::where('article',$request->article)->first()!=null){
                        return response()->json(['message'=>'exists']);
                  }
            }

            $name = $good->name;
            $price = $good->name;
            $count = $good->count;

            $good->name = $request->name ?? $name;
            $good->price = $request->price ?? $price;
            $good->count = $request->count ?? $count;

            $good->save();

            return response()->json(['message'=>'success'], 201);
      }

      public function deleteGood(Request $request){
            $good = Goods::find($request->id);
            if(!$good){
                  return response()->json(['message'=>'not exists']);
            }

            $good->delete();

            return response()->json(['message'=>'success'], 201);
      }
}