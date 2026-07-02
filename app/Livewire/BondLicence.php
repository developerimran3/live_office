<?php

namespace App\Livewire;

use App\Models\Bond;
use App\Models\Register;
use Livewire\Component;

class BondLicence extends Component
{
    public $type = '';

    public $be_no = '';
    public $items = [];      // <-- array
    public $be_date = '';
    public $net_weight;  // <-- number
    public $gg_set;  // <-- number
    public $goods_name = '';
    public $allocation = '';
    public $register = [];

    public function mount()
    {

        $usedBeNos = Bond::whereNotNull('be_no')->pluck('be_no');

        $this->register = Register::whereNotIn('be_no', $usedBeNos)->get();
    }


    public function updatedBeNo($value)
    {
        $register = Register::where('be_no', $value)->first();

        if ($register) {

            $this->be_date = $register->be_date;

            $this->items = collect($register->items)->map(function ($item) {
                return [
                    'goods_name' => $item['goods_name'],
                    'net_weight' => $item['net_weight'], // Register-এর value
                    'gg_set'     => $item['gg_set'] ?? '',
                ];
            })->toArray();
        } else {

            $this->items = [];
            $this->be_date = '';
            $this->net_weight = '';
            $this->gg_set = '';
        }
    }




    public function bondlicence()
    {
        if ($this->type == 'MINUS') {

            $this->validate(
                [
                    'be_no' => 'required',
                    'be_date' => 'required|date',
                    'items' => 'required|array|min:1',
                ],
                []
            );

            if (Bond::where('be_no', $this->be_no)->exists()) {
                $this->addError('be_no', 'This B/E Number has already been used.');
                return;
            }

            Bond::create([
                'type'       => 'MINUS',
                'be_no'      => $this->be_no,
                'be_date'    => $this->be_date,
                'goods_name' => null,
                'allocation' => 0,
                'items' => collect($this->items)->map(function ($item) {
                    return [
                        'goods_name'        => $item['goods_name'] ?? '',
                        'net_weight'        => $item['net_weight'] ?? '',
                    ];
                })->toArray(),
            ]);
        } elseif ($this->type == 'STOCK') {

            $this->validate([
                'goods_name' => 'required',
                'allocation' => 'required|numeric|min:1',
            ]);

            Bond::create([
                'type'       => 'STOCK',
                'be_no'      => null,
                'be_date'    => null,
                'goods_name' => $this->goods_name,
                'allocation' => $this->allocation,
                'items'      => null,
            ]);
        }

        session()->flash('success', 'Bond Licence saved successfully.');

        $this->reset([
            'be_no',
            'be_date',
            'items',
            'goods_name',
            'allocation',
            'net_weight',
            'type',
        ]);
    }







    public function render()
    {
        return view('livewire.bond-licence')
            ->layout('layouts.app', ['title' => 'Bond Management']);
    }
}
