<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'position',
        'description',
        'company_name',
        'company_address',
        'company_website',
        'user_id'
    ];
}
