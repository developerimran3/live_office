<?php

namespace App\Livewire;

use Livewire\Component;

class PortBill extends Component
{


    public $rate;
    public $qty = 1;
    public $days;

    public $exchange = 122.70;

    public $port = 0;
    public $vat = 0;
    public $mlwf = 0;
    public $gross = 0;

    public function updated()
    {
        $this->calculate();
    }

    public function calculate()
    {
        $this->port = $this->rate * $this->qty * $this->days * $this->exchange;
        $this->vat  = $this->port * 0.15;
        $this->mlwf = $this->port * 0.04;

        $this->gross = $this->port + $this->vat + $this->mlwf;
    }
    public function render()
    {
        return view('livewire.port-bill');
    }
}
