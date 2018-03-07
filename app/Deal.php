<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    protected $fillable = [
        'title',
        'company',
        'stage',
        'amount',
        'closing_date',
        'user_id'
    ];
}
