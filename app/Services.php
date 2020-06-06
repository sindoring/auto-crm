<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $primaryKey = 'serviceID';
    protected $fillable = ['serviceID', 'categoryID', 'workshopID','name','price'];
    protected $hidden = ['updated_at','created_at'];

    public function category(){
        return $this->hasOne('App\ServiceCategories','serviceID','serviceID');
    }
}
