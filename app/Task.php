<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'duedate',
        'description',
        'status',
        'user_id'
    ];
}
