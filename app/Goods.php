<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $primaryKey = 'goodID';
    protected $fillable = ['goodID', 'categoryID', 'workshopID','name','price', 'count', 'article'];
    protected $hidden = ['updated_at','created_at'];

    public function category(){
        return $this->hasOne('App\GoodsCategories','goodID','goodID');
    }
}
