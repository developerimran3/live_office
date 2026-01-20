<?php

namespace App\Livewire;


use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Received as ReceiveDocument;
use App\Models\Register;

class Received extends Component
{
    public $receiveds;

    public $invoice_value;
    public $invoice_no;
    public $invoice_date;
    public $net_weight;
    public $quantity;
    public $pkgs_code;
    public $container_location;
    public $vessel;
    public $rot_no;
    public $bl_no;
    public $receivedId;


    /**
     * Edit Data (create ar jonno)
     */

    public function editToReceived($id)
    {

        $receive = ReceiveDocument::findOrFail($id);

        $this->invoice_value      = $receive->invoice_value;
        $this->invoice_no         = $receive->invoice_no;
        $this->invoice_date       = $receive->invoice_date;
        $this->net_weight         = $receive->net_weight;
        $this->quantity           = $receive->quantity . ' ' . $receive->pkgs_code;
        $this->container_location = $receive->container_location;
        $this->vessel             = $receive->vessel;
        $this->rot_no             = $receive->rot_no;
        $this->receivedId         = $id;
    }

    /**
     * Update Data (Create aj jonno data)
     */
    public function updateReceived($id)
    {
        $this->validate([
            'invoice_value'       => 'required',
            'invoice_no'          => 'required|unique:receiveds,invoice_no,' . $id,
            'invoice_date'        => 'required',
            'net_weight'          => 'required',
            'rot_no'              => 'required',
        ]);

        $receive = ReceiveDocument::findOrFail($id);

        $receive->update([
            'invoice_value'       => $this->invoice_value,
            'invoice_no'          => $this->invoice_no,
            'invoice_date'        => $this->invoice_date,
            'net_weight'          => $this->net_weight,
            'container_location'  => $this->container_location,
            'vessel'              => $this->vessel,
            'rot_no'              => $this->rot_no,
        ]);

        $this->reset();
        $this->mount();

        session()->flash('success', 'Document Update Successful.');
    }


    public function mount()
    {
        $this->receiveds = ReceiveDocument::get();
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
