<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enty extends Model
{
    protected $fillable = [
        'importer_name',
        'goods_name',
        'quantity',
        'pkgs_code',
        'vessel',
        'bl_no',
        'container_no',
        'container_size',
        'lc_number',
        'lc_date',
        'gross_weight',
        'arivel_date'
    ];
}
