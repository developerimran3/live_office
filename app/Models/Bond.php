<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bond extends Model
{
    protected $fillable = [
        'goods_name',
        'availability',
        'used',
        'balance',
    ];
}
