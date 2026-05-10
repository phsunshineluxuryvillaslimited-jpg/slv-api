<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class MultiStepForm extends Component
{
    public $currentStep = 2;
    public $totalSteps = 10;

    public $testVarable = 3;


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
        if ( $this->currentStep == 1 ) {
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
