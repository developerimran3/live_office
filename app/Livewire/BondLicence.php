<?php

namespace App\Livewire;

use App\Models\Bond;
use Livewire\Component;
use App\Models\Register;

class BondLicence extends Component

{
    public $goods_name;
    public $availability;


    public $registers = [];

    public function mount()
    {
        $this->registers = Register::latest()->get();
    }
    public function bondlicence()
    {
        $this->validate([
            'goods_name'   => 'required',
            'availability' => 'required|numeric|min:1',
        ]);

        Bond::create([
            'goods_name'   => strtoupper($this->goods_name),
            'availability' => $this->availability,
            'used'         => 0,
            'balance'      => $this->availability,
        ]);

        session()->flash('success', 'Bond Licence Created');

        $this->reset(['goods_name', 'availability']);
    }

    public function render()
    {
        return view('livewire.bond-licence');
    }
}
