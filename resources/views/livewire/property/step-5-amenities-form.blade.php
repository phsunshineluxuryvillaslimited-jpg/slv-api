<?php
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use Livewire\Volt\Component;
use App\Models\Property;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

new class extends Component
{
    public ?Property $prooperty;

    public bool $isEdit = false;

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
            $this->property->address()->updateOrCreate([
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

    // for edit action
    #[On('parentUpdateButtonTriggered')]
    public function handleUpdateProperty()
    {   
        try {
            $validatedData = $this->validate();
            
            $this->property->address()->updateOrCreate([
                    'property_id' => $this->property->id,
                ],
                $validatedData
            );

            session()->flash('success', 'Property updated successfully');
         } catch (ValidationException $e) {
            Log::info('Property validation error. Please double check.');
            throw $e;
        }
        
    }
}
?>
<!-----------------------------------------------------
Add your form or content for adding a property here
------------------------------------------------------->
<div>

    <!-----------------------------------------
    Basic location info
    ----------------------------------------->
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow-md sm:rounded-lg">
                <div class="w-full">
                    <h3 class="font-semibold text-xl text-blue-900 leading-tight mb-5">
                        {{ __('Distance')  }}
                    </h3>
                    <p class="mb-5 text-sm text-gray-600">{{ __('Add distances to nearby amenities, airport, sea, public transport, schools and resorts. This will help your property show up in more search results and attract more potential buyers.') }}</p>
                    <div class="grid grid-cols-3 md:grid-cols-3 gap-5 mb-4">
                         <div>
                            <label for="amenities" class="block text-black text-sm mb-1">{{ __('Amenities (km)') }}</label>
                            <input type="number"
                                    wire:model="property.amenities.amenities" 
                                    id="amenities" 
                                    class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                        <div>
                            <label for="airport" class="block text-black text-sm mb-1">{{ __('Airport (km)') }}</label>
                            <input 
                                    type="number" 
                                    wire:model="property.amenities.airport" 
                                    id="airport" 
                                    class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                        <div>
                            <label for="sea" class="block text-black text-sm mb-1">{{ __('Sea (km)') }}</label>
                            <input type="number" 
                                wire:model="property.amenities.sea" 
                                id="sea" 
                                class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                    </div>
                    <div class="grid grid-cols-3 md:grid-cols-3 gap-5 mb-4">
                         <div>
                            <label for="public_transport" class="block text-black text-sm mb-1">{{ __('Public Transaport (km)') }}</label>
                            <input type="number" 
                                    wire:model="property.amenities.public_transport" 
                                    id="public_transport" 
                                    class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                        <div>
                            <label for="schools" class="block text-black text-sm mb-1">{{ __('Schools (km)') }}</label>
                            <input type="number"
                                    wire:model="property.amenities.schools" 
                                    name="schools" 
                                    id="schools" 
                                    class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                        <div>
                            <label for="resort" class="block text-black text-sm mb-1">{{ __('Resort (km)') }}</label>
                            <input type="number" name="resort" id="resort" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>

    <!-----------------------------------------
    Lat and Long from map
    ----------------------------------------->
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow-md sm:rounded-lg">
                <div class="w-full">
                    <h3 class="font-semibold text-xl text-blue-900 leading-tight mb-5">
                        {{ __('Additional Areas')  }}
                    </h3>
                    <p class="mb-5 text-sm text-gray-600">{{ __('Add information about additional areas of the property. This will help your property show up in more search results and attract more potential buyers.') }}</p>
                    <div class="grid grid-cols-4 md:grid-cols-4 gap-5 mb-4">
                         <div>
                            <label for="covered" class="block text-black text-sm mb-1">{{ __('Reference m²') }}</label>
                            <input type="number" name="covered" id="covered" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                        <div>
                            <label for="attic" class="block text-black text-sm mb-1">{{ __('Attic m²') }}</label>
                            <input type="number" name="attic" id="attic" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                        <div>
                            <label for="roof_garden" class="block text-black text-sm mb-1">{{ __('Roof Garden m²') }}</label>
                            <input type="number" name="roof_garden" id="roof_garden" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                        <div>
                            <label for="covered_veranda" class="block text-black text-sm mb-1">{{ __('Covered Veranda m²') }}</label>
                            <input type="number" name="covered_veranda" id="covered_veranda" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                    </div>


                    <div class="grid grid-cols-5 md:grid-cols-5 gap-5 mb-4">
                         <div>
                            <label for="uncovered_veranda" class="block text-black text-sm mb-1">{{ __('Uncovered Veranda m²') }}</label>
                            <input type="number" name="uncovered_veranda" id="uncovered_veranda" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                        <div>
                            <label for="covered_parking" class="block text-black text-sm mb-1">{{ __('Covered Parking m²') }}</label>
                            <input type="number" name="covered_parking" id="covered_parking" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                        <div>
                            <label for="basement" class="block text-black text-sm mb-1">{{ __('Basement m²') }}</label>
                            <input type="number" name="basement" id="basement" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                        <div>
                            <label for="courtyard" class="block text-black text-sm mb-1">{{ __('Courtyard m²') }}</label>
                            <input type="number" name="courtyard" id="courtyard" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                        <div>
                            <label for="garden" class="block text-black text-sm mb-1">{{ __('Garden m²') }}</label>
                            <input type="number" name="garden" id="garden" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                    </div>
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
                
                <h3 class="text-lg leading-6 font-medium text-gray-900">{{ session('status') }}</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500"></p>
                </div>
            </div>
        </div>
    @endif
</div>