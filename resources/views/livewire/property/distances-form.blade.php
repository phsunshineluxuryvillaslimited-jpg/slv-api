
<!-----------------------------------------------------
Add your form or content for adding a property here
------------------------------------------------------->
<form method="POST" action="{{ route('properties.store') }}">
@csrf

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
                    <div class="grid grid-cols-3 md:grid-cols-3 gap-5 mb-4">
                         <div>
                            <label for="bedrooms" class="block text-black text-sm mb-1">{{ __('Amenities (km)') }}</label>
                            <input type="number" name="bedrooms" id="bedrooms" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                        <div>
                            <label for="bathrooms" class="block text-black text-sm mb-1">{{ __('Airport (km)') }}</label>
                            <input type="number" name="bathrooms" id="bathrooms" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                        <div>
                            <label for="bathrooms" class="block text-black text-sm mb-1">{{ __('Sea (km)') }}</label>
                            <input type="number" name="bathrooms" id="bathrooms" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                    </div>
                    <div class="grid grid-cols-3 md:grid-cols-3 gap-5 mb-4">
                         <div>
                            <label for="bedrooms" class="block text-black text-sm mb-1">{{ __('Schools (km)') }}</label>
                            <input type="number" name="bedrooms" id="bedrooms" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                        <div>
                            <label for="bathrooms" class="block text-black text-sm mb-1">{{ __('Schools (km)') }}</label>
                            <input type="number" name="bathrooms" id="bathrooms" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                        <div>
                            <label for="bathrooms" class="block text-black text-sm mb-1">{{ __('Resort (km)') }}</label>
                            <input type="number" name="bathrooms" id="bathrooms" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
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
                    <div class="grid grid-cols-5 md:grid-cols-5 gap-5 mb-4">
                         <div>
                            <label for="bedrooms" class="block text-black text-sm mb-1">{{ __('Covered m²') }}</label>
                            <input type="number" name="bedrooms" id="bedrooms" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                        <div>
                            <label for="bathrooms" class="block text-black text-sm mb-1">{{ __('Plot m²') }}</label>
                            <input type="number" name="bathrooms" id="bathrooms" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                        <div>
                            <label for="bathrooms" class="block text-black text-sm mb-1">{{ __('Resort (km)') }}</label>
                            <input type="number" name="bathrooms" id="bathrooms" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                        <div>
                            <label for="bathrooms" class="block text-black text-sm mb-1">{{ __('Schools (km)') }}</label>
                            <input type="number" name="bathrooms" id="bathrooms" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                        <div>
                            <label for="bathrooms" class="block text-black text-sm mb-1">{{ __('Resort (km)') }}</label>
                            <input type="number" name="bathrooms" id="bathrooms" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                    </div>


                    <div class="grid grid-cols-5 md:grid-cols-5 gap-5 mb-4">
                         <div>
                            <label for="bedrooms" class="block text-black text-sm mb-1">{{ __('Covered m²') }}</label>
                            <input type="number" name="bedrooms" id="bedrooms" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                        <div>
                            <label for="bathrooms" class="block text-black text-sm mb-1">{{ __('Schools (km)') }}</label>
                            <input type="number" name="bathrooms" id="bathrooms" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                        <div>
                            <label for="bathrooms" class="block text-black text-sm mb-1">{{ __('Resort (km)') }}</label>
                            <input type="number" name="bathrooms" id="bathrooms" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                        <div>
                            <label for="bathrooms" class="block text-black text-sm mb-1">{{ __('Schools (km)') }}</label>
                            <input type="number" name="bathrooms" id="bathrooms" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                        <div>
                            <label for="bathrooms" class="block text-black text-sm mb-1">{{ __('Resort (km)') }}</label>
                            <input type="number" name="bathrooms" id="bathrooms" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</form>