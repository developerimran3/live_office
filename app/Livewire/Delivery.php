<?php

namespace App\Livewire;



use App\Models\Delivery as DeliveryDocument;
use App\Traits\FileUpload;
use Barryvdh\DomPDF\Facade\PDF;
use Livewire\Component;
use Livewire\WithFileUploads;

class Delivery extends Component
{
    use WithFileUploads, FileUpload;

    public $delivery;
    public $document;
    public $bl_no;
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
        $this->bl_no       = ' BL- ' . $delivery->bl_no;
        $this->importer_name    = $delivery->importer_name;
        $this->be_no            = ' C- ' . $delivery->be_no;
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

        $this->reset();
        $this->mount();
        session()->flash('success', 'Document updated successfully!');
    }



    public function mount()
    {
        $this->delivery = DeliveryDocument::get();
    }

    public function deleteDelivery($id)
    {
        $delivery = DeliveryDocument::findOrFail($id);

        $delivery->delete();
        session()->flash('success', 'Document deleted successfully!');
        $this->mount();
    }


    public function render()
    {
        return view('livewire.delivery')
            ->layout('layouts.app', ['title' => 'Delivery']);
    }





    public function downloadPdf($id)
    {
        $data = DeliveryDocument::findOrFail($id);

        $pdf = PDF::loadView('pdf.document', [
            'data' => $data
        ]);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'document-' . $data->be_no . '.pdf');
    }
}
