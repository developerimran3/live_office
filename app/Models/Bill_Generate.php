<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill_Generate extends Model
{
    protected $fillable = [
        'cl_date',
        'w/r_date',
        'upto_date',
        'unstiffing_date',
        'extra_movement',
        'h/c',
        'rpc',
        'qty',
        'usd',
        'cont',
        'dg',
    ];
}
