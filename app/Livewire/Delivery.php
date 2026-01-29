<?php

namespace App\Livewire;

use Livewire\Component;
use App\Traits\FileUpload;
use Livewire\WithFileUploads;
use App\Models\Delivery as DeliveryDocument;

class Delivery extends Component
{
    use WithFileUploads, FileUpload;

    public $delivery;
    public $document;
    public $quantity;
    public $importer_name;
    public $be_no;

    public $deliveryId;
    public $viewData;
    public $viewItem;


    public function viewDocument($id)
    {
        $this->viewData = DeliveryDocument::find($id);
    }



    /**
     * Edit Data (create ar jonno)
     */
    public function editToDelivery($id)
    {
        $delivery = DeliveryDocument::findOrFail($id);

        $this->document         = $delivery->document;
        $this->quantity         = $delivery->quantity . ' ' . $delivery->pkgs_code;
        $this->importer_name    = $delivery->importer_name;
        $this->be_no            = $delivery->be_no;
        $this->deliveryId       = $id;
    }

    /**
     * Update Data (Create aj jonno data)
     */

    public function updateDelivery($id)
    {
        $delivery = DeliveryDocument::findOrFail($id);


        $this->validate([
            'document' => 'required|file|mimes:pdf'
        ]);
        // 🔥 BEST PRACTICE FILE HANDLING
        $path = $this->fileUpload(
            $this->document,
            $delivery->document,
            'documents',
            $delivery->be_no // filename base
        );

        $delivery->update([
            'document'           => $path,
        ]);

        $this->reset('document');
        $this->mount();
        session()->flash('success', 'Document updated successfully!');
    }



    public function mount()
    {
        $this->delivery = DeliveryDocument::get();
    }

    public function render()
    {
        return view('livewire.delivery');
    }
}
