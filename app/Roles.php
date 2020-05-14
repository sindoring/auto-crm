<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    const owner = 'Владелец';

    protected $primaryKey = 'roleID';

    protected $fillable = ['roleID', 'name', 'workshopID'];

    protected $hidden = [
        'created_at', 'updated_at', 'email_verified_at'
    ];
}
