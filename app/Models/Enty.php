<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Enty extends Model
{
    use HasFactory;

    protected $fillable = [
        'importer_name',
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

    public function items()
    {
        return $this->hasMany(EntyItem::class, 'enty_id', 'id');
    }

    public function containers()
    {
        return $this->hasMany(EntyContainer::class, 'enty_id', 'id');
    }
}
