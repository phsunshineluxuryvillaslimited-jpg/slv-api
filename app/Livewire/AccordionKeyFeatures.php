<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Attributes\On;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use App\Models\Property;
use Livewire\Attributes\Modelable;

class AccordionKeyFeatures extends Component
{
    public ?int $openItem = null;

    public $keyFeatures = [
        'views' => [
            'sea_and_mountain_views' => false,
            'sea_views' => false,
            'panoramic_views' => false,
            'views_of_town_and_sea' => false,
            'overlooking_the_marina' => false,
            'overlooking_the_golf_course' => false
        ],
        'orientation' => [
            'east' => false,
            'south' => false,
            'southwest' => false,
            'southeast' => false,
            'sea_views' => false,
            'north' => false,
            'northwest' => false,
            'northeast' => false,
        ],
        'private_parking' => [
            'covered_parking' => false,
            'uncovered_parking' => false,
            'assisted_garage_door' => false,
            'garage_n_cars' => false,
            'carport_n_cars' => false,
            'parking_spaces' => false,
        ],
        'kitchen' => [
            'open_kitchen' => false,
            'fitted_kitchen' => false,
            'kitchenette' => false,
            'breakfast_bar' => false,
            'l_shaped_kitchen' => false,
            'pantry' => false,
            'marble_countertop' => false,
            'granite_countertop' => false,
            'silestone_countertop' => false,
            'cedar_countertop' => false,
        ],
        'extras' => [
            'maids_room' => false,
            'storage_room' => false,
            'sauna' => false,
            'laudry_room' => false,
            'cinema_tv' => false,
            'wine_cellar' => false,
            'bar' => false,
            'private_security' => false,
            'smoke_detectors' => false,
            'security_shutters' => false,
            'security_windows' => false,
            'double_glazed_windows' => false,
            'electric_blinds' => false,
            'manual_shutters' => false,
            'safe' => false,
            'alarm' => false,
            'cctv' => false,
            'concierge' => false,
            'concierge_services' => false,
            'playroom' => false,
            'tennis_basket_court' => false,
            'gym_fitness' => false,
            'jacuzzi' => false,
            'bbq' => false,
            'fireplace' => false,
            'gas_fireplace' => false,
            'annex' => false,
        ],
        'heating' => [
             'central_diesel_heating' => false,
            'storage_heaters' => false,
            'central_gas_heating' => false,
            'central_oil_heating' => false,
            'floor_heating' => false,
            'solar_panels' => false,
            'fireplace' => false,
            'radiators' => false,
            'gas_fireplace' => false,
            'hydronic_boiler' => false,
        ],
        'air_conditioning' => [
            'pre_installation' => false,
            'vrv_air_conditioning' => false,
            'room_unit_air_conditioning' => false,
            'central_air_conditioning' => false,
        ],
        'inclusions' => [
            'ceramic_cook_top' => false,
            'hob' => false,
            'structured_cabling' => false,
            'suspended_ceiling' => false,
            'gas_cook_top' => false,
            'oven' => false,
            'microwave' => false,
            'dishwasher' => false,
            'dryer' => false,
            'carpet' => false,
            'television' => false,
            'water_filtration' => false,
            'satellite_dish' => false,
            'water_softener' => false,
        ],
        'furnished' => [
            'unfurnished' => false,
            'partly_furnished' => false,
            'furnished' => false,
        ]
    ];

    #[Validate('nullable')]
    public $fields = [
        [
            'id' => 1,
            'title' => 'Views',
            'fields' => [
                [
                    'label' => 'Sea and Mountain Views',
                    'name' => 'keyFeatures.views.sea_and_mountain_views'
                ],
                [
                    'label' => 'Sea Views',
                    'name' => 'keyFeatures.views.sea_views'
                ],
                [
                    'label' => 'Panoramic Views',
                    'name' => 'keyFeatures.views.panoramic_views'
                ],
                [
                    'label' => 'Views of Town and Sea',
                    'name' => 'keyFeatures.views.views_of_town_and_sea'
                ],
                [
                    'label' => 'Overlooking the Marina',
                    'name' => 'keyFeatures.views.overlooking_the_marina',
                    'value' => true,
                ],
                [
                    'label' => 'Overlooking the Golf Course',
                    'name' => 'keyFeatures.views.overlooking_the_golf_course'
                ],
            ],
        ],
        [
            'id' => 2,
            'title' => 'Orientation',
            'fields' => [
                [
                    'label' => 'East',
                    'name' => 'keyFeatures.orientation.east'
                ],
                [
                    'label' => 'South',
                    'name' => 'keyFeatures.orientation.south'
                ],
                [
                    'label' => 'Southwest',
                    'name' => 'keyFeatures.orientation.southwest'
                ],
                [
                    'label' => 'Southeast',
                    'name' => 'keyFeatures.orientation.southeast'
                ],
                [
                    'label' => 'West',
                    'name' => 'keyFeatures.orientation.west'
                ],
                [
                    'label' => 'North',
                    'name' => 'keyFeatures.orientation.north'
                ],
                [
                    'label' => 'Northwest',
                    'name' => 'keyFeatures.orientation.northwest'
                ],
                [
                    'label' => 'Northeast',
                    'name' => 'keyFeatures.orientation.northeast'
                ],

            ],
        ],
        [
            'id' => 3,
            'title' => 'Private Parking',
            'fields' => [
                [
                    'label' => 'Covered Parking',
                    'name' => 'keyFeatures.private_parking.covered_parking'

                ],
                [
                    'label' => 'Uncovered Parking',
                    'name' => 'keyFeatures.private_parking.uncovered_parking'
                ],
                [
                    'label' => 'Automatic Gate',
                    'name' => 'keyFeatures.private_parking.assisted_garage_door'
                ],
                [
                    'label' => 'Garage N Cars',
                    'name' => 'keyFeatures.private_parking.garage_n_cars',
                    'value' => ['', false],
                ],
                [
                    'label' => 'Carport N Cars',
                    'name' => 'keyFeatures.private_parking.carport_n_cars',
                    'value' => ['', false],
                ],
                [
                    'label' => 'Parking Spaces',
                    'name' => 'keyFeatures.private_parking.parking_spaces'
                ],
            ],
        ],
        [
            'id' => 4,
            'title' => 'Kitchen',
            'fields' => [
                [
                    'label' => 'Open Kitchen',
                    'name' => 'keyFeatures.kitchen.open_kitchen'

                ],
                [
                    'label' => 'Fitted Kitchen',
                    'name' => 'keyFeatures.kitchen.fitted_kitchen'
                ],
                [
                    'label' => 'Kitchenette',
                    'name' => 'keyFeatures.kitchen.kitchenette'
                ],
                [
                    'label' => 'Breakfast Bar',
                    'name' => 'keyFeatures.kitchen.breakfast_bar'
                ],
                [
                    'label' => 'L-shaped Kitchen',
                    'name' => 'keyFeatures.kitchen.l_shaped_kitchen'
                ],
                [
                    'label' => 'Pantry',
                    'name' => 'keyFeatures.kitchen.pantry'
                ],
                [
                    'label' => 'Marble Countertop',
                    'name' => 'keyFeatures.kitchen.marble_countertop'
                ],
                [
                    'label' => 'Granite Countertop',
                    'name' => 'keyFeatures.kitchen.granite_countertop'
                ],
                [
                    'label' => 'Silestone Countertop',
                    'name' => 'keyFeatures.kitchen.silestone_countertop'
                ],
                [
                    'label' => 'Cedar Countertop',
                    'name' => 'keyFeatures.kitchen.cedar_countertop'
                ],
            ],
        ],
        [
            'id' => 5,
            'title' => 'Extras',
            'fields' => [
                [
                    'label' => "Maid's Room",
                    'name' => 'keyFeatures.extras.maids_room'
                ],
                [
                    'label' => 'Storage/Room',
                    'name' => 'keyFeatures.extras.storage_room'
                ],
                [
                    'label' => 'Sauna',
                    'name' => 'keyFeatures.extras.sauna'
                ],
                [
                    'label' => 'Laundry Room',
                    'name' => 'keyFeatures.extras.laudry_room'
                ],
                [
                    'label' => 'Cinema/TV',
                    'name' => 'keyFeatures.extras.cinema_tv'
                ],
                [
                    'label' => 'Wine Cellar',
                    'name' => 'keyFeatures.extras.wine_cellar'
                ],
                [
                    'label' => 'Bar',
                    'name' => 'keyFeatures.extras.bar'
                ],
                [
                    'label' => 'Private Security',
                    'name' => 'keyFeatures.extras.private_security'
                ],
                [
                    'label' => 'Security Room',
                    'name' => 'keyFeatures.extras.security_room'
                ],
                [
                    'label' => 'Smoke Detectors',
                    'name' => 'keyFeatures.extras.smoke_detectors'
                ],
                [
                    'label' => 'Security Shutters',
                    'name' => 'keyFeatures.extras.security_shutters'
                ],
                [
                    'label' => 'Security Windows',
                    'name' => 'keyFeatures.extras.security_windows'
                ],
                [
                    'label' => 'Double Glazed Windows',
                    'name' => 'keyFeatures.extras.double_glazed_windows'
                ],
                [
                    'label' => 'Electric Blinds',
                    'name' => 'keyFeatures.extras.electric_blinds'
                ],
                [
                    'label' => 'Manual Shutters',
                    'name' => 'keyFeatures.extras.manual_shutters'
                ],
                [
                    'label' => 'Safe',
                    'name' => 'keyFeatures.extras.safe'
                ],
                [
                    'label' => 'Alarm',
                    'name' => 'keyFeatures.extras.alarm'
                ],
                [
                    'label' => 'CCTV',
                    'name' => 'keyFeatures.extras.cctv'
                ],
                [
                    'label' => 'Concierge',
                    'name' => 'keyFeatures.extras.concierge'
                ],
                [
                    'label' => 'Concierge Services',
                    'name' => 'keyFeatures.extras.concierge_services'
                ],
                [
                    'label' => 'Playroom',
                    'name' => 'keyFeatures.extras.playroom'
                ],
                [
                    'label' => 'Tennis/Basket court',
                    'name' => 'keyFeatures.extras.tennis_basket_court'
                ],
                [
                    'label' => 'Gym/Fitness',
                    'name' => 'keyFeatures.extras.gym_fitness'
                ],
                [
                    'label' => 'Jacuzzi',
                    'name' => 'keyFeatures.extras.jacuzzi'
                ],
                [
                    'label' => 'BBQ',
                    'name' => 'keyFeatures.extras.bbq'
                ],
                [
                    'label' => 'Fireplace',
                    'name' => 'keyFeatures.extras.fireplace'
                ],
                [
                    'label' => 'Gas Fireplace',
                    'name' => 'keyFeatures.extras.gas_fireplace'
                ],
                [
                    'label' => 'Annex',
                    'name' => 'keyFeatures.extras.annex'
                ],
            ],
        ],
        [
            'id' => 6,
            'title' => 'Heating',
            'fields' => [
                [
                    'label' => 'Central Diesel Heating',
                    'name' => 'keyFeatures.heating.central_diesel_heating'
                ],
                [
                    'label' => 'Storage Heaters',
                    'name' => 'keyFeatures.heating.storage_heaters'
                ],
                [
                    'label' => 'Central Gas Heating',
                    'name' => 'keyFeatures.heating.central_gas_heating'
                ],
                [
                    'label' => 'Central Oil Heating',
                    'name' => 'keyFeatures.heating.central_oil_heating'
                ],
                [
                    'label' => 'Floor Heating',
                    'name' => 'keyFeatures.heating.floor_heating'
                ],
                [
                    'label' => 'Solar Panels',
                    'name' => 'keyFeatures.heating.solar_panels'
                ],
                [
                    'label' => 'Fireplace',
                    'name' => 'keyFeatures.heating.fireplace'
                ],
                [
                    'label' => 'Radiators',
                    'name' => 'keyFeatures.heating.radiators'
                ],
                [
                    'label' => 'Gas Fireplace',
                    'name' => 'keyFeatures.heating.gas_fireplace'
                ],
                [
                    'label' => 'Hydronic (boiler)',
                    'name' => 'keyFeatures.heating.hydronic_boiler'
                ],
            ],
        ],
        [
            'id' => 7,
            'title' => 'Air Conditioning',
            'fields' => [
                [
                    'label' => 'Pre-Installation',
                    'name' => 'keyFeatures.air_conditioning.pre_installation'
                ],
                [
                    'label' => 'VRV Air Conditioning',
                    'name' => 'keyFeatures.air_conditioning.vrv_air_conditioning'
                ],
                [
                    'label' => 'Room Unit Air Conditioning',
                    'name' => 'keyFeatures.air_conditioning.room_unit_air_conditioning'
                ],
                [
                    'label' => 'Central Air Conditioning',
                    'name' => 'keyFeatures.air_conditioning.central_air_conditioning'
                ],
            ],
        ],
        [
            'id' => 8,
            'title' => 'Inclusions',
            'fields' => [
                [
                    'label' => 'Ceramic Cook Top',
                    'name' => 'keyFeatures.inclusions.ceramic_cook_top'
                ],
                [
                    'label' => 'Hob',
                    'name' => 'keyFeatures.inclusions.hob'
                ],
                [
                    'label' => 'Structured Cabling',
                    'name' => 'keyFeatures.inclusions.structured_cabling'
                ],
                [
                    'label' => 'Suspended Ceiling',
                    'name' => 'keyFeatures.inclusions.suspended_ceiling'
                ],
                [
                    'label' => 'Gas Cook Top',
                    'name' => 'keyFeatures.inclusions.gas_cook_top'
                ],
                [
                    'label' => 'Oven',
                    'name' => 'keyFeatures.inclusions.oven'
                ],
                [
                    'label' => 'Microwave',
                    'name' => 'keyFeatures.inclusions.microwave'
                ],
                [
                    'label' => 'Extractor Fan',
                    'name' => 'keyFeatures.inclusions.extractor_fan'
                ],
                [
                    'label' => 'Dishwasher',
                    'name' => 'keyFeatures.inclusions.dishwasher'
                ],
                [
                    'label' => 'Dryer',
                    'name' => 'keyFeatures.inclusions.dryer'
                ],
                [
                    'label' => 'Carpet',
                    'name' => 'keyFeatures.inclusions.carpet'
                ],
                [
                    'label' => 'Television',
                    'name' => 'keyFeatures.inclusions.television'
                ],
                [
                    'label' => 'Water Filtration',
                    'name' => 'keyFeatures.inclusions.water_filtration'
                ],
                [
                    'label' => 'Satellite Dish',
                    'name' => 'keyFeatures.inclusions.satellite_dish'
                ],
                [
                    'label' => 'Water Softener',
                    'name' => 'keyFeatures.inclusions.water_softener'
                ],
            ],
        ],
        [
            'id' => 9,
            'title' => 'Furnished',
            'fields' => [
                [
                    'label' => 'Unfurnished',
                    'name' => 'keyFeatures.furnished.unfurnished'
                ],
                [
                    'label' => 'Partly Furnished',
                    'name' => 'keyFeatures.furnished.partly_furnished'
                ],
                [
                    'label' => 'Furnished',
                    'name' => 'keyFeatures.furnished.furnished'
                ],
            ],
        ],

    ];

    public ?Property $property;

    public bool $isEdit = false;

    public function mount(Property $property, $isEdit = false): void
    {
        $this->property = $property;
        $this->isEdit   = $isEdit;

        if ($isEdit) {
            $keyFeatures = $this->property->keyFeatures()->get();
            foreach ($keyFeatures as $keyfeature) {

                $this->keyFeatures[$keyfeature['name']][$keyfeature['field']] = (bool) $keyfeature['value'];
            }
        }
    }

    #[On('parentNextStepButtonTriggered')]
    public function hundleNextStepButtonTriggered()
    {
        try {
            $validatedData = $this->validate();
            // dd($validatedData);

            foreach ($validatedData as $key => $value) {
                foreach ($value as $name => $fields) {
                    if (is_numeric($name)) continue;
                    foreach ($fields as $k => $v) {
                        $this->property->keyFeatures()->updateOrCreate([
                            'property_id' => $this->property->id,
                            'name' => $name
                        ],
                        [
                            'name' => $name,
                            'field' => $k,
                            'value' => $v
                        ]);
                    }
                }
            }

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
            // $validatedData = $this->validate();
            foreach ($this->keyFeatures as $name => $fields) {
                foreach ($fields as $field => $value) {
                    $this->property->keyFeatures()->updateOrCreate([
                            'property_id' => $this->property->id,
                            'name' => $name,
                            'field' => $field
                        ],
                        [
                            'name' => $name,
                            'field' => $field,
                            'value' => $value
                        ]);
                }
            }

            $this->dispatch('update-is-success');            
         } catch (ValidationException $e) {
            Log::info('Property validation error. Please double check.');
            throw $e;
        }
        
    }

    public function toggle(int $id)
    {
        try {
            $this->openItem = $this->openItem === $id ? null : $id;
        } catch (ValidationException $e) {
            dd($e);
        }
    }

    public function render()
    {
        return view('livewire.accordion-key-features');
    }
}