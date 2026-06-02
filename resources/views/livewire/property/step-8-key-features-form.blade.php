<?php
use Livewire\Volt\Component;

new class extends Component
{

    public string $testVariable;

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        // $this->testVariable = 
    }
}

?>
<!-----------------------------------------------------
Add your form or content for adding a property here
------------------------------------------------------->
<!-- <form method="POST" action="{{ route('properties.store') }}">
@csrf -->

    <!-----------------------------------------
    Basic location info
    ----------------------------------------->
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow-md sm:rounded-lg">
                <div class="w-full">
                    <h3 class="font-semibold text-xl text-blue-900 leading-tight mb-5">
                        {{ __('Key Features')  }}
                    </h3>
                     <livewire:accordion-key-features />
                </div>  
            </div>
        </div>
    </div>
<!-- </form> -->
