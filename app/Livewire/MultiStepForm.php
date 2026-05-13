<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class MultiStepForm extends Component
{
    // public $photo;
    public $currentStep = 1;
    public $totalSteps = 10;

    public function nextStep()
    {
        if ( $this->currentStep < $this->totalSteps ) {
            $this->currentStep++;
        }
    }

    public function previousStep()
    {
        $this->currentStep--;
    }

    public function validateStep()
    {
        if ( $this->currentStep == 3 ) {

            dd('test');

            // $rules = [
            //     ''
            // ]
        }
    }
    
    public function saveAsDraft()
    {
        
    }

    public function render()
    {
        return view('livewire.multi-step-form');
    }
}
