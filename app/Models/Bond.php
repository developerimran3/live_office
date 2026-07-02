<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bond extends Model
{
    protected $fillable = [
        'type',
        'be_no',
        'be_date',
        'items',
        'allocation',
        'goods_name',
    ];
    protected $casts = [
        'items' => 'array',
    ];
}
