<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Received extends Model
{
    protected $fillable = [
        'importer_name',
        'vessel',
        'bl_no',
        'pkgs_code',
        'lc_number',
        'lc_date',
        'gross_weight',
        'arivel_date',
        'items',
        'containers',

        'document_receiver',
        'rot_no',

        'container_locations',
        'net_weights',

        'invoice_value',
        'invoice_no',
        'invoice_date',
    ];

    protected $casts = [
        'items' => 'array',
        'containers' => 'array',
        'container_locations' => 'array',
        'net_weights' => 'array',
    ];
}
