<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class DottedSteps extends Component
{
    public int $step;

    public $isEdit = false;

    public array $stepNames = [
        1 => 'References',
        'Location',
        'Photos',
        'Floor Plan',
        'Amenities',
        'CH Manager',
        'Vendor',
        'Key Features',
        'V-tour Video',
        'Title & Description'
    ];

    public function mount($step = 0, bool $isEdit = false)
    {
        $this->step = $step;
        if ($isEdit) {
            $this->isEdit = $isEdit;
        }
    }

    public function render()
    {
        return view('livewire.dotted-steps', [
            // 'step' => $this->step,
            'step_names' => $this->stepNames 
        ]);
    }
}
