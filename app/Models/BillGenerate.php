<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillGenerate extends Model
{
    protected $fillable = [
        'port_rate_id',
        'cl_date',
        'wr_date',
        'upto_date',
        'unstf_date',
        'extra_mov',
        'hc',
        'rpc',
        'qty',
        'usd_rate',
        'cont_select',
        'dg_status'
    ];

    public function portRate()
    {
        return $this->belongsTo(PortRate::class);
    }
}
