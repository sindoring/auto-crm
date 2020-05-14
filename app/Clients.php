<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    protected $primaryKey = 'clientID';

    protected $fillable = ['name', 'phone', 'email'];

    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
