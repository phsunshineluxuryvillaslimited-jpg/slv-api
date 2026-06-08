
<?php
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use Livewire\Volt\Component;
use App\Models\Property;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

new class extends Component
{
    public $regions = [];
    public $towns = [];
    public $regionTownMap  =  [
            'Paphos' => [
                'Acheleia','Agia Marina','Agia Marinouda','Agios Dimitrianos','Agios Georgios',
                'Akamas','Akoursos','Amargeti','Anarita','Anavargos','Aphrodite Hills','Argaka',
                'Arminou','Armou','Arodes','Chloraka','Choletria','Coral Bay','Droushia','Drymou',
                'Emba','Episcopi','Fyti','Geroskipou','Gialia','Giolou','Goudi','Ineia','Kallepia',
                'Kamares','Kathikas','Kato Paphos','Kissonerga','Koili','Koilineia','Koloni',
                'Konia','Kouklia','Kritou Terra','Lasa','Latchi','Lemona','Lempa','Letymvou',
                'Lysos','Makounta','Mandria','Marathounta','Mesa Chorio','Mesogi','Minthis Hills',
                'Nata','Neo Chorio','Paphos','Peyia','Polemi','Polis','Pomos','Prastio','Prodromi',
                'Psathi','Sea Caves','Secret Valley','Simou','Stroumpi','Tala','Theletra','Timi',
                'Tombs of the Kings','Tremithousa','Tsada','Universal'
            ],

            'Limassol' => [
                'Agia Fyla','Agias Zonis','Agios Amvrosios','Agios Athanasios','Agios Dimitrios',
                'Agios Georgios','Agios Ioannis','Agios Nektarios','Agios Nikolaos','Agios Pavlos',
                'Agios Sillas','Agios Theodoros','Agios Therapon','Agios Thomas','Agios Tychonas',
                'Agros','Akrotiri','Akrounta','Alassa','Amathus','Amiantos Kato','Anogyra',
                'Anthoupoli','Apesia','Apostolos Andreas','Apsiou','Arakapas','Armenochori',
                'Arsos','Asgata','Asomatos','Avdimou','Chandria','Columbia','Crown Plaza',
                'Dasoudi','Dierona','Dora','Doros','Dymes','Ekali','Episkopi','Eptagoneia',
                'Erimi','Fasoula','Foini','Foinikaria','Germasogeia','Kalo Chorio','Kalogiri',
                'Kantou','Kapsalos','Katholiki','Kato Platres','Kato Polemidia','Kellaki',
                'Kivides','Kolossi','Korfi','Laneia','Le Meridien','Limassol','Limassol Marina',
                'Linopetra','Lofou','Louvaras','Makarios Avenue III','Mesa Geitonia','Monagri',
                'Monagroulli','Moni','Moniatis','Mouttagiaka','Neapolis','Omodos','Omonia',
                'Pachna','Palodeia','Panthea','Paramali','Paramytha','Parekklisia','Pentakomo',
                'Pera Pedi','Phinikaria','Pissouri','Platres','Polemidia','Potamos Germasogias',
                'Prastio Avdimou','Prastio Kellaki','Prodomos','Pyrgos','Silikou','Sotira',
                'Souni-Zanatzia','Spitali','Trachoni','Treis Elies','Trimiklini','Tserkezoi',
                'Tsiflikoudia','Vasa Kellakiou','Vikla','Vouni','Ypsonas','Zakaki','Zygi'
            ],

            'Larnaca' => [
                'Agia Anna','Agioi Vavatsinias','Agios Nikolaos','Agios Theodoros','Alethriko',
                'Anglisides','Aradippou','Athienou','Avdellero','Dhekelia','Dromolaxia','Drosia',
                'Finikoudes','Kalavasos','Kamares','Kiti','Krasa','Larnaca','Lefkara','Livadia',
                'Mackenzie','Maroni','Mazotos','Meneou','Mosfiloti','Ormideia','Oroklini',
                'Pervolia','Petrofani','Psematismenos','Pyla','Sotiros','Tersefanou','Troulloi',
                'Vergina','Xylofagou','Zygi'
            ],

            'Famagusta' => [
                'Achna','Avgorou','Ayia Napa','Ayia Thekla','Ayia Triada','Cape Greco',
                'Deryneia','Famagusta','Frenaros','Kapparis','Liopetri','Paralimni',
                'Pernera','Protaras','Sotira','Vrysoulles'
            ],

            'Nicosia' => [
                'Agios Dometios','Aglandjia','Agrokipia','Analiontas','Anayia','Anthoupoli',
                'Archangelos','Arediou','Astromeritis','Dali','Deftera','Episkopeio',
                'Ergates','Geri','Inia','Kakopetria','Kalo Chorio','Kapedes','Klirou',
                'Kokkinotrimithia','Lakatamia','Latsia','Lythrodontas','Makedonitissa',
                'Mammari','Meniko','Mitsero','Nicosia','Nisou','Panagia','Palaiometocho',
                'Pera','Pera Chorio','Peristerona','Politiko','Sia','Strovolos',
                'Trachoni','Tseri','Vyzakia'
            ]
    ];

    public string $selectedRegion;

    /*******************
     * Validartion
     ******************/
    #[Validate('required|string')]
    public string $region;

    #[Validate('required|string')]
    public string $town_city;

    #[Validate('required')]
    public string $locality = 'All Locality';

    #[Validate('required|numeric|between:-90,90')]
    public float $latitude;

    #[Validate('required|numeric|between:-180,180')]
    public float $longitude;

    #[Validate('required|string')]
    public string $map_address;

    #[Validate('required|numeric')]
    public int $accuracy = 1000;

    public bool $isEdit = false;

    public ?Property $property = null;

    public function mount(Property $property, $isEdit = false): void
    {
        $this->property =  $property;
        $this->regions  = array_keys($this->regionTownMap);
        $this->isEdit   = $isEdit;

        if ($property && $property->address()->exists()) {
            $this->region       = $property->address->region;
            $this->town_city    = $property->address->town_city;
            $this->locality     = $property->address->locality;
            $this->latitude     = $property->address->latitude;
            $this->longitude    = $property->address->longitude;
            $this->map_address  = $property->address->map_address;
            $this->accuracy     = $property->address->accuracy;

            $this->towns            = $this->regionTownMap[$property->address->region];
            $this->selectedRegion   = $property->address->region;
        }
    }

    /**
     * feature when region select will filter town for the selected region
     */
    public function updatedRegion(string $region)
    {   
            $this->selectedRegion = $region;
            $this->towns = $this->regionTownMap[$region] ?? [];
            $this->town_city = '';
    }

    // for creating action
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
Property Location input form
------------------------------------------------------->
<div class="">
    <?php /*
    @if (session()->has('status'))
        <div class="mb-4 p-2 bg-green-100 text-green-700 rounded text-sm max-w-7xl mt-3 mx-auto sm:px-6 lg:px-8">
            {{  session('status') }}
        </div>
    @endif
    */ ?>
    <div class="max-w-7xl mt-3 mx-auto sm:px-6 lg:px-8">
        <span class="required-field"></span> <span class="text-sm text-gray-800">{{ __('Required fields') }}</span>
    </div>
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow-md sm:rounded-lg {{ $isEdit ? 'bg-orange-100/40' : '' }}">
                <div class="w-full">
                    <h3 class="font-semibold text-xl text-blue-900 leading-tight mb-5">
                        {{ __('Location')  }}
                    </h3>
                    <p class="mb-5 text-sm text-gray-600">{{ __('Select the location of the property. This will help your property show up in the correct location on the map and improve search results for location-based searches.') }}</p>
                    <div class="grid grid-cols-3 md:grid-cols-3 gap-5 mb-4">
                        <div>
                            <label for="region" class="required-field font-md block text-black text-sm mb-1">{{ __('Region') }}</label>
                            <select wire:model.live="region" id="region" class="w-full border-gray-300 text-sm rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                <option value="" selected class="text-gray-500">Select Region</option>
                                @foreach ($regions as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            @error('region') <span class="text-red-500 text-shadow-sm text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="town_city" class="required-field font-md block text-black text-sm mb-1">{{ __('Town / City') }}</label>
                            <select wire:model="town_city" name="town_city" id="town_city" @disabled(!$selectedRegion) class="w-full border-gray-300 text-sm rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="" selected class="text-gray-500">Select Town / City</option>
                                 @foreach($towns as $town)
                                    <option value="{{ $town }}">
                                        {{ $town }}
                                    </option>
                                @endforeach
                            </select>
                            @error('town') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="locality" class="font-md block text-black text-sm mb-1">{{ __('Locality') }}</label>
                            <select wire:model.live="locality" id="locality" class="w-full border-gray-300 text-sm rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="all locality" selected class="text-gray-500">All Locality</option>
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
                        {{ __('Map')  }} @if ( $isEdit ) <small class="text-yellow-500/100 font-medium font-custom">{{ __('- Edit') }} </small>@endif
                    </h3>
                    <p class="mb-5 text-sm text-gray-600">{{ __('Select the property location on the map. You can adjust the accuracy of the location by selecting a radius in metres.') }}
                        <br />
                        {{ __('This will help your property show up in the correct location on the map and improve search results for location-based searches.') }} 
                    </p>
                    <div class="grid grid-cols-3 md:grid-cols-3 gap-5 mb-4">
                        <div>
                            <label for="latitude" class="required-field font-md block text-black text-sm mb-1">{{ __('Latitude') }}</label>
                            <input type="number"
                                wire:model.ive="latitude" 
                                id="latitude" 
                                class="w-full border-gray-300 rounded-md text-sm  shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            />
                            @error('latitude') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="longitude" class="required-field font-md block text-black text-sm mb-1">{{ __('Longtitude') }}</label>
                            <input type="number" 
                                wire:model.live="longitude" 
                                id="longitude" 
                                class="w-full border-gray-300 rounded-md text-sm  shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                x-data
                                x-init="$watch('$el.value', value => $el.dispatchEvent(new Event('input', { bubbles: true })))"
                                required 
                            />
                            @error('longitude') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="locality" class="font-md block text-black text-sm mb-1">{{ __('Accuracy') }}</label>
                            <select wire:model="locality" id="locality" class="w-full border-gray-300 text-sm rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="1000" default>1000</option>
                                <option value="5000" >5000</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="required-field text-sm">Map Address</label>
                        <input type="text" 
                            wire:model.live="map_address" 
                            id="mapAddress" 
                            class="required-fields  w-full border-gray-300 rounded-md text-sm  shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            x-data
                            x-init="$watch('$el.value', value => $el.dispatchEvent(new Event('input', { bubbles: true })))"
                            required
                        />
                        @error('map_address') <span class="text-red-500 text-shadow-sm">{{ $message }}</span> @enderror
                    </div>
                    <div wire:ignore class="gmap border h-[700px] mt-4 bg-white p-1">
                        <div id="gmap" class="h-full">
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