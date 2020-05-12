<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workshops extends Model
{
    protected $table = 'workshops';

    protected $fillable = ['userID', 'name', 'address'];
}
