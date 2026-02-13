<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\EntyItem;
use App\Models\Received;
use App\Models\EntyContainer;
use Illuminate\Support\Facades\DB;
use App\Models\Enty as EntyDocument;

class Enty extends Component
{
    public $enty = [];
    public $items = [];
    public $containers = [];

    public $importer_name, $pkgs_code, $vessel,
        $bl_no,
        $lc_number, $lc_date, $gross_weight, $arivel_date;

    public $updateId = null;
    public $formShow = false;

    /* ================= LOAD DATA ================= */
    public function mount()
    {
        $this->enty = EntyDocument::with('items')->get();

        $this->items = [
            ['goods_name' => '', 'quantity' => '']
        ];

        $this->containers = [
            ['container_no' => '', 'container_size' => '']
        ];

        $this->resetFormArrays();
    }

    /* ================= ITEMS ADD/REMOVE ================= */
    public function addItem()
    {
        $this->items[] = ['goods_name' => '', 'quantity' => ''];
    }

    public function removeItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);
    }

    /* ================= CONTAINER ADD/REMOVE ================= */
    public function addContainer()
    {
        $this->containers[] = ['container_no' => '', 'container_size' => ''];
    }

    public function removeContainer($index)
    {
        unset($this->containers[$index]);
        $this->containers = array_values($this->containers);
    }

    private function resetFormArrays()
    {
        $this->items = [['goods_name' => '', 'quantity' => '']];
        $this->containers = [['container_no' => '', 'container_size' => '']];
    }



    /* ================= CREATE ================= */
    public function createEnty()
    {

        $enty = EntyDocument::create([
            "importer_name"  => $this->importer_name,
            "pkgs_code"      => $this->pkgs_code,
            "vessel"         => $this->vessel,
            "bl_no"          => $this->bl_no,
            "lc_number"      => $this->lc_number,
            "lc_date"        => $this->lc_date,
            "gross_weight"   => $this->gross_weight,
            "arivel_date"    => $this->arivel_date,
        ]);

        foreach ($this->items as $item) {
            EntyItem::create([
                'enty_id'    => $enty->id,
                'goods_name' => $item['goods_name'],
                'quantity'   => $item['quantity'],
            ]);
        };

        foreach ($this->containers as $container) {
            EntyContainer::create([
                'enty_id'           => $enty->id,
                'container_no'      => $container['container_no'],
                'container_size'    => $container['container_size'],
            ]);
        };



        $this->reset();
        $this->mount();
        session()->flash('success', 'Created successfully');
    }

    /* ================= EDIT ================= */
    public function editToEnty($id)
    {
        $this->formShow = true;

        $enty = EntyDocument::with('items')->findOrFail($id);


        $this->updateId = $id;

        $this->importer_name = $enty->importer_name;
        $this->pkgs_code = $enty->pkgs_code;
        $this->vessel = $enty->vessel;
        $this->bl_no = $enty->bl_no;
        $this->lc_number = $enty->lc_number;
        $this->lc_date = $enty->lc_date;
        $this->gross_weight = $enty->gross_weight;
        $this->arivel_date = $enty->arivel_date;

        $this->items = [];
        $this->containers = [];

        foreach ($enty->items as $item) {
            $this->items[] = [
                'goods_name' => $item->goods_name,
                'quantity' => $item->quantity
            ];
        }
        //container
        foreach ($enty->containers as $container) {
            $this->containers[] = [
                'container_no'   => $container->container_no,
                'container_size' => $container->container_size
            ];
        }
    }

    /* ================= UPDATE ================= */
    public function updateEnty()
    {
        DB::transaction(function () {

            $enty = EntyDocument::findOrFail($this->updateId);

            $enty->update([
                "importer_name"  => $this->importer_name,
                "pkgs_code"      => $this->pkgs_code,
                "vessel"         => $this->vessel,
                "bl_no"          => $this->bl_no,
                "lc_number"      => $this->lc_number,
                "lc_date"        => $this->lc_date,
                "gross_weight"   => $this->gross_weight,
                "arivel_date"    => $this->arivel_date,
            ]);

            // delete old items
            EntyItem::where('enty_id', $enty->id)->delete();

            // insert new items
            foreach ($this->items as $item) {
                EntyItem::create([
                    'enty_id' => $enty->id,
                    'goods_name' => $item['goods_name'],
                    'quantity' => $item['quantity'],
                ]);
            }

            EntyContainer::where('enty_id', $enty->id)->delete();

            // insert new containers
            foreach ($this->containers as $container) {
                EntyContainer::create([
                    'enty_id'        => $enty->id,
                    'container_no'   => $container['container_no'],
                    'container_size' => $container['container_size'],
                ]);
            }
        });

        $this->resetForm();
        session()->flash('success', 'Updated successfully');
    }

    /* ================= DELETE ================= */
    public function deleteEnty($id)
    {
        EntyDocument::findOrFail($id)->delete();

        session()->flash('success', 'Deleted successfully');

        $this->mount();
    }

    /* ================= MOVE TO RECEIVED ================= */
    public function moveToReceived($id)
    {
        DB::transaction(function () use ($id) {

            $enty = EntyDocument::with(['items', 'containers'])->findOrFail($id);

            Received::create([
                'importer_name' => $enty->importer_name,
                'vessel'        => $enty->vessel,
                'bl_no'         => $enty->bl_no,
                'pkgs_code'     => $enty->pkgs_code,
                'lc_number'     => $enty->lc_number,
                'lc_date'       => $enty->lc_date,
                'gross_weight'  => $enty->gross_weight,
                'arivel_date'   => $enty->arivel_date,
                'items' => $enty->items->map(function ($i) {
                    return [
                        'goods_name' => $i->goods_name,
                        'quantity'   => $i->quantity
                    ];
                })->toArray(),

                'containers' => $enty->containers->map(function ($c) {
                    return [
                        'container_no'   => $c->container_no,
                        'container_size' => $c->container_size
                    ];
                })->toArray(),

                'document_receiver' => now(),
            ]);


            $enty->delete();
        });

        session()->flash('success', 'Moved to Received');
        $this->mount();
    }



    /* ================= RESET ================= */
    private function resetForm()
    {
        $this->reset();
        $this->formShow = false;
        $this->mount();
    }

    public function render()
    {
        return view('livewire.enty');
    }
}
