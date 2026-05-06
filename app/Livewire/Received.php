<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Received as ReceiveDocument;

class Received extends Component
{
    public $items = [];
    public $containers = [];
    public $receiveds;
    public $receivedId;
    public $total_quantity;
    public $initial_total;
    public $pkgs_code;


    public $invoice_value,  $invoice_no, $invoice_date, $rot_no, $vessel, $bl_no,  $container_location, $net_weight;




    public function mount()
    {
        $this->receiveds = ReceiveDocument::get();
    }

    /**
     * Form Steps
     * Step 1: Basic Information
     * Step 2: Items
     * Step 3: Containers
     * Step 4: Review & Submit
     */
    public $step = 1;
    public function nextStep()
    {
        $this->step++;
    }

    public function prevStep()
    {
        $this->step--;
    }



    public function editToReceived($id)
    {
        $receive = ReceiveDocument::findOrFail($id);

        $this->receivedId = $id;

        // Load basic fields
        $this->invoice_value  = $receive->invoice_value;
        $this->invoice_no     = $receive->invoice_no;
        $this->invoice_date   = $receive->invoice_date;
        $this->rot_no         = $receive->rot_no;


        $this->initial_total = (int) $receive->total_quantity;
        $this->total_quantity = (int) $receive->total_quantity;
        $this->pkgs_code = $receive->pkgs_code;


        $this->vessel         = $receive->vessel;
        $this->bl_no          = $receive->bl_no;

        // Load items JSON
        $this->items = $receive->items ?? [];
        $this->containers = $receive->containers ?? [];
    }



    public $warningMessage = '';
    public function updatedItems()
    {
        $used = 0;

        foreach ($this->items as $item) {
            $used += (int) ($item['item_quantity'] ?? 0);
        }

        $remaining = $this->initial_total - $used;

        if ($remaining < 0) {
            $this->warningMessage = '⚠️ Quantity cannot be more than total!';
            $this->total_quantity = 0;
            return;
        }

        $this->warningMessage = '';
        $this->total_quantity = $remaining;
    }



    public function updateReceived()
    {
        $this->validate([
            'invoice_value' => 'required',
            'invoice_no'    => 'required',
            'invoice_date'  => 'required',
            'rot_no'        => 'required',
        ]);

        $receive = ReceiveDocument::findOrFail($this->receivedId);

        $receive->update([
            'invoice_value' => $this->invoice_value,
            'invoice_no'    => $this->invoice_no,
            'invoice_date'  => $this->invoice_date,
            'rot_no'        => $this->rot_no,
            'vessel'        => $this->vessel,
            'bl_no'         => $this->bl_no,

            'containers'    => $this->containers,
            'items'         => $this->items, // JSON saved automatically
        ]);

        session()->flash('success', 'Document updated successfully!');
        $this->mount();
        $this->receivedId = null;
    }






    /**
     * Move All Enty Data Recgister Page...
     */
    public function moveToRegister($id)
    {
        DB::transaction(function () use ($id) {

            $receive = ReceiveDocument::findOrFail($id);

            // All Table ar Bl Valadation
            $this->invoice_no = $receive->invoice_no;
            $this->validate([
                'invoice_no' => 'nullable',
            ]);
            $exists =
                DB::table('registers')->where('invoice_no', $this->invoice_no)->exists() ||
                DB::table('deliveries')->where('invoice_no', $this->invoice_no)->exists() ||
                DB::table('assessments')->where('invoice_no', $this->invoice_no)->exists();

            if ($exists) {
                $this->addError('invoice_no', 'Invoice No already exists in another record.');
                return;
            }

            //Create Data With Register Page
            Register::create([
                'importer_name'      => $receive->importer_name,
                'goods_name'         => $receive->goods_name,
                'quantity'           => $receive->quantity,
                'pkgs_code'          => $receive->pkgs_code,
                'vessel'             => $receive->vessel,
                'bl_no'              => $receive->bl_no,
                'container_no'       => $receive->container_no,
                'container_size'     => $receive->container_size,
                'lc_number'          => $receive->lc_number,
                'lc_date'            => $receive->lc_date,
                'gross_weight'       => $receive->gross_weight,
                'arivel_date'        => $receive->arivel_date,
                'document_receiver'  => $receive->document_receiver,

                'invoice_value'      => $receive->invoice_value,
                'invoice_no'         => $receive->invoice_no,
                'invoice_date'       => $receive->invoice_date,
                'net_weight'         => $receive->net_weight,
                'container_location' => $receive->container_location,
                'rot_no'             => $receive->rot_no,

            ]);



            //Delete from Recived Data
            $receive->delete();
            $this->mount();
            session()->flash('success', 'Received Data moved to Register page successfully!');
            return $this->redirect('/register', navigate: true);
        });
    }


    public function render()
    {
        return view('livewire.received');
    }
}
