<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;

class MultiStepForm extends Component
{
    public $currentStep = 1;
    public $totalSteps = 10;

    public $newPropertyId = 0;

    public string $updatedStep;

    public function updatedStep(int $value)
    {   

        $this->updatedStep = $value;
        if ($value == 2) {
            $this->dispatch('load-map');
        }

        if ($value == 10) {
            $this->dispatch('load-tinymce');
        }
    }

    #[On('proceed-to-next-step')]
    public function nextStep($property_id = 0)
    {   
        $this->newPropertyId = $property_id;

        if ( $this->currentStep < $this->totalSteps ) {
            $this->currentStep++;
        }
        
        $this->updatedStep($this->currentStep);
    }

    public function previousStep()
    {
        $this->currentStep--;
        $this->updatedStep($this->currentStep);
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

    public function mount()
    {

    }
    
    public function render()
    {
        return view('livewire.multi-step-form');
    }
}
