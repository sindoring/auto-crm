<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoodsCategories extends Model
{
    const emptyCategory = 'Без категории';

    protected $primaryKey = 'goodsCategoryID';
    protected $fillable  = ['name', 'workshopID'];
    protected $hidden = ['updated_at', 'created_at'];
}
