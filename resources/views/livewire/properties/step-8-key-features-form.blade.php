<?php
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use Livewire\Volt\Component;
use App\Models\Property;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

new class extends Component
{
    
    public ?Property $property;

    public bool $isEdit = false;

    protected function rules()
    {
        return [
            'keyFeatures.*.field.*.value' => 'boolean',
        ];
    }

    public function mount(Property $property, $isEdit = false): void
    {
        $this->property = $property;
        $this->isEdit   = $isEdit;
    }

    #[On('parentNextStepButtonTriggered')]
    public function hundleNextStepButtonTriggered()
    {
        try {
            $validatedData = $this->validate();
            $this->property->keyFeatures()->updateOrCreate([
                    'property_id' => $this->property->id,
                ],
                $validatedData
            );

            $this->dispatch( 'proceed-to-next-step', property_id: $this->property->id);
         } catch (ValidationException $e) {
            Log::info('Property validation error. Please double check.');
            throw $e;
        }
    }

    #[On('update-is-success')]
    public function updateSuccess()
    {
        session()->flash('success', 'Property key feature updated successfully');
    }
    // for edit action
    // #[On('parentUpdateButtonTriggered')]
    // public function handleUpdateProperty()
    // {   
    //     try {
    //         $validatedData = $this->validate();

    //         $this->property->keyFeature()->updateOrCreate([
    //                 'property_id' => $this->property->id,
    //             ],
    //             $validatedData
    //         );
    //         session()->flash('success', 'Property updated successfully');
    //      } catch (ValidationException $e) {
    //         Log::info('Property validation error. Please double check.');
    //         throw $e;
    //     }
        
    // }
}    

?>
<!-----------------------------------------------------
Add your form or content for adding a property here
------------------------------------------------------->
<div>
    <!-----------------------------------------
    Basic location info
    ----------------------------------------->
    <div class="flex max-w-7xl mt-3 mx-auto sm:px-6 lg:px-8">
        <div class="ml-auto text-blue-900 font-semibold font-custom pr-3">{{ $property->reference }}</div>
    </div>
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow-md sm:rounded-lg">
                <div class="w-full">
                    <h3 class="font-semibold text-xl text-blue-900 leading-tight mb-5">
                        {{ __('Key Features')  }}
                    </h3>
                    <p class="mb-5 text-sm text-gray-600">{{ __('Tick the key features of the property. This will help your property show up in more search results and attract more potential buyers.') }}</p>
                     <livewire:accordion-key-features :property="$property" :isEdit="$isEdit"/>
                </div>  
            </div>
        </div>
    </div>
    @if (session()->has('success'))
        <div x-data="{ show: true }"
            x-show="show"
            x-init="setTimeout(() => show = false, 2000)"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50"
            aria-modal="true" 
            role="dialog">

            <!-- Modal Box -->
            <div class="bg-white rounded-lg shadow-xl p-6 max-w-sm w-full mx-4 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 mb-4">
                    <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 8" />
                    </svg>
                </div>
                
                <h3 class="text-lg leading-6 font-medium text-gray-900">{{ session('success') }}</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500"></p>
                </div>
            </div>
        </div>
    @endif
</div>
