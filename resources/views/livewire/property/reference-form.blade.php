
<?php

use App\Models\PropertyType;
use Livewire\Volt\Component;

new class extends Component
{
 
    public $propertyTypes = [];

    public function mount(PropertyType $propertyTypes)
    {
        $this->propertyTypes = $propertyTypes->all();
    }
}

?>


<!-----------------------------------------------------
Add your form or content for adding a property here
------------------------------------------------------->
<form method="POST" action="{{ route('properties.store') }}">
@csrf

    <!------------------------------------
    Basic information about the property 
    ------------------------------------->
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow-md sm:rounded-lg">
                <div class="w-full">
                    <h3 class="font-semibold text-xl text-blue-900 leading-tight mb-5">
                        {{ __('Basic')  }}
                    </h3>
                    <!-- Form fields for property details -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-4">
                        <div>
                            <label for="reference" class="block text-black text-sm mb-1">{{ __('Reference') }}</label>
                            <input type="text" name="reference" id="reference" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                        </div>
                        <div>
                            <label for="basicPrice" class="block text-black text-sm mb-1">{{ __('Price') }}</label>
                            <div class="relative flex items-center">
                                <div class="absolute ml-0 text-gray-500 pr-3 h-full left-3 flex items-center">
                                    &euro;
                                </div>
                                <input type="number" name="basic_price" id="basicPrice" class="w-full pl-7 text-sm  border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50 [&::-webkit-inner-spin-button]:mr-8" required>
                                <div class="absolute ml-0 text-gray-500 pr-3 border-r-1 border-gray-300 rounded-r-md h-full right-0 flex items-center">
                                    {{ __('GBP') }}
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="poa" class="block text-black text-sm mb-1">&nbsp;</label>
                            <div class="flex items-center pt-2">
                                <input type="checkbox" name="poa" id="poa" class="border-gray-300 text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
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
            <div class="p-4 sm:p-8 bg-white shadow-md sm:rounded-lg">
                <div class="w-full">
                    <h3 class="font-semibold text-xl text-blue-900 leading-tight mb-5">
                        {{ __('Property Details')  }}
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">
                        <div>
                            <label for="reference" class="block text-black text-sm mb-1">{{ __('property Type') }}</label>
                            <select name="property_type_id" id="property_type" class="w-full border-gray-300 text-sm rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                                @foreach ($propertyTypes as $propertyType)
                                <option value="{{ $propertyType->id }}" wire:key="{{ $propertyType->id }}">{{ $propertyType->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-2 flex items-center">
                            <div>
                                <label for="description" class="block text-black text-sm mb-1">{{ __('Has Title Deeds') }}</label>
                                <div class="flex items-center pt-2">
                                    <div class="flex items-center">
                                        <input type="radio" name="title_deeds" id="title_deeds_available" value="available" class="border-gray-300 text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" checked required />
                                        <label for="title_deeds_available" class="text-gray-700 ml-2 text-sm">{{ __('Available') }}</label>
                                    </div>
                                    <div class="flex items-center ml-5">
                                        <input type="radio" name="title_deeds" id="title_deeds_not_available" value="not-available" class="border-gray-300 text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                                        <label for="title_deeds_not_available" class="text-gray-700 ml-2 text-sm">{{ __('Not Available') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="pl-4">
                                <label for="description" class="block text-black text-sm mb-1">{{ __('Leasehold Property') }}</label>
                                <div class="flex items-center pt-2">
                                    <div class="flex items-center">
                                        <input type="radio" name="leasehold_property" id="leasehold_property_yes" value="yes" class="border-gray-300 text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" checked required />
                                        <label for="description_yes" class="text-gray-700 ml-2 text-sm">{{ __('Yes') }}</label>
                                    </div>
                                    <div class="flex items-center ml-5">
                                        <input type="radio" name="leasehold_property" id="leasehold_property_no" value="no" class="border-gray-300 text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                                        <label for="description_no" class="text-gray-700 ml-2 text-sm">{{ __('No') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">
                        <div>
                            <label for="bedrooms" class="block text-black text-sm mb-1">{{ __('Bedrooms') }}</label>
                            <input type="number" name="bedrooms" id="bedrooms" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                        <div>
                            <label for="bathrooms" class="block text-black text-sm mb-1">{{ __('Bathrooms') }}</label>
                            <input type="number" name="bathrooms" id="bathrooms" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                        <div>
                            <label for="build" class="block text-black text-sm mb-1">{{ __('Build') }}</label>
                            <div class="relative rounded-md shadow-sm max-w-sm">
                                <input type="number" name="build" id="build" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50 [&::-webkit-inner-spin-button]:mr-9 placeholder="" />
                                <div class="absolute inset-y-0 right-0 flex items-center h-full pl-3 pr-3 bg-gray-50 text-center text-gray-500 border border-gray-300 rounded-r-md text-sm">
                                    {{ __('m') }}<span class="text-[0.65rem] align-super mb-2">{{ __('2') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">
                        <div>
                            <label for="terrace" class="block text-black text-sm mb-1">{{ __('Terrace') }}</label>
                            <div class="relative rounded-md shadow-sm max-w-sm">
                                <input type="number" name="terrace" id="terrace" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50 [&::-webkit-inner-spin-button]:mr-9" placeholder="" />
                                <div class="absolute inset-y-0 right-0 flex items-center h-full pl-3 pr-3 bg-gray-50 text-center text-gray-500 border border-gray-300 rounded-r-md text-sm">
                                    {{ __('m') }}<span class="text-[0.65rem] align-super mb-2">{{ __('2') }}</span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="plot" class="block text-black text-sm mb-1 mb-1">{{ __('Plot') }}</label>
                            <div class="relative rounded-md shadow-sm max-w-sm">
                                <input type="number" name="plot" id="plot" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50 [&::-webkit-inner-spin-button]:mr-9" placeholder="" />
                                <div class="absolute inset-y-0 right-0 flex items-center h-full pl-3 pr-3 bg-gray-50 text-center text-gray-500 border border-gray-300 rounded-r-md text-sm">
                                    {{ __('m') }}<span class="text-[0.65rem] align-super mb-2">{{ __('2') }}</span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="plot_description" class="block text-black text-sm mb-1">{{ __('Plot Description') }}</label>
                            <input type="text" placeholder="e.g. Corner Plot, flat, slight slope, cul-de-sac" name="plot_description" id="plot_description" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">
                        <div>
                            <label for="agent_id" class="block text-black text-sm mb-1 mb-1">{{ __('Managing Agent') }}</label>
                            <select name="agent_id" id="agent_id" class="w-full border-gray-300 py-3 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm" required />
                                <option value="None">None</option>
                                <option value="SLV">SLV (General)</option>
                                <option value="Andriy Stanislavchuk">Andriy Stanislavchuk</option>
                                <option value="Cheryl Hann">Cheryl Hann</option>
                                <option value="Gabbie Simpson">Gabbie Simpson</option>
                            </select>
                        </div>
                        <div>
                            <label for="year_of_construction" class="block text-black text-sm mb-1">{{ __('Year of Construction') }}</label>
                            <input type="number" placeholder="e.g. 2005" name="year_of_construction" id="year_of_construction" class="w-full border-gray-300 text-sm rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                        <div>
                            <label for="" class="block text-black text-sm mb-1">{{ __('Pool') }}</label>
                            <div class="flex items-center pt-2">
                                <div class="flex items-center">
                                    <input type="radio" name="pool" id="pool_yes" value="yes" class="border-gray-300 text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" checked />
                                    <label for="pool_yes" class="text-gray-700 ml-2 text-sm">{{ __('Yes') }}</label>
                                </div>
                                <div class="flex items-center ml-4">
                                    <input type="radio" name="pool" id="pool_no" value="no" class="border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                                    <label for="pool_no" class="text-gray-700 ml-2 text-sm">{{ __('No') }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-6">
                        <div class="w-1/2">
                            <label for="pool_description" class="block text-black text-sm mb-1">{{ __('Pool Description') }}</label>
                            <input type="text" name="pool_description" id="pool_description" class="w-full border-gray-300 text-sm rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Enter pool details (e.g. Infinity, Heated, Shared)" required />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!------------------------------------
    Price and other specific details about the property
    ------------------------------------->
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow-md sm:rounded-lg">
                <div class="w-full">
                    <h3 class="font-semibold text-xl text-blue-900 leading-tight mb-5">
                        {{ __('Price')  }}
                    </h3>
                    <!-- Add your form or content for adding a property here -->
                    <!-- Form fields for property details -->
                    <div class="grid grid-cols-5 md:grid-cols-5 gap-5 mb-4">
                        <div>
                            <label for="original_price" class="font-md block text-black text-sm mb-1">{{ __('Original Price') }}</label>
                            <input type="number" name="original_price" id="original_price" class="w-full border-gray-300 rounded-md text-sm  shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                        <div>
                            <label for="total_reduction_percentage" class="block text-black text-sm mb-1">{{ __('Total Reduction %') }}</label>
                            <div class="relative rounded-md shadow-sm max-w-sm">
                                <input type="number" name="total_reduction_percentage" id="total_reduction_percentage" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50 [&::-webkit-inner-spin-button]:mr-7" placeholder="" />
                                <div class="absolute inset-y-0 right-0 flex items-center h-full pl-3 px-3 bg-gray-100 text-center text-gray-500 border border-gray-300 rounded-r-md text-sm">
                                    %
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="total_reduction_price" class="block text-black text-sm mb-1">{{ __('Total Reduction (Price)') }}</label>
                            <input type="number" name="total_reduction_price" id="total_reduction_price" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                        <div>
                            <label for="commission" class="block text-black text-sm mb-1">{{ __('Commission') }}</label>
                            <div class="relative rounded-md shadow-sm max-w-sm">
                                <input type="number" name="commission" id="commission" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50 [&::-webkit-inner-spin-button]:mr-7" placeholder="" />
                                <div class="absolute inset-y-0 right-0 flex items-center h-full pl-3 px-3 bg-gray-100 text-center text-gray-500 border border-gray-300 rounded-r-md text-sm">
                                    %
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="communal_charges" class="block text-black text-sm mb-1">{{ __('Communal Charge') }} (&euro;)</label>
                            <div class="relative rounded-md shadow-sm max-w-sm">
                                <input type="number" name="communal_charges" id="communal_charges" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50 [&::-webkit-inner-spin-button]:mr-[55px]" placeholder="" />
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

    <!------------------------------------
    Specific details about the property
    ------------------------------------->
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow-md sm:rounded-lg">
                <div class="w-full">
                    <h3 class="font-semibold text-xl text-blue-900 leading-tight mb-5">
                        {{ __('Specific')  }}
                    </h3>
                    <!-- Add your form or content for adding a property here -->
                    <!-- Form fields for property details -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-4">
                        <div>
                            <label class="block text-gray-700 text-sm">{{ __('Listing Type') }}</label>
                            <div class="flex items-center pt-2">
                                <div class="flex items-center">
                                    <input type="radio" name="listing_type" id="listing_type" value="release" class="border-gray-300 text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" checked />
                                    <label for="listing_type" class="text-gray-700 ml-2 text-sm ">{{ __('Release') }}</label>
                                </div>
                                <div class="flex items-center ml-4">
                                    <input type="radio" name="listing_type" id="listing_type" value="new" class="border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                                    <label class="text-gray-700 ml-2 text-sm">{{ __('New') }}</label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-gray-700 text-sm">{{ __('Plan Zone') }}</label>
                            <div class="flex items-center pt-2">
                                <div class="flex items-center">
                                    <input type="radio" name="plan_zone" id="plan_zone_a" value="A" class="border-gray-300 text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" checked />
                                    <label for="plan_zone_a" class="text-gray-700 ml-2 text-sm ">{{ __('A') }}</label>
                                </div>
                                <div class="flex items-center ml-4">
                                    <input type="radio" name="plan_zone" id="plan_zone_b" value="B" class="border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                                    <label for="plan_zone_b" class="text-gray-700 ml-2 text-sm">{{ __('B') }}</label>
                                </div>
                                <div class="flex items-center ml-4">
                                    <input type="radio" name="plan_zone" id="plan_zone_c" value="C" class="border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                                    <label for="plan_zone_c" class="text-gray-700 ml-2 text-sm">{{ __('C') }}</label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="description" class="block text-gray-700 text-sm">{{ __('Sea View') }}</label>
                            <div class="flex items-center pt-2">
                                <div class="flex items-center">
                                    <input type="radio" name="sea_view" id="sea_view_yes" value="yes" class="border-gray-300 text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" checked />
                                    <label for="sea_view_yes" class="text-gray-700 ml-2 text-sm ">{{ __('Yes') }}</label>
                                </div>
                                <div class="flex items-center ml-4">
                                    <input type="radio" name="sea_view" id="sea_view_no" value="no" class="border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                                    <label for="sea_view_no" class="text-gray-700 ml-2 text-sm">{{ __('No') }}</label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="description" class="block text-gray-700 text-sm">{{ __('For Sale Board') }}</label>
                            <div class="flex items-center pt-2">
                                <div class="flex items-center">
                                    <input type="radio" name="for_sale_board" id="for_sale_board_yes" value="yes" class="border-gray-300 text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" checked />
                                    <label for="for_sale_board_yes" class="text-gray-700 ml-2 text-sm ">{{ __('Yes') }}</label>
                                </div>
                                <div class="flex items-center ml-4">
                                    <input type="radio" name="for_sale_board" id="for_sale_board_no" value="no" class="border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
                                    <label for="for_sale_board_no" class="text-gray-700 ml-2 text-sm">{{ __('No') }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 flex">
            <button type="submit" class="ml-auto px-4 py-2 bg-orange-400 text-white rounded-md hover:bg-orange-500 px-7">{{ __('Save and Next &#x2192;') }}</button>
        </div>
    </div>
</form>