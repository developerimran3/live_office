<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Janata extends Model
{
    protected $fillable = [
        'type',
        'importer_name',
        'goods_name',
        'be_no',
        'be_date',
        'debit',
        'credit',
        'credit_date',
    ];
}
