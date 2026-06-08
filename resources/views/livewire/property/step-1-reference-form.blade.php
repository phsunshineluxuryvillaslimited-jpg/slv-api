<?php
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use App\Models\PropertyType;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use App\Models\Property;
use Illuminate\Validation\Rule;
use App\Models\Agent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

new class extends Component
{
    /***********************
     * Validateion 
     ************************/
    // #[Validate('required|string|unique:properties,id')]
    public string $edit_reference = '';
    
    // #[Validate('required|string|unique:properties,id')] //edit only
    #[Validate('required|string|unique:properties,reference')]
    public string $reference = '';

    #[Validate('required|numeric')]
    public float $basic_price;

    #[Validate('required|numeric|min:1')]
    public int $bedrooms;

    #[Validate('required|numeric|min:1')]
    public int $bathrooms;

    #[Validate('required|numeric|min:1')]
    public int $area_size;

    #[Validate('required|numeric|min:1')]
    public int $plot;

    #[Validate('required|string')]
    public string $plot_description;

    #[Validate('required|string')]
    public string $agent_id;

    // #[Validate('required|integer|digits:4|min:1900|max:3050')]
    public int $year_of_construction;

    #[Validate('required|string')]
    public string $pool_description;

    #[Validate('required|numeric')]
    public string $property_type_id;

    #[Validate('required|numeric')]
    public string $commission;

    #[Validate('nullable')]
    public string $listing_type = 'resale';

    #[Validate('nullable')]
    public int $communal_charge;

    #[Validate('nullable')]
    public string $plan_zone = 'A';

    #[Validate('nullable')]
    public string $sea_view = 'yes';

    #[Validate('nullable')]
    public string $for_sale_board = 'yes';

    #[Validate('nullable')]
    public string $pool = 'yes';

    #[Validate('nullable')]
    public string $is_poa;

    #[Validate('nullable')]
    public string $title_deeds = 'available';

    #[Validate('nullable')]
    public string $leasehold = 'yes';

    public $isEdit = false;

    // check parent next button is click/triggered
    public $isParentNextButtonTriggered  = '';

    // list of property type
    public $propertyTypes = [];

    // list of agents
    public $agents = [];

    //for property edit
    public ?Property $property = null;

    public function updatedReference(string $value)
    {
        $this->reference = strtoupper($value);
    }

    protected function rules()
    {
        if ($this->isEdit) {
            return [
                'edit_reference' => [
                    'required',
                    'string',
                    Rule::unique('properties', 'reference')->ignore($this->property->id),
                ],
                'year_of_construction' => 'required|integer|digits:4|min:1900|max:' . date('Y')
            ];
        }
        return ['year_of_construction' => 'required|integer|digits:4|min:1900|max:' . date('Y')];
    }

    protected function validationAttributes()
    {
        return [
            'edit_reference' => 'reference',
            'property_type_id' => 'property Type',
            'agent_id' => 'agent'
        ];
    }

    // get the list of property types
    public function mount(PropertyType $propertyTypes, Property $property)
    {
        if ($property && $property->exists) {
            $this->isEdit               = true;
            $this->property             = $property;
            $this->edit_reference       = $property->reference;
            $this->reference            = 'XDIRTY-CREATE1';
            $this->basic_price          = $property->price->basic_price ?? 0;
            $this->area_size            = $property->area_size;
            $this->bedrooms             = $property->bedrooms;
            $this->bathrooms            = $property->bathrooms;
            $this->plot                 = $property->plot;
            $this->plot_description     = $property->plot_description;
            $this->agent_id             = $property->agent_id;
            $this->year_of_construction = $property->year_of_construction;
            $this->pool_description     = $property->pool_description;
            $this->property_type_id     = $property->property_type_id;
            $this->commission           = $property->price->commission ?? 0;
            $this->listing_type         = $property->listing_type;
            $this->communal_charge      = $property->price->communal_charge ?? 0;
            $this->plan_zone            = $property->plan_zone;
            $this->sea_view             = $property->sea_view;
            $this->for_sale_board       = $property->for_sale_board;
            $this->pool                 = $property->pool;
            $this->is_poa               = $property->price->is_poa ?? 0;
            $this->title_deeds          = $property->title_deeds;
            $this->leasehold            = $property->leasehold;
        }
        
        $this->propertyTypes = $propertyTypes->orderBy('name', 'asc')->get();
        $this->agents = Agent::all();
    }

    //Create
    #[On('parentNextStepButtonTriggered')]
    public function hundleNextStepButtonTriggered()
    { 
        try {
            
            $this->edit_reference = 'XDIRTY-CREATE1';
            $validatedData = $this->validate();
            unset($validatedData['edit_reference']);
            $price = [
                'is_poa' => $validatedData['is_poa'],
                'basic_price' => $validatedData['basic_price'],
                'commission' => $validatedData['commission'],
                'communal_charge' => $validatedData['communal_charge']
            ];

            $validatedData['reference'] = strtoupper($validatedData['reference']);

            $newProperty = Property::create($validatedData);
            $newProperty->price()->updateOrCreate($price);
            
            $this->dispatch( 'proceed-to-next-step', property_id: $newProperty->id);
                
        } catch (ValidationException $e) {
            Log::info('Property validation error. Please double check.');
            throw $e;
        }
    }

    //Update
    #[On('parentUpdateButtonTriggered')]
    public function handleUpdateProperty()
    {
        $validatedData = $this->validate();
        $validatedData['reference'] = $validatedData['edit_reference']; //change value of reference
        unset($validatedData['edit_reference']);
        if ($this->property && $this->property->exists) {
            $price = [
                'is_poa' => $validatedData['is_poa'],
                'basic_price' => $validatedData['basic_price'],
                'commission' => $validatedData['commission'],
                'communal_charge' => $validatedData['communal_charge']
            ];

            $this->property->update($validatedData);
            $this->property->price()->updateOrCreate($price);

            session()->flash('success', 'Property has been successfully updated!');
        }
    }

}

?>

<!------------------------------------
Basic information about the property 
------------------------------------->
<div>
    <?php /*
    @if (session()->has('status'))
        <div class="mb-4 p-2 bg-green-100 text-green-700 rounded text-sm max-w-7xl mt-3 mx-auto sm:px-6 lg:px-8">
            <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 8" />
            </svg>
            {{  session('status') }}
        </div>
    @endif
    */ ?>
    <div class="max-w-7xl mt-3 mx-auto sm:px-6 lg:px-8">
        <span class="required-field"></span> <span class="text-sm text-gray-800">{{ __('Required fields') }}</span>
    </div>
    <div class="py-6">
    
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow-md sm:rounded-lg  {{ $isEdit ? 'bg-orange-100/40' : '' }}">
                <div class="w-full">
                    <h3 class="font-semibold text-xl text-blue-900 leading-tight mb-5">
                        {{ __('Basic')  }}
                    </h3>
                    <p class="mb-5 text-sm text-gray-600">{{ __('Add the basic details about the property. You can always edit these details later.') }}</p>
                    <!-- Form fields for property details -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-4">
                        <div>
                            <label for="reference" class="required-field block text-black text-sm mb-1 uppercase">{{ __('Reference') }}</label>
                            <input type="text" 
                                id="reference" 
                                class="uppercase placeholder:normal-case w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                                placeholder="SLV-1234"
                                @if ( $isEdit )
                                    wire:model.live="edit_reference"
                                @else
                                    wire:model.live="reference"
                                @endif
                                required
                                />
                            @if ( $isEdit )
                                @error('edit_reference') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
                            @else
                                @error('reference') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
                            @endif
                        </div>
                        <div>
                            <label for="basicPrice" class="required-field block text-black text-sm mb-1">{{ __('Price') }}</label>
                            <div class="relative flex items-center">
                                <div class="absolute ml-0 text-gray-500 pr-3 h-full left-3 flex items-center">
                                    &euro;
                                </div>
                                <input type="number" 
                                    wire:model.live="basic_price" 
                                    id="basicPrice" 
                                    placeholder="e.g. 250000"
                                    class="w-full pl-7 text-sm  border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50 [&::-webkit-inner-spin-button]:mr-8" 
                                    required
                                />
                                <div class="absolute ml-0 text-gray-500 pr-3 border-r-1 border-gray-300 rounded-r-md h-full right-0 flex items-center">
                                    {{ __('GBP') }}
                                </div>
                            </div>
                            @error('basic_price') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="poa" class="block text-black text-sm mb-1">&nbsp;</label>
                            <div class="flex items-center pt-2">
                                <input type="checkbox" wire:model.live="is_poa" id="poa" class="border-gray-300 text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                                <label class="text-gray-700 ml-2">{{ __('POA (hide price)') }}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!------------------------------------
    Add more sections for property details as needed
    ------------------------------------->
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow-md sm:rounded-lg {{ $isEdit ? 'bg-orange-100/40' : '' }}">
                <div class="w-full">
                    <h3 class="font-semibold text-xl text-blue-900 leading-tight mb-5">
                        {{ __('Property Details')  }}
                    </h3>
                    <p class="mb-5 text-sm text-gray-600">
                        {{ __('Add more details about the property. This will help your property show up in more search results and attract more potential buyers.') }}
                    </p>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">
                        <div>
                            <label for="reference" class="required-field block text-black text-sm mb-1">{{ __('Property Type') }}</label>
                            <select wire:model.live="property_type_id" id="property_type" class="w-full border-gray-300 text-sm rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                                <option value="1" wire:key="1">None</option>
                                @foreach ($propertyTypes as $propertyType) 
                                    @continue( $propertyType->id === 1 )
                                    <option value="{{ $propertyType->id }}" wire:key="{{ $propertyType->id }}">{{ $propertyType->name }}</option>
                                @endforeach
                            </select>
                            @error('property_type_id') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-span-2 flex items-center">
                            <div>
                                <label for="description" class="block text-black text-sm mb-1">{{ __('Has Title Deeds') }}</label>
                                <div class="flex items-center pt-2">
                                    <div class="flex items-center">
                                        <input type="radio" name="title_deeds_group" wire:model.live="title_deeds" id="title_deeds_available" value="available" class="border-gray-300 text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" checked required />
                                        <label for="title_deeds_available" class="text-gray-700 ml-2 text-sm">{{ __('Available') }}</label>
                                    </div>
                                    <div class="flex items-center ml-5">
                                        <input type="radio" name="title_deeds_group" wire:model.live="title_deeds" id="title_deeds_not_available" value="not-available" class="border-gray-300 text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                                        <label for="title_deeds_not_available" class="text-gray-700 ml-2 text-sm">{{ __('Not Available') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="pl-4">
                                <label for="description" class="block text-black text-sm mb-1">{{ __('Leasehold Property') }}</label>
                                <div class="flex items-center pt-2">
                                    <div class="flex items-center">
                                        <input type="radio" name="leasehold_property_group" wire:model.live="leasehold" id="leasehold_property_yes" value="yes" class="border-gray-300 text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" checked required />
                                        <label for="leasehold_property_yes" class="text-gray-700 ml-2 text-sm">{{ __('Yes') }}</label>
                                    </div>
                                    <div class="flex items-center ml-5">
                                        <input type="radio" name="leasehold_property_group" wire:model.live="leasehold" id="leasehold_property_no" value="no" class="border-gray-300 text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                                        <label for="leasehold_property_no" class="text-gray-700 ml-2 text-sm">{{ __('No') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">
                        <div>
                            <label for="bedrooms" class="required-field block text-black text-sm mb-1">{{ __('Bedrooms') }}</label>
                            <input type="number" 
                                wire:model.live="bedrooms" 
                                id="bedrooms" 
                                value="0" 
                                class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                                required />
                            @error('bedrooms') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="bathrooms" class="required-field block text-black text-sm mb-1">{{ __('Bathrooms') }}</label>
                            <input type="number" wire:model.live="bathrooms" id="bathrooms" value="0" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                            @error('bathrooms') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">
                        <div>
                            <label for="area_size" class="required-field block text-black text-sm mb-1">{{ __('Area Size') }}</label>
                            <div class="relative rounded-md shadow-sm max-w-sm">
                                <input type="number" wire:model.live="area_size" id="area_size" value="0" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50 [&::-webkit-inner-spin-button]:mr-9" placeholder="" />
                                <div class="absolute inset-y-0 right-0 flex items-center h-full pl-3 pr-3 bg-gray-50 text-center text-gray-500 border border-gray-300 rounded-r-md text-sm">
                                    {{ __('m') }}<span class="text-[0.65rem] align-super mb-2">{{ __('2') }}</span>
                                </div>
                            </div>
                             @error('area_size') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="plot" class="required-field block text-black text-sm mb-1 mb-1">{{ __('Plot') }}</label>
                            <div class="relative rounded-md shadow-sm max-w-sm">
                                <input type="number" wire:model.live="plot" id="plot" value="0" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50 [&::-webkit-inner-spin-button]:mr-9" placeholder="" />
                                
                                <div class="absolute inset-y-0 right-0 flex items-center h-full pl-3 pr-3 bg-gray-50 text-center text-gray-500 border border-gray-300 rounded-r-md text-sm">
                                    {{ __('m') }}<span class="text-[0.65rem] align-super mb-2">{{ __('2') }}</span>
                                </div>
                            </div>
                            @error('plot') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="plot_description" class="required-field block text-black text-sm mb-1">{{ __('Plot Description') }}</label>
                            <input type="text" wire:model.live="plot_description" placeholder="e.g. Corner Plot, flat, slight slope, cul-de-sac" id="plot_description" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                            @error('plot_description') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">
                        <div>
                            <label for="agent" class="required-field block text-black text-sm mb-1 mb-1">{{ __('Managing Agent') }}</label>
                            <select wire:model.live="agent_id" id="agent" class="w-full border-gray-300 py-3 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" required />
                                <option value="">None</option>
                                @foreach( $agents as  $id => $agent )
                                <option value="{{ $agent->id }}"  wire:key="{{ $agent->id }}">{{ $agent->first_name . ' ' . $agent->last_name }}</option>
                                @endforeach
                            </select>
                            @error('agent_id') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="year_of_construction" class="required-field block text-black text-sm mb-1">{{ __('Year of Construction') }}</label>
                            <input type="number" wire:model.live="year_of_construction" placeholder="e.g. 2005" id="year_of_construction" class="w-full border-gray-300 text-sm rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                            @error('year_of_construction') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="pool" class="block text-black text-sm mb-1">{{ __('Pool') }}</label>
                            <div class="flex items-center pt-2">
                                <div class="flex items-center">
                                    <input type="radio" name="pool_group" wire:model.live="pool" id="pool_yes" value="yes" class="border-gray-300 text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" checked />
                                    <label for="pool_yes" class="text-gray-700 ml-2 text-sm">{{ __('Yes') }}</label>
                                </div>
                                <div class="flex items-center ml-4">
                                    <input type="radio" name="pool_group" wire:model.live="pool" id="pool_no" value="no" class="border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                                    <label for="pool_no" class="text-gray-700 ml-2 text-sm">{{ __('No') }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-6">
                        <div class="w-1/2">
                            <label for="pool_description" class="required-field block text-black text-sm mb-1">{{ __('Pool Description') }}</label>
                            <input type="text" wire:model.live="pool_description" id="pool_description" class="w-full border-gray-300 text-sm rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Enter pool details (e.g. Infinity, Heated, Shared)" required />
                            @error('pool_description') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-2 gap-5 mb-4">
                    <div>
                        <label for="commission" class="required-field block text-black text-sm mb-1">{{ __('Commission') }}</label>
                        <div class="relative rounded-md shadow-sm max-w-sm">
                            <input type="number" wire:model.live="commission" id="commission" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50 [&::-webkit-inner-spin-button]:mr-7" placeholder="" />
                            <div class="absolute inset-y-0 right-0 flex items-center h-full pl-3 px-3 bg-gray-100 text-center text-gray-500 border border-gray-300 rounded-r-md text-sm">
                                %
                            </div>
                        </div>
                        @error('commission') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
                    </div>
                </div>  
            </div>
        </div>
    </div>


    <!------------------------------------
    Specific details about the property
    ------------------------------------->
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow-md sm:rounded-lg {{ $isEdit ? 'bg-orange-100/40' : '' }} ">
                <div class="w-full">
                    <h3 class="font-semibold text-xl text-blue-900 leading-tight mb-5">
                        {{ __('Specific')  }}
                    </h3>

                    <p class="mb-5 text-sm text-gray-600">
                        {{ __('Select specific details about the property. This will help your property show up in more search results and attract more potential buyers.') }}
                    </p>
                    <!-- Add your form or content for adding a property here -->
                    <!-- Form fields for property details -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-4">
                        <div>
                            <label class="block text-gray-700 text-sm">{{ __('Listing Type') }}</label>
                            <div class="flex items-center pt-2">
                                <div class="flex items-center">
                                    <input type="radio" name="listing_type_group" wire:model.live="listing_type" id="listing_type_resale" value="resale" class="border-gray-300 text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" checked />
                                    <label for="listing_type_resale" class="text-gray-700 ml-2 text-sm ">{{ __('Resale') }}</label>
                                </div>
                                <div class="flex items-center ml-4">
                                    <input type="radio" name="listing_type_group" wire:model.live="listing_type" id="listing_type_new_build" value="new_build" class="border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                                    <label for="listing_type_new_build" class="text-gray-700 ml-2 text-sm">{{ __('New Build') }}</label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm">{{ __('Plan Zone') }}</label>
                            <div class="flex items-center pt-2">
                                <div class="flex items-center">
                                    <input type="radio" name="plan_zone_group" wire:model.live="plan_zone" id="plan_zone_a" value="A" class="border-gray-300 text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" checked />
                                    <label for="plan_zone_a" class="text-gray-700 ml-2 text-sm ">{{ __('A') }}</label>
                                </div>
                                <div class="flex items-center ml-4">
                                    <input type="radio" name="plan_zone_group" wire:model.live="plan_zone" id="plan_zone_b" value="B" class="border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                                    <label for="plan_zone_b" class="text-gray-700 ml-2 text-sm">{{ __('B') }}</label>
                                </div>
                                <div class="flex items-center ml-4">
                                    <input type="radio" name="plan_zone_group" wire:model.live="plan_zone" id="plan_zone_c" value="C" class="border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                                    <label for="plan_zone_c" class="text-gray-700 ml-2 text-sm">{{ __('C') }}</label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="description" class="block text-gray-700 text-sm">{{ __('Sea View') }}</label>
                            <div class="flex items-center pt-2">
                                <div class="flex items-center">
                                    <input type="radio" name="sea_view_group" wire:model.live="sea_view" id="sea_view_yes" value="yes" class="border-gray-300 text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" checked />
                                    <label for="sea_view_yes" class="text-gray-700 ml-2 text-sm ">{{ __('Yes') }}</label>
                                </div>
                                <div class="flex items-center ml-4">
                                    <input type="radio" name="sea_view_group" wire:model.live="sea_view" id="sea_view_no" value="no" class="border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                                    <label for="sea_view_no" class="text-gray-700 ml-2 text-sm">{{ __('No') }}</label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="description" class="block text-gray-700 text-sm">{{ __('For Sale Board') }}</label>
                            <div class="flex items-center pt-2">
                                <div class="flex items-center">
                                    <input type="radio"  name="for_sale_board_group" wire:model.live="for_sale_board" id="for_sale_board_yes" value="yes" class="border-gray-300 text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" checked />
                                    <label for="for_sale_board_yes" class="text-gray-700 ml-2 text-sm ">{{ __('Yes') }}</label>
                                </div>
                                <div class="flex items-center ml-4">
                                    <input type="radio" name="for_sale_board_group" wire:model.live="for_sale_board" id="for_sale_board_no" value="no" class="border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                                    <label for="for_sale_board_no" class="text-gray-700 ml-2 text-sm">{{ __('No') }}</label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="communal_charge" class="block text-black text-sm mb-1">{{ __('Communal Charge') }} (&euro;)</label>
                            <div class="relative rounded-md shadow-sm max-w-sm">
                                <input type="number" wire:model.live="communal_charge" id="communal_charge" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50 [&::-webkit-inner-spin-button]:mr-[55px]" placeholder="" />
                                <div class="absolute inset-y-0 right-0 flex items-center">
                                    <select id="currency" name="currency" class="h-full pl-2 rounded-r-md border-gray-300 pr-3 bg-gray-100 text-gray-500 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">
                                        <option value="yearly" default>{{ __('p/yr') }}</option>
                                        <option value="monthly">{{ __('p/mon') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($errors->any())
        <div x-data="{ show: true }"
            x-show="show"
            x-init="setTimeout(() => show = false, 3000)"
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
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                    <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <circle cx="12" cy="12" r="9" stroke-width="2"></circle>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 9l6 6M15 9l-6 6" />
                    </svg>
                </div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">{{ __("Oops! Some fields need your attention.") }} </h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500"></p>
                </div>
            </div>
        </div>
    @endif
    @if (session()->has('success'))
        <div x-data="{ show: true }"
            x-show="show"
            x-init="setTimeout(() => show = false, 3000)"
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