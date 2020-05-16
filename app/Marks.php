<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marks extends Model
{
    protected $primaryKey = 'markID';
    protected $fillable = ['markID', 'name'];
    protected $hidden = ['updated_at', 'created_at'];
}
