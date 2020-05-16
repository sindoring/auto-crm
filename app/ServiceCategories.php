<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceCategories extends Model
{
    const emptyCategory = 'Без категории';

    protected $primaryKey = 'serviceCategoryID';
    protected $fillable  = ['name', 'workshopID'];
    protected $hidden = ['updated_at', 'created_at'];
}
