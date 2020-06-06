<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoodsCategories extends Model
{
    const emptyCategory = 'Без категории';

    protected $primaryKey = 'goodCategoryID';
    protected $fillable  = ['name', 'workshopID'];
    protected $hidden = ['updated_at', 'created_at'];

    public function goods(){
        return $this->hasMany('App\Goods','categoryID','goodCategoryID');
    }
}
