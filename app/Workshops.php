<?php

namespace App;

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
}
