<?php

namespace App\Livewire;


use Carbon\Carbon;
use Livewire\Component;
use App\Models\PortRate;
use App\Models\Bill_Generate;



class PortBillGenarate extends Component

{
    public $cl_date;
    public $unst_date;
    public $wr_date;
    public $upto_date;
    public $ado_dt;
    public $qty;
    public $rate;
    public $extra_mov;
    public $rpc;
    public $hc;
    public $dg;
    public $days;
    public $usd;

    public $cont; // 20fcl, 40fcl, lockfast, warehouse
    public $portRates;

    public $calculated = []; // Calculated table values

    // CL_DT বা UNSTF_DT পরিবর্তন হলে W/R এবং ADO সেট করার জন্য
    public function updatedClDt($value)
    {
        $this->setWrAndAdo($value);
    }
    public function updatedUnstfDt($value)
    {
        $this->setWrAndAdo($value);
    }
    public function setWrAndAdo($value)
    {
        if ($value) {
            $this->wr_date = Carbon::parse($value)->addDays(3)->format('Y-m-d');
            $this->ado_dt = $this->wr_date;
        }
    }

    // UPTO_DT পরিবর্তন হলে দিন বের করা
    public function updatedUptoDt($value)
    {
        if ($this->wr_date && $value) {
            $from = Carbon::parse($this->wr_date);
            $to = Carbon::parse($value);
            $this->days = $from->diffInDays($to);
        }
    }

    public function mount()
    {
        $this->portRates = PortRate::first(); // DB থেকে rate load
    }



    // Form submit
    public function createEnty()
    {
        $this->calculate(); // হিসাব করা

        Bill_Generate::create([
            'cl_date'        => $this->cl_date,
            'wr_date'       => $this->wr_date,
            'upto_date'      => $this->upto_date,
            'unst_date' => $this->unst_date,
            'extra_mov' => $this->extra_mov,
            'hc'            => $this->hc,
            'rpc'            => $this->rpc,
            'qty'            => $this->qty,
            'usd'            => $this->usd,
            'cont'           => $this->cont,
            'dg'             => $this->dg,
        ]);
    }


    // Calculation logic
    public function calculate()
    {
        $rate = $this->selected_container == '40fcl' ? $this->portRates->river_duse_40 : $this->portRates->river_duse_20;
        $lift = $this->selected_container == '40fcl' ? $this->portRates->lift_on_40 : $this->portRates->lift_on_20;
        $storage_1 = $this->dg ? $this->portRates->storage_1st_40_dg : $this->portRates->storage_1st_40;
        $storage_2 = $this->dg ? $this->portRates->storage_2nd_40_dg : $this->portRates->storage_2nd_40;
        $storage_3 = $this->dg ? $this->portRates->storage_3rd_40_dg : $this->portRates->storage_3rd_40;

        // River Dues
        $river_dues = $this->qnty * $rate;

        // Lift On
        $lift_on = $this->qnty * $lift;

        // RPC
        $rpc = $this->rpc * $this->qnty;

        // Store Rent
        $store_rent_1 = ($this->days >= 1 ? 1 * $storage_1 : 0);
        $store_rent_2 = ($this->days >= 2 ? 1 * $storage_2 : 0);
        $store_rent_3 = ($this->days >= 3 ? 1 * $storage_3 : 0);

        $store_rent_total = $store_rent_1 + $store_rent_2 + $store_rent_3;

        // Extra Movement + HC
        $extra_movement = $this->ext_mov;
        $hc             = $this->hc;

        // TOTAL
        $total_port = $river_dues + $lift_on + $rpc + $store_rent_total + $extra_movement + $hc;

        // VAT 15%, MLWF 4%
        $vat  = $total_port * 0.15;
        $mlwf = $total_port * 0.04;

        $this->calculated = [
            'river_dues' => $river_dues,
            'lift_on'    => $lift_on,
            'rpc'        => $rpc,
            'store_rent' => $store_rent_total,
            'extra_mov'  => $extra_movement,
            'hc'         => $hc,
            'total_port' => $total_port,
            'vat'        => $vat,
            'mlwf'       => $mlwf,
        ];
    }














    public function render()
    {
        return view('livewire.port-bill-genarate');
    }
}
