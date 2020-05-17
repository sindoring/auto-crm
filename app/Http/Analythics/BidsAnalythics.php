<?php

namespace App\Http\Analythics;

use App\User;
use Carbon\Carbon;

class BidsAnalythics{

      public function __construct(User $user)
      {
            $this->model = $user->workshop;
      }

      public function lastDayStatistic(){
            return [
                  'bidsCount'=> [
                        'count'=> $this->lastBids()->count(),
                        'analytics'=> $this->analythics(),
                  ],
                  'lastBids' => $this->lastDayBids()
            ];
      }

      private function lastBids(){
            return $this->model->bids;
      }

      private function lastDayBids(){
            return $this->model->bids->where('created_at','>',Carbon::now()->subDay());
      }

      private function analythics(){

            $bidsCount = $this->lastBids()->count();
            $bidsCountLastDay = $this->lastDayBids()->count();

            if($bidsCount>$bidsCountLastDay){
                  return [
                        'status'=>'grow',
                        'color'=>'#60BD68'
                  ];
            }
            else if($bidsCountLastDay > $bidsCount){
                  return [
                        'status'=>'low',
                        'color'=>'#f36363'
                  ];
            }
            else{
                  return [
                        'status'=>'static',
                        'color'=>'#adadad'
            ];
            }
      }

}