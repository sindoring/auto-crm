<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Workshops extends Model
{
    
    protected $table = 'workshops';
    
    protected $primaryKey = 'workshopID';

    protected $fillable = ['userID', 'name', 'address'];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function user(){
        return $this->hasOne('App\User', 'userID', 'userID');
    }

    public function employees(){
        return $this->hasMany('App\Employees', 'workshopID', 'workshopID');
    }

    public function bids(){
        return $this->hasMany('App\Bids', 'workshopID','workshopID');
    }

    public function services(){
        return $this->hasMany('App\Services', 'workshopID','workshopID');
    }
}
