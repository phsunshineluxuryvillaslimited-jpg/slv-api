<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;
use App\Models\Property;

class MultiStepForm extends Component
{
    public $currentStep = 1;
    public $totalSteps = 10;

    public $property = [];

    public $isEdit = false;
    public string $updatedStep;

    //from controller to view to component
    public function mount(Property $editProperty)
    {
        $this->property = $editProperty;

        if ($editProperty->getKey()) {
            $this->isEdit = true;
        } 
    }

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
    public function nextStep(Property $property)
    {   
        $this->property = $property;
        dd($property);
        if ( $this->currentStep < $this->totalSteps ) {
            $this->currentStep++;
        }
        
        $this->updatedStep($this->currentStep);
    }

    //Previous Step button action
    public function previousStep()
    {
        $this->currentStep--;
        $this->updatedStep($this->currentStep);
    }
    public function render()
    {
        return view('livewire.multi-step-form');
    }
}
