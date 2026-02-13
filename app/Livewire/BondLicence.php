<?php

namespace App\Livewire;

use App\Models\Bond;
use Livewire\Component;
use App\Models\Register;

class BondLicence extends Component
{
    public $goods_name;
    public $availability;
    public $filter_item;

    public $items = [];        // item names for dropdown
    public $allocations = [];  // Allocation table
    public $minus_tables = []; // Minus tables per item

    public function mount()
    {
        $this->loadItems();
        $this->loadData();
    }

    public function loadItems()
    {
        $this->items = Bond::orderBy('goods_name')->pluck('goods_name')->unique()->toArray();
    }

    public function bondlicence()
    {
        $this->validate([
            'goods_name'   => 'required',
            'availability' => 'required|numeric|min:0',
        ]);

        Bond::create([
            'goods_name'   => $this->goods_name,
            'availability' => $this->availability,
        ]);

        $this->reset(['goods_name', 'availability']);
        $this->loadItems();
        $this->loadData();
    }

    public function updatedFilterItem()
    {
        $this->loadData();
    }

    public function loadData()
    {
        // Allocation table
        $this->allocations = Bond::orderBy('created_at')->get();

        // Build items list from both Bond and Register
        $bond_items = Bond::pluck('goods_name')->toArray();
        $register_items = Register::pluck('goods_name')->toArray();
        $this->items = collect(array_merge($bond_items, $register_items))->unique()->toArray();

        // Minus tables
        $registers = Register::orderBy('be_date')->get();
        $this->minus_tables = [];

        foreach ($this->items as $item_name) {

            // Apply filter
            if ($this->filter_item && $this->filter_item != $item_name) {
                continue;
            }

            $rows = [];
            $total_allocation = $this->allocations
                ->where('goods_name', $item_name)
                ->sum('availability');

            $used_so_far = 0;

            $item_registers = $registers->where('goods_name', $item_name)
                ->sortBy('be_date');

            foreach ($item_registers as $reg) {
                $used_so_far += $reg->net_weight;

                $rows[] = (object)[
                    'goods_name' => $item_name,
                    'be_no'      => $reg->be_no,
                    'be_date'    => $reg->be_date,
                    'used'       => $reg->net_weight,
                    'balance'    => $total_allocation - $used_so_far,
                ];
            }

            $this->minus_tables[$item_name] = $rows;
        }
    }


    public function render()
    {
        return view('livewire.bond-licence');
    }
}
