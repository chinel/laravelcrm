<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable = [
        'firstname',
        'lastname',
        'position',
        'email',
        'phone',
        'status'
    ];
}
