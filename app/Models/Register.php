<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Register extends Model
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
    ];

    // protected static function booted()
    // {
    //     /*
    //     |--------------------------------------------------------------------------
    //     | BE CREATE / UPDATE (FIRST TIME)
    //     |--------------------------------------------------------------------------
    //     */
    //     static::saved(function ($register) {

    //         if (
    //             $register->be_no &&
    //             $register->be_date &&
    //             $register->net_weight &&
    //             !$register->bond_adjusted
    //         ) {
    //             $bond = Bond::where(
    //                 'goods_name',
    //                 $register->goods_name
    //             )->first();

    //             if (!$bond) return;

    //             // minus
    //             $newUsed = $bond->used + $register->net_weight;
    //             $newBalance = $bond->availability - $newUsed;

    //             if ($newBalance < 0) {
    //                 throw new \Exception('Bond balance exceeded');
    //             }

    //             $bond->update([
    //                 'used' => $newUsed,
    //                 'balance' => $newBalance,
    //             ]);

    //             // prevent double minus
    //             $register->updateQuietly([
    //                 'bond_adjusted' => true
    //             ]);
    //         }
    //     });

    //     /*
    //     |--------------------------------------------------------------------------
    //     | BE EDIT (net_weight change)
    //     |--------------------------------------------------------------------------
    //     */
    //     static::updating(function ($register) {

    //         if (
    //             $register->bond_adjusted &&
    //             $register->isDirty('net_weight')
    //         ) {
    //             $bond = Bond::where(
    //                 'goods_name',
    //                 $register->goods_name
    //             )->first();

    //             if (!$bond) return;

    //             // rollback old weight
    //             $bond->used -= $register->getOriginal('net_weight');

    //             // apply new weight
    //             $bond->used += $register->net_weight;
    //             $bond->balance = $bond->availability - $bond->used;

    //             if ($bond->balance < 0) {
    //                 throw new \Exception('Bond balance exceeded');
    //             }

    //             $bond->save();
    //         }
    //     });

    //     /*
    //     |--------------------------------------------------------------------------
    //     | BE DELETE → ROLLBACK
    //     |--------------------------------------------------------------------------
    //     */
    //     static::deleting(function ($register) {

    //         if ($register->bond_adjusted) {
    //             $bond = Bond::where(
    //                 'goods_name',
    //                 $register->goods_name
    //             )->first();

    //             if (!$bond) return;

    //             $bond->used -= $register->net_weight;
    //             $bond->balance = $bond->availability - $bond->used;
    //             $bond->save();
    //         }
    //     });
    // }
}
