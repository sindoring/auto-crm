<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bids extends Model
{
    /**
     * Константы состояния заявки
     */
    const NOT_READY = 'Не готово';
    const IN_PROGRESS = 'В работе';
    const READY = 'Готово';

    protected $primaryKey = 'bidID';
    protected $fillable = ['clientID', 'workshopID', 'serviceID', 'employeeID', 'carID', 'datetime', 'duration', 'type', 'comment'];
    protected $hidden = ['updated_at', 'created_at'];

    public function client(){
        return $this->hasOne('App\Clients', 'clientID', 'clientID');
    }

    public function workshop(){
        return $this->hasOne('App\Workshops','workshopID','workshopID');
    }

    public function employee(){
        return $this->hasOne('App\Employees','employeeID','employeeID');
    }

    public function service(){
        return $this->hasOne('App\Services','serviceID', 'serviceID');
    }

    public function car(){
        return $this->hasOne('App\Cars','carID', 'carID');
    }
}
