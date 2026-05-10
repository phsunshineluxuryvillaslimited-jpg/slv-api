
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
                            <label for="amenities" class="block text-black text-sm mb-1">{{ __('Amenities (km)') }}</label>
                            <input type="number" name="amenities" id="amenities" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                        <div>
                            <label for="airport" class="block text-black text-sm mb-1">{{ __('Airport (km)') }}</label>
                            <input type="number" name="airport" id="airport" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                        <div>
                            <label for="sea" class="block text-black text-sm mb-1">{{ __('Sea (km)') }}</label>
                            <input type="number" name="sea" id="sea" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                    </div>
                    <div class="grid grid-cols-3 md:grid-cols-3 gap-5 mb-4">
                         <div>
                            <label for="public_transport" class="block text-black text-sm mb-1">{{ __('Public Transaport (km)') }}</label>
                            <input type="number" name="public_transport" id="public_transport" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                        <div>
                            <label for="schools" class="block text-black text-sm mb-1">{{ __('Schools (km)') }}</label>
                            <input type="number" name="schools" id="schools" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
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
                    <div class="grid grid-cols-5 md:grid-cols-5 gap-5 mb-4">
                         <div>
                            <label for="covered" class="block text-black text-sm mb-1">{{ __('Covered m²') }}</label>
                            <input type="number" name="covered" id="covered" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                        <div>
                            <label for="plot" class="block text-black text-sm mb-1">{{ __('Plot m²') }}</label>
                            <input type="number" name="plot" id="plot" class="w-full border-gray-300 rounded-md text-sm shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
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
</form>