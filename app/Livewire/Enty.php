<?php

namespace App\Livewire;


use Livewire\Component;
use App\Models\Received;
use App\Rules\UniqueBlNo;
use Illuminate\Support\Facades\DB;
use App\Models\Enty as EntyDocument;
use Illuminate\Support\Facades\Validator;

class Enty extends Component
{
    public $enty = [];

    public $importer_name;
    public $goods_name;
    public $quantity;
    public $pkgs_code;
    public $vessel;
    public $bl_no;
    public $container_no;
    public $container_size;
    public $lc_number;
    public $lc_date;
    public $gross_weight;
    public $arivel_date;
    public $formShow = false;
    public $updateId = null;

    /**
     * Data Create
     */
    public function createEnty()
    {
        $this->validate([
            'importer_name'  => 'required',
            'goods_name'     => 'required',
            'quantity'       => 'required',
            'bl_no'          => 'nullable|unique:enties',
            'lc_number'      => 'required'
        ]);

        EntyDocument::create([
            "importer_name"      => $this->importer_name,
            "goods_name"         => $this->goods_name,
            "quantity"           => $this->quantity,
            "pkgs_code"          => $this->pkgs_code,
            "vessel"             => $this->vessel,
            "bl_no"              => $this->bl_no,
            "container_no"       => $this->container_no,
            "container_size"     => $this->container_size,
            "lc_number"          => $this->lc_number,
            "lc_date"            => $this->lc_date,
            "gross_weight"       => $this->gross_weight,
            "arivel_date"        => $this->arivel_date,
        ]);
        $this->reset();
        $this->mount();
        session()->flash('success', 'Document Create Successful.');
    }

    /**
     * All Data Show
     */
    public function mount()
    {
        $this->enty = EntyDocument::get();
    }

    /**
     * Edit Data 
     */

    public function editToEnty($id)
    {
        $this->formShow = true;
        $enty = EntyDocument::findOrFail($id);

        $this->importer_name        = $enty->importer_name;
        $this->goods_name           = $enty->goods_name;
        $this->quantity             = $enty->quantity;
        $this->pkgs_code            = $enty->pkgs_code;
        $this->vessel               = $enty->vessel;
        $this->bl_no                = $enty->bl_no;
        $this->container_no         = $enty->container_no;
        $this->container_size       = $enty->container_size;
        $this->lc_number            = $enty->lc_number;
        $this->lc_date              = $enty->lc_date;
        $this->gross_weight         = $enty->gross_weight;
        $this->arivel_date          = $enty->arivel_date;
        $this->updateId             = $id;
    }

    /**
     * Update Data
     */

    public function updateEnty($id)
    {
        $enty = EntyDocument::findOrFail($id);

        $enty->importer_name        = $this->importer_name;
        $enty->goods_name           = $this->goods_name;
        $enty->quantity             = $this->quantity;
        $enty->pkgs_code            = $this->pkgs_code;
        $enty->vessel               = $this->vessel;
        $enty->bl_no                = $this->bl_no;
        $enty->container_no         = $this->container_no;
        $enty->container_size       = $this->container_size;
        $enty->lc_number            = $this->lc_number;
        $enty->lc_date              = $this->lc_date;
        $enty->gross_weight         = $this->gross_weight;
        $enty->arivel_date          = $this->arivel_date;
        $enty->update();
        $this->reset();
        $this->mount();
        session()->flash('success', 'Document Update Successful.');
    }



    /**
     * Move All Enty Data Received Page...
     */
    public function moveToReceived($id)
    {
        DB::transaction(function () use ($id) {

            $enty = EntyDocument::findOrFail($id);
            // All Table ar Bl Valadation
            $this->bl_no = $enty->bl_no;
            $this->validate([
                'bl_no' => 'nullable',
            ]);
            $exists =
                DB::table('receiveds')->where('bl_no', $this->bl_no)->exists() ||
                DB::table('registers')->where('bl_no', $this->bl_no)->exists() ||
                DB::table('deliveries')->where('bl_no', $this->bl_no)->exists() ||
                DB::table('assessments')->where('bl_no', $this->bl_no)->exists();
            if ($exists) {
                $this->addError('bl_no', 'BL No already exists in another record.');
                return;
            }

            //Create Data With Received Page
            Received::create([
                'importer_name'      => $enty->importer_name,
                'goods_name'         => $enty->goods_name,
                'quantity'           => $enty->quantity,
                'pkgs_code'          => $enty->pkgs_code,
                'vessel'             => $enty->vessel,
                'bl_no'              => $enty->bl_no,
                'container_no'       => $enty->container_no,
                'container_size'     => $enty->container_size,
                'lc_number'          => $enty->lc_number,
                'lc_date'            => $enty->lc_date,
                'gross_weight'       => $enty->gross_weight,
                'arivel_date'        => $enty->arivel_date,
                'document_receiver'  => now(),
            ]);

            //Delete from New enty
            $enty->delete();
            $this->mount();
            session()->flash('success', 'Enty Data moved to Received page successfully!');
            return $this->redirect('/received', navigate: true);
        });
    }


    public function render()
    {
        return view('livewire.enty');
    }
}
