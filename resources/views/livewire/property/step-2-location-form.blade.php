
<?php
use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use Livewire\Volt\Component;
use App\Models\PropertyAddress;

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

    public array $selectedRegion;
    public array $selectedTown;
    public array $selectedLocality;

    /*******************
     * Validartion
     ******************/
    #[Validate('required|string')]
    public string $region;

    #[Validate('required|string')]
    public string $town_city;

    #[Validate('required|string')]
    public string $localty;

    #[Validate('required|decimal:10.8')]
    public float $latitude;

    #[Validate('required|decimal:11.8')]
    public float $longtitue;

    #[Validate('required|string')]
    public string $map_address;

    #[Validate('required|string')]
    public string $map_accuracy;

    #[Validate('required|numeric')]
    public int $property_id;

    public function mount(): void
    {
        $this->regions = array_keys($this->regionTownMap);
    }

    public function updatedSelectedRegion(string $region)
    { 
            $this->towns = $this->regionTownMap[$region] ?? [];
            $this->selectedTown = [];
            $this->selectedLocality = [];
    }

    #[On('parentNextStepButtonTriggered')]
    public function hundleNextStepButtonTriggered(int $currentStep)
    {
        dd($currentStep);
        $this->validate();
    }
}

?>
<!-----------------------------------------------------
Property Location input form
------------------------------------------------------->
<div>
    <div class="max-w-7xl mt-3 mx-auto sm:px-6 lg:px-8">
        <span class="required-field"></span> <span class="text-sm text-gray-800">{{ __('Required fields') }}</span>
    </div>
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow-md sm:rounded-lg">
                <div class="w-full">
                    <h3 class="font-semibold text-xl text-blue-900 leading-tight mb-5">
                        {{ __('Location')  }}
                    </h3>
                    <input type="hidden" wire:modal.live="property_id" value="{{ propertyId }}"/>
                    <p class="mb-5 text-sm text-gray-600">{{ __('Select the location of the property. This will help your property show up in the correct location on the map and improve search results for location-based searches.') }}</p>
                    <div class="grid grid-cols-3 md:grid-cols-3 gap-5 mb-4">
                        <div>
                            <label for="region" class="required-field font-md block text-black text-sm mb-1">{{ __('Region') }}</label>
                            <select wire:model.live="selectedRegion" name="region" id="region" class="w-full border-gray-300 text-sm rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                <option value="" selected class="text-gray-500">Select Region</option>
                                @foreach ($regions as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="town_city" class="required-field font-md block text-black text-sm mb-1">{{ __('Town / City') }}</label>
                            <select wire:model="selectedTown" name="town_city" id="town_city" @disabled(!$selectedRegion) class="w-full border-gray-300 text-sm rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="" selected class="text-gray-500">Select Town / City</option>
                                 @foreach($towns as $town)
                                    <option value="{{ $town }}">
                                        {{ $town }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="locality" class="required-field font-md block text-black text-sm mb-1">{{ __('Locality') }}</label>
                            <select wire:model="selectedLocality" name="locality" id="locality" @disabled(!$selectedTown) class="w-full border-gray-300 text-sm rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="" selected class="text-gray-500">Select Locality</option>
                               
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
                    <p class="mb-5 text-sm text-gray-600">{{ __('Select the property location on the map. You can adjust the accuracy of the location by selecting a radius in metres.') }}
                        <br />
                        {{ __('This will help your property show up in the correct location on the map and improve search results for location-based searches.') }} 
                    </p>
                    <div class="grid grid-cols-3 md:grid-cols-3 gap-5 mb-4">
                        <div>
                            <label for="latitude" class="required-field font-md block text-black text-sm mb-1">{{ __('Latitude') }}</label>
                            <input type="number" name="latitude" id="latitude" class="w-full border-gray-300 rounded-md text-sm  shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                        <div>
                            <label for="longtitude" class="required-field font-md block text-black text-sm mb-1">{{ __('Longtitude') }}</label>
                            <input type="number" name="longtitude" id="longtitude" class="w-full border-gray-300 rounded-md text-sm  shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required />
                        </div>
                        <div>
                            <label for="locality" class="font-md block text-black text-sm mb-1">{{ __('Accuracy') }}</label>
                            <select name="locality" id="locality" class="w-full border-gray-300 text-sm rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="1000" default>1000</option>
                                <option value="5000" >5000</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="required-field text-sm">Map Address</label>
                        <input type="text" name="map_address" id="mapAddress" class="w-full border-gray-300 rounded-md text-sm  shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                    </div>
                    <div wire:ignore class="gmap border h-96 mt-4">
                        <div id="gmap" class="h-full">
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</div>