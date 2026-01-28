<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sonali extends Model
{
    protected $fillable = [
        'type',
        'goods_name',
        'be_no',
        'be_date',
        'debit',
        'credit',
        'credit_date',
        'balance',
    ];
}
