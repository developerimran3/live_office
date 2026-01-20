<?php

namespace App\Livewire;

use App\Models\Enty;
use App\Models\Received;
use App\Models\Register;
use App\Models\Assessment;
use Livewire\Component;

class Dashboard extends Component
{
    public $enty;
    public $receiveds;
    public $registers;
    public $assessments;

    public function mount()
    {
        $this->enty = Enty::get();
        $this->receiveds = Received::get();
        $this->registers = Register::get();
        $this->assessments = Assessment::get();
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
