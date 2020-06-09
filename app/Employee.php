<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public $fillable = [
        'first_name',
        'last_name',
        'company_id',
        'email',
        'phone'
    ];
}
