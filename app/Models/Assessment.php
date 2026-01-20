<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assessment extends Model
{

    use SoftDeletes;
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
        'arivel_date',

        //Received doc create Data
        'document_receiver',
        'rot_no',
        'container_location',
        'invoice_value',
        'invoice_no',
        'invoice_date',
        'net_weight',

        //Register Doc Create data
        'be_no',
        'be_date',
        'be_lane',
        //Assessment
        'assessment_date',
        'document',
        'r_no',
    ];
}
