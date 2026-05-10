
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
                        {{ __('Location')  }}
                    </h3>
                    <div class="grid grid-cols-3 md:grid-cols-3 gap-5 mb-4">
                        <div>
                            <label for="region" class="font-md block text-black text-sm mb-1">{{ __('Region') }}</label>
                            <select name="region" id="region" class="w-full border-gray-300 text-sm rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="paphos" default>Paphos</option>
                                <option value="paphos 2">Paphos 2</option>
                            </select>
                        </div>
                        <div>
                            <label for="town_city" class="font-md block text-black text-sm mb-1">{{ __('Town / City') }}</label>
                            <select name="town_city" id="town_city" class="w-full border-gray-300 text-sm rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="Geroskipou" default>Geroskipou</option>
                                <option value="Geroskipou 2" >Geroskipou 2</option>
                            </select>
                        </div>
                        <div>
                            <label for="locality" class="font-md block text-black text-sm mb-1">{{ __('Locality') }}</label>
                            <select name="locality" id="locality" class="w-full border-gray-300 text-sm rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="Geroskipou" default>Geroskipou</option>
                                <option value="Geroskipou 2" >Geroskipou 2</option>
                            </select>
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
                        {{ __('Map')  }}
                    </h3>
                    <div class="grid grid-cols-3 md:grid-cols-3 gap-5 mb-4">
                        <div>
                            <label for="latitude" class="font-md block text-black text-sm mb-1">{{ __('Latitude') }}</label>
                            <input type="number" name="latitude" id="latitude" class="w-full border-gray-300 rounded-md text-sm  shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                        <div>
                            <label for="longtitude" class="font-md block text-black text-sm mb-1">{{ __('Longtitude') }}</label>
                            <input type="number" name="longtitude" id="longtitude" class="w-full border-gray-300 rounded-md text-sm  shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                        <div>
                            <label for="locality" class="font-md block text-black text-sm mb-1">{{ __('Accuracy') }}</label>
                            <select name="locality" id="locality" class="w-full border-gray-300 text-sm rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="Pinpoint" default>Pinpoint</option>
                                <option value="Pinpoint 2" >Pinpoint 2</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="text-sm">Map Address</label>
                        <input type="text" name="address" class="w-full border-gray-300 rounded-md text-sm  shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                    </div>
                    <div class="gmap border h-96 mt-4">
                        <div id="gmap" class="h-full">
                            
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</form>
@push('scripts')
  <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDA2bC2oWiv5g9sPg799qjYor6xbcHXrSk&callback=initMap"
    defer
  ></script>
<script src="{{ url('/js/google.map.js') }}"></script>
@endpush