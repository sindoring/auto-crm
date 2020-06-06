<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    protected $primaryKey = 'employeeID';

    protected $fillable = ['userID','workshopID','roleID'];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function workshop(){
        return $this->hasOne('\App\Workshops', 'workshopID', 'workshopID');
    }

    public function user(){
        return $this->hasOne('\App\User', 'userID', 'userID');
    }

    public function role(){
        return $this->hasOne('\App\Roles', 'roleID', 'roleID');
    }

    public function bids(){
        return $this->hasMany('\App\Bids','employeeID','employeeID');
    }
}
