<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Delivery;

use App\Traits\FileUpload;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use App\Models\Assessment as AssessmentDocument;


class Assessment extends Component
{
    use WithFileUploads, FileUpload;

    public $assessments = '';
    public $container_location;
    public $assessment_date;
    public $r_no;
    public $document;
    public $quantity;
    public $pkgs_code;
    public $assessmentId;


    public $delivery_date;
    public $showDeliveryModal = false;



    /**
     * Edit Data (create ar jonno)
     */
    public function editToAssessment($id)
    {
        $assessment = AssessmentDocument::findOrFail($id);

        $this->assessment_date    = $assessment->assessment_date;
        $this->r_no               = $assessment->r_no;
        $this->document           = $assessment->document;
        $this->quantity           = $assessment->quantity . ' ' . $assessment->pkgs_code;
        $this->container_location = $assessment->container_location;
        $this->assessmentId       = $id;
    }

    /**
     * Update Data (Create aj jonno data)
     */

    public function updateAssessment($id)
    {
        $assessment = AssessmentDocument::findOrFail($id);

        $rules = [
            'r_no'            => 'nullable|unique:assessments,r_no,' . $id,
            'assessment_date' => 'required|date',
        ];

        // শুধু নতুন file এলে validate
        if ($this->document instanceof \Livewire\TemporaryUploadedFile) {
            $rules['document'] = 'file|mimes:pdf|max:5120';
        }

        $this->validate($rules);

        // 🔥 BEST PRACTICE FILE HANDLING
        $path = $this->fileUpload(
            $this->document,
            $assessment->document,
            'documents',
            $assessment->be_no // filename base
        );

        $assessment->update([
            'assessment_date'    => $this->assessment_date,
            'r_no'               => $this->r_no,
            'container_location' => $this->container_location,
            'document'           => $path,
        ]);

        $this->reset('document');
        $this->mount();

        session()->flash('success', 'Document updated successfully!');
    }

    public function confirmMoveToDelivery($id)
    {
        $this->assessmentId = $id;
        $this->delivery_date = now()->format('Y-m-d'); // default date
        $this->showDeliveryModal = true;
    }
    /**
     * Move All Enty Data Recgister Page...
     */
    public function moveToDelivery($id)
    {
        DB::transaction(function () use ($id) {

            $assessment = assessmentDocument::findOrFail($id);

            // All Table ar Bl Valadation
            $this->r_no = $assessment->r_no;
            $this->validate([
                'r_no' => 'nullable',
            ]);
            $exists =
                DB::table('deliveries')->where('r_no', $this->r_no)->exists();
            if ($exists) {
                $this->addError('r_no', 'R No already exists in another record.');
                return;
            }

            Delivery::create([
                //New Enty
                'importer_name'      => $assessment->importer_name,
                'goods_name'         => $assessment->goods_name,
                'quantity'           => $assessment->quantity,
                'pkgs_code'          => $assessment->pkgs_code,
                'vessel'             => $assessment->vessel,
                'bl_no'              => $assessment->bl_no,
                'container_no'       => $assessment->container_no,
                'container_size'     => $assessment->container_size,
                'lc_number'          => $assessment->lc_number,
                'lc_date'            => $assessment->lc_date,
                'gross_weight'       => $assessment->gross_weight,
                'arivel_date'        => $assessment->arivel_date,
                'document_receiver'  => $assessment->document_receiver,
                //Received
                'invoice_value'      => $assessment->invoice_value,
                'invoice_no'         => $assessment->invoice_no,
                'invoice_date'       => $assessment->invoice_date,
                'net_weight'         => $assessment->net_weight,
                'container_location' => $assessment->container_location,
                'rot_no'             => $assessment->rot_no,
                //Register
                'be_no'              => $assessment->be_no,
                'be_date'            => $assessment->be_date,
                'be_lane'            => $assessment->be_lane,
                //Assessment
                'assessment_date'    => $assessment->assessment_date,
                'document'           => $assessment->document,
                'r_no'               => $assessment->r_no,
                'delivery_date'      => $this->delivery_date,

            ]);

            //Delete from Recived Data
            $assessment->delete();
            $this->showDeliveryModal = false;
            $this->mount();
            session()->flash('success', 'Delivery successfully!');
            return $this->redirect('/delivery', navigate: true);
        });
    }

    public function mount()
    {
        $this->assessments = AssessmentDocument::get();
    }
    public function render()
    {
        return view('livewire.assessment');
    }
}
