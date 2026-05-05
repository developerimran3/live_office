<?php

namespace App\Livewire;

use App\Models\Enty;
use Livewire\Component;
use App\Models\Delivery;
use App\Models\Received;
use App\Models\Register;
use App\Models\Assessment;

class Dashboard extends Component
{
    public $enty;
    public $receiveds;
    public $registers;
    public $assessments;
    public $delivery;

    public function mount()
    {
        $this->enty = Enty::get();
        $this->receiveds = Received::get();
        $this->registers = Register::get();
        $this->assessments = Assessment::get();
        $this->delivery = Delivery::get();
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
