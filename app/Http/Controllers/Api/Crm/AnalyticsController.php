<?php

namespace App\Http\Controllers\Api\Crm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Analythics\BidsAnalythics;

class AnalyticsController extends Controller
{
    public function bids(Request $request){
        
        $user = $request->user();

        $bidsAnalythics = new BidsAnalythics($user);
        
        return response()->json($bidsAnalythics->lastDayStatistic());
    }
}
