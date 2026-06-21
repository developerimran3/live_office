<?php

namespace App\Livewire;

use App\Models\Bond;
use App\Models\Register;
use Livewire\Component;

class BondLicence extends Component
{
    public $goods_name;
    public $availability;
    public $filter_item;

    public $items = [];
    public $allocations = [];
    public $registers = [];
    public $minus_tables = [];


    public function mount()
    {
        $this->loadData();
    }


    public function bondlicence()
    {
        $this->validate([
            'goods_name' => 'required',
            'availability' => 'required|numeric|min:0',
        ]);

        Bond::create([
            'goods_name' => $this->goods_name,
            'availability' => $this->availability,
        ]);

        $this->reset(['goods_name', 'availability']);

        $this->loadData();

        session()->flash('success', 'Bond Added Successfully');
    }


    public function updatedFilterItem()
    {
        $this->loadData();
    }


    public function loadData()
    {
        // Allocation
        $this->allocations = Bond::all();

        // Registers
        $this->registers = Register::all();


        // Items list
        $bondItems = Bond::pluck('goods_name')->toArray();

        $registerItems = Register::pluck('items')
            ->map(function ($items) {

                if (is_string($items)) {
                    $items = json_decode($items, true);
                }

                return collect($items ?? [])
                    ->pluck('goods_name')
                    ->toArray();
            })
            ->flatten()
            ->toArray();


        $this->items = collect(array_merge($bondItems, $registerItems))
            ->filter()
            ->unique()
            ->values()
            ->toArray();


        $this->buildMinusTable();
    }


    public function buildMinusTable()
    {
        $this->minus_tables = [];

        foreach ($this->items as $item_name) {
            // filter
            if ($this->filter_item && $this->filter_item != $item_name) {
                continue;
            }

            // total allocation
            $allocation = $this->allocations
                ->where('goods_name', $item_name)
                ->sum('availability');

            $used = 0;
            $rows = [];

            $registers = $this->registers->sortBy('be_date');

            foreach ($registers as $reg) {
                $items = is_string($reg->items)
                    ? json_decode($reg->items, true)
                    : $reg->items;

                foreach ($items ?? [] as $i) {
                    if ($i['goods_name'] == $item_name) {
                        $used += $i['net_weight'];

                        $rows[] = (object)[
                            'be_no' => $reg->be_no,
                            'be_date' => $reg->be_date,
                            'used' => $i['net_weight'],
                            'balance' => $allocation - $used,
                        ];
                    }
                }
            }

            $this->minus_tables[$item_name] = $rows;
        }
    }


    public function render()
    {
        return view('livewire.bond-licence')
            ->layout('layouts.app', ['title' => 'Bond Management']);
    }
}
