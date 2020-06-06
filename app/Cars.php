<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cars extends Model
{
    protected $primaryKey = 'carID';
    protected $fillable = ['carID', 'markID', 'model', 'year', 'engine'];
    protected $hidden = ['updated_at', 'created_at'];

    public function mark(){
        return $this->hasOne('App\Marks','markID','markID');
    }
}
