<?php

namespace App\Http\Controllers\Api\Crm;

use App\Bids;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Analythics\BidsAnalythics;

class AnalyticsController extends Controller
{
    public function bidsAll(Request $request){
        
        $bidsCount = Bids::where('workshopID', $request->user()->workshop->workshopID)->whereDate('created_at', '>=', Carbon::now()->subDays(1))->count();
        
        return response()->json(['count'=>$bidsCount]);
    }

    public function bidsComplete(Request $request){
        
        $bidsCount = Bids::where('workshopID', $request->user()->workshop->workshopID)->where('type', Bids::READY)->count();
        
        return response()->json(['count'=>$bidsCount]);
    }

    public function bidsDenied(Request $request){
        
        $bidsCount = Bids::where('workshopID', $request->user()->workshop->workshopID)->where('type', Bids::DENIED)->count();;
        
        return response()->json(['count'=>$bidsCount]);
    }

    public function bidsProgress(Request $request){
        
        $bidsCount = Bids::where('workshopID', $request->user()->workshop->workshopID)->where('type', Bids::IN_PROGRESS)->count();;
        
        return response()->json(['count'=>$bidsCount]);
    }
}
