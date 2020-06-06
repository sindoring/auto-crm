<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    protected $primaryKey = 'clientID';

    protected $fillable = ['name','workshopID','phone', 'email','carID'];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function car(){
        return $this->hasOne('App\Cars','carID','carID');
    }
}
