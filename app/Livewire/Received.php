<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Received as ReceiveDocument;

class Received extends Component
{
    public $items = [];
    public $receiveds;
    public $receivedId;

    public $invoice_value, $invoice_no, $invoice_date, $rot_no, $vessel, $bl_no;

    public function mount()
    {
        $this->receiveds = ReceiveDocument::get();
    }

    public function editToReceived($id)
    {
        $receive = ReceiveDocument::findOrFail($id);

        $this->receivedId = $id;

        // Load basic fields
        $this->invoice_value = $receive->invoice_value;
        $this->invoice_no    = $receive->invoice_no;
        $this->invoice_date  = $receive->invoice_date;
        $this->rot_no        = $receive->rot_no;
        $this->vessel        = $receive->vessel;
        $this->bl_no         = $receive->bl_no;

        // Load items JSON
        $this->items = $receive->items ?? [];
    }

    public function addItem()
    {
        $this->items[] = [
            'goods_name' => '',
            'quantity' => '',
            'containers' => [
                ['container_no' => '', 'container_location' => '', 'net_weight' => '']
            ]
        ];
    }

    public function removeItem($i)
    {
        unset($this->items[$i]);
        $this->items = array_values($this->items);
    }

    public function addContainer($i)
    {
        $this->items[$i]['containers'][] = [
            'container_no' => '',
            'container_location' => '',
            'net_weight' => ''
        ];
    }

    public function removeContainer($i, $j)
    {
        unset($this->items[$i]['containers'][$j]);
        $this->items[$i]['containers'] = array_values($this->items[$i]['containers']);
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
