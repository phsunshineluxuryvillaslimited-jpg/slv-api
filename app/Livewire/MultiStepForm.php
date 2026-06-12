<?php

namespace App\Livewire;

use App\Models\Property;
use Livewire\Attributes\On;
use Livewire\Component;

class MultiStepForm extends Component
{
    public $currentStep = 1;

    public $totalSteps = 10;

    public ?Property $property = null;

    public $isEdit = false;

    public string $updatedStep;

    // from controller to view to component
    public function mount(Property $editProperty, string $editMode = '')
    {
        $this->property = $editProperty;
        if ($editMode == 'editMode') {
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
            // $this->dispatch('load-tinymce');
        }
    }

    // Create and proceed to next step
    #[On('proceed-to-next-step')]
    public function nextStep($property_id = 0)
    {
        $this->property = Property::find($property_id);

        if ($this->currentStep < $this->totalSteps) {
            $this->currentStep++;
        }

        $this->updatedStep($this->currentStep);
    }

    // Update or create
    #[On('editSelectedStep')]
    public function hundleEditSelectedStep(int $step)
    {
        $this->currentStep = $step;
        $this->updatedStep($this->currentStep);
        $this->isEdit = true;
    }

    // Previous Step button action
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
