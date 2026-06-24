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

    #[Validate('nullable')]
    public $keyFeatures = [
        [
            'id' => 1,
            'title' => 'Views',
            'fields' => [
                [
                    'label' => 'Sea and Mountain Views',
                    'name' => 'keyFeatures.views.sea_and_mountain_views',
                    'value' => false,
                ],
                [
                    'label' => 'Sea Views',
                    'name' => 'keyFeatures.views.sea_views',
                    'value' => false,
                ],
                [
                    'label' => 'Panoramic Views',
                    'name' => 'keyFeatures.views.panoramic_views',
                    'value' => false,
                ],
                [
                    'label' => 'Views of Town and Sea',
                    'name' => 'keyFeatures.views.views_of_town_and_sea',
                    'value' => false,
                ],
                [
                    'label' => 'Overlooking the Marina',
                    'name' => 'keyFeatures.views.overlooking_the_marina',
                    'value' => true,
                ],
                [
                    'label' => 'Overlooking the Golf Course',
                    'name' => 'keyFeatures.views.overlooking_the_golf_course',
                    'value' => false,
                ],
            ],
        ],
        [
            'id' => 2,
            'title' => 'Orientation',
            'fields' => [
                [
                    'label' => 'East',
                    'name' => 'keyFeatures.orientation.east',
                    'value' => false,
                ],
                [
                    'label' => 'South',
                    'name' => 'keyFeatures.orientation.south',
                    'value' => false,
                ],
                [
                    'label' => 'Southwest',
                    'name' => 'keyFeatures.orientation.southwest',
                    'value' => false,
                ],
                [
                    'label' => 'Southeast',
                    'name' => 'keyFeatures.orientation.southeast',
                    'value' => false,
                ],
                [
                    'label' => 'West',
                    'name' => 'keyFeatures.orientation.west',
                    'value' => false,
                ],
                [
                    'label' => 'North',
                    'name' => 'keyFeatures.orientation.north',
                    'value' => false,
                ],
                [
                    'label' => 'Northwest',
                    'name' => 'keyFeatures.orientation.northwest',
                    'value' => false,
                ],
                [
                    'label' => 'Northeast',
                    'name' => 'keyFeatures.orientation.northeast',
                    'value' => false,
                ],

            ],
        ],
        [
            'id' => 3,
            'title' => 'Private Parking',
            'fields' => [
                [
                    'label' => 'Covered Parking',
                    'name' => 'keyFeatures.private_parking.covered_parking',
                    'value' => false,

                ],
                [
                    'label' => 'Uncovered Parking',
                    'name' => 'keyFeatures.private_parking.uncovered_parking',
                    'value' => false,
                ],
                [
                    'label' => 'Automatic Gate',
                    'name' => 'keyFeatures.private_parking.assisted_garage_door',
                    'value' => false,
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
                    'name' => 'keyFeatures.private_parking.parking_spaces',
                    'value' => false,
                ],
            ],
        ],
        [
            'id' => 4,
            'title' => 'Kitchen',
            'fields' => [
                [
                    'label' => 'Open Kitchen',
                    'name' => 'keyFeatures.kitchen.open_kitchen',
                    'value' => false,

                ],
                [
                    'label' => 'Fitted Kitchen',
                    'name' => 'keyFeatures.kitchen.fitted_kitchen',
                    'value' => false,
                ],
                [
                    'label' => 'Kitchenette',
                    'name' => 'keyFeatures.kitchen.kitchenette',
                    'value' => false,
                ],
                [
                    'label' => 'Breakfast Bar',
                    'name' => 'keyFeatures.kitchen.breakfast_bar',
                    'value' => false,
                ],
                [
                    'label' => 'L-shaped Kitchen',
                    'name' => 'keyFeatures.kitchen.l_shaped_kitchen',
                    'value' => false,
                ],
                [
                    'label' => 'Pantry',
                    'name' => 'keyFeatures.kitchen.pantry',
                    'value' => false,
                ],
                [
                    'label' => 'Marble Countertop',
                    'name' => 'keyFeatures.kitchen.marble_countertop',
                    'value' => false,
                ],
                [
                    'label' => 'Granite Countertop',
                    'name' => 'keyFeatures.kitchen.granite_countertop',
                    'value' => false,
                ],
                [
                    'label' => 'Silestone Countertop',
                    'name' => 'keyFeatures.kitchen.silestone_countertop',
                    'value' => false,
                ],
                [
                    'label' => 'Cedar Countertop',
                    'name' => 'keyFeatures.kitchen.cedar_countertop',
                    'value' => false,
                ],
            ],
        ],
        [
            'id' => 5,
            'title' => 'Extras',
            'fields' => [
                [
                    'label' => "Maid's Room",
                    'name' => 'keyFeatures.extras.maids_room',
                    'value' => false,
                ],
                [
                    'label' => 'Storage/Room',
                    'name' => 'keyFeatures.extras.storage_room',
                    'value' => false,
                ],
                [
                    'label' => 'Sauna',
                    'name' => 'keyFeatures.extras.sauna',
                    'value' => false,
                ],
                [
                    'label' => 'Laundry Room',
                    'name' => 'keyFeatures.extras.laudry_room',
                    'value' => false,
                ],
                [
                    'label' => 'Cinema/TV',
                    'name' => 'keyFeatures.extras.cinema_tv',
                    'value' => false,
                ],
                [
                    'label' => 'Wine Cellar',
                    'name' => 'keyFeatures.extras.wine_cellar',
                    'value' => false,
                ],
                [
                    'label' => 'Bar',
                    'name' => 'keyFeatures.extras.bar',
                    'value' => false,
                ],
                [
                    'label' => 'Private Security',
                    'name' => 'keyFeatures.extras.private_security',
                    'value' => false,
                ],
                [
                    'label' => 'Security Room',
                    'name' => 'keyFeatures.extras.security_room',
                    'value' => false,
                ],
                [
                    'label' => 'Smoke Detectors',
                    'name' => 'keyFeatures.extras.smoke_detectors',
                    'value' => false,
                ],
                [
                    'label' => 'Security Shutters',
                    'name' => 'keyFeatures.extras.security_shutters',
                    'value' => false,
                ],
                [
                    'label' => 'Security Windows',
                    'name' => 'keyFeatures.extras.security_windows',
                    'value' => false,
                ],
                [
                    'label' => 'Double Glazed Windows',
                    'name' => 'keyFeatures.extras.double_glazed_windows',
                    'value' => false,
                ],
                [
                    'label' => 'Electric Blinds',
                    'name' => 'keyFeatures.extras.electric_blinds',
                    'value' => false,
                ],
                [
                    'label' => 'Manual Shutters',
                    'name' => 'keyFeatures.extras.manual_shutters',
                    'value' => false,
                ],
                [
                    'label' => 'Safe',
                    'name' => 'keyFeatures.extras.safe',
                    'value' => false,
                ],
                [
                    'label' => 'Alarm',
                    'name' => 'keyFeatures.extras.alarm',
                    'value' => false,
                ],
                [
                    'label' => 'CCTV',
                    'name' => 'keyFeatures.extras.cctv',
                    'value' => false,
                ],
                [
                    'label' => 'Concierge',
                    'name' => 'keyFeatures.extras.concierge',
                    'value' => false,
                ],
                [
                    'label' => 'Concierge Services',
                    'name' => 'keyFeatures.extras.concierge_services',
                    'value' => false,
                ],
                [
                    'label' => 'Playroom',
                    'name' => 'keyFeatures.extras.playroom',
                    'value' => false,
                ],
                [
                    'label' => 'Tennis/Basket court',
                    'name' => 'keyFeatures.extras.tennis_basket_court',
                    'value' => false,
                ],
                [
                    'label' => 'Gym/Fitness',
                    'name' => 'keyFeatures.extras.gym_fitness',
                    'value' => false,
                ],
                [
                    'label' => 'Jacuzzi',
                    'name' => 'keyFeatures.extras.jacuzzi',
                    'value' => false,
                ],
                [
                    'label' => 'BBQ',
                    'name' => 'keyFeatures.extras.bbq',
                    'value' => false,
                ],
                [
                    'label' => 'Fireplace',
                    'name' => 'keyFeatures.extras.fireplace',
                    'value' => false,
                ],
                [
                    'label' => 'Gas Fireplace',
                    'name' => 'keyFeatures.extras.gas_fireplace',
                    'value' => false,
                ],
                [
                    'label' => 'Annex',
                    'name' => 'keyFeatures.extras.annex',
                    'value' => false,
                ],
            ],
        ],
        [
            'id' => 6,
            'title' => 'Heating',
            'fields' => [
                [
                    'label' => 'Central Diesel Heating',
                    'name' => 'keyFeatures.heating.central_diesel_heating',
                    'value' => false,
                ],
                [
                    'label' => 'Storage Heaters',
                    'name' => 'keyFeatures.heating.storage_heaters',
                    'value' => false,
                ],
                [
                    'label' => 'Central Gas Heating',
                    'name' => 'keyFeatures.heating.central_gas_heating',
                    'value' => false,
                ],
                [
                    'label' => 'Central Oil Heating',
                    'name' => 'keyFeatures.heating.central_oil_heating',
                    'value' => false,
                ],
                [
                    'label' => 'Floor Heating',
                    'name' => 'keyFeatures.heating.floor_heating',
                    'value' => false,
                ],
                [
                    'label' => 'Solar Panels',
                    'name' => 'keyFeatures.heating.solar_panels',
                    'value' => false,
                ],
                [
                    'label' => 'Fireplace',
                    'name' => 'keyFeatures.heating.fireplace',
                    'value' => false,
                ],
                [
                    'label' => 'Radiators',
                    'name' => 'keyFeatures.heating.radiators',
                    'value' => false,
                ],
                [
                    'label' => 'Gas Fireplace',
                    'name' => 'keyFeatures.heating.gas_fireplace',
                    'value' => false,
                ],
                [
                    'label' => 'Hydronic (boiler)',
                    'name' => 'keyFeatures.heating.hydronic_boiler',
                    'value' => false,
                ],
            ],
        ],
        [
            'id' => 7,
            'title' => 'Air Conditioning',
            'fields' => [
                [
                    'label' => 'Pre-Installation',
                    'name' => 'keyFeatures.air_conditioning.pre_installation',
                    'value' => false,
                ],
                [
                    'label' => 'VRV Air Conditioning',
                    'name' => 'keyFeatures.air_conditioning.vrv_air_conditioning',
                    'value' => false,
                ],
                [
                    'label' => 'Room Unit Air Conditioning',
                    'name' => 'keyFeatures.air_conditioning.room_unit_air_conditioning',
                    'value' => false,
                ],
                [
                    'label' => 'Central Air Conditioning',
                    'name' => 'keyFeatures.air_conditioning.central_air_conditioning',
                    'value' => false,
                ],
            ],
        ],
        [
            'id' => 8,
            'title' => 'Inclusions',
            'fields' => [
                [
                    'label' => 'Ceramic Cook Top',
                    'name' => 'keyFeatures.inclusions.ceramic_cook_top',
                    'value' => false,
                ],
                [
                    'label' => 'Hob',
                    'name' => 'keyFeatures.inclusions.hob',
                    'value' => false,
                ],
                [
                    'label' => 'Structured Cabling',
                    'name' => 'keyFeatures.inclusions.structured_cabling',
                    'value' => false,
                ],
                [
                    'label' => 'Suspended Ceiling',
                    'name' => 'keyFeatures.inclusions.suspended_ceiling',
                    'value' => false,
                ],
                [
                    'label' => 'Gas Cook Top',
                    'name' => 'keyFeatures.inclusions.gas_cook_top',
                    'value' => false,
                ],
                [
                    'label' => 'Oven',
                    'name' => 'keyFeatures.inclusions.oven',
                    'value' => false,
                ],
                [
                    'label' => 'Microwave',
                    'name' => 'keyFeatures.inclusions.microwave',
                    'value' => false,
                ],
                [
                    'label' => 'Extractor Fan',
                    'name' => 'keyFeatures.inclusions.extractor_fan',
                    'value' => false,
                ],
                [
                    'label' => 'Dishwasher',
                    'name' => 'keyFeatures.inclusions.dishwasher',
                    'value' => false,
                ],
                [
                    'label' => 'Dryer',
                    'name' => 'keyFeatures.inclusions.dryer',
                    'value' => false,
                ],
                [
                    'label' => 'Carpet',
                    'name' => 'keyFeatures.inclusions.carpet',
                    'value' => false,
                ],
                [
                    'label' => 'Television',
                    'name' => 'keyFeatures.inclusions.television',
                    'value' => false,
                ],
                [
                    'label' => 'Water Filtration',
                    'name' => 'keyFeatures.inclusions.water_filtration',
                    'value' => false,
                ],
                [
                    'label' => 'Satellite Dish',
                    'name' => 'keyFeatures.inclusions.satellite_dish',
                    'value' => false,
                ],
                [
                    'label' => 'Water Softener',
                    'name' => 'keyFeatures.inclusions.water_softener',
                    'value' => false,
                ],
            ],
        ],
        [
            'id' => 9,
            'title' => 'Furnished',
            'fields' => [
                [
                    'label' => 'Unfurnished',
                    'name' => 'keyFeatures.furnished.unfurnished',
                    'value' => false,
                ],
                [
                    'label' => 'Partly Furnished',
                    'name' => 'keyFeatures.furnished.partly_furnished',
                    'value' => false,
                ],
                [
                    'label' => 'Furnished',
                    'name' => 'keyFeatures.furnished.furnished',
                    'value' => false,
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
            $keyFeaturesWithValue = [];
            foreach ($keyFeatures as $keyfeature) {
                if (!isset($keyFeaturesWithValue[$keyfeature->name])) {
                    $keyFeaturesWithValue[$keyfeature->name] = [];
                }

                $keyFeaturesWithValue[$keyfeature->name] += [
                    "keyFeatures.{$keyfeature->name}.{$keyfeature->field}" => $keyfeature->value
                ];
            }
            
            foreach ($this->keyFeatures as &$varKeyFeature) {
                $key = str_replace(' ', '_', strtolower($varKeyFeature['title']));
                if(isset($keyFeaturesWithValue[$key])) {
                    foreach ($varKeyFeature['fields'] as &$field) {
                        if (isset($keyFeaturesWithValue[$key]) ) {
                            if (isset($keyFeaturesWithValue[$key][$field['name']])) {
                                $field['value'] = ((int) $keyFeaturesWithValue[$key][$field['name']] == 1 ) ? true : false;
                            }
                        }
                        continue;
                    }
                }
                unset($varKeyFeature);
            }
        }

        // dd($this->keyFeatures);
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
            $validatedData = $this->validate();
            // dd($validatedData);

            foreach ($validatedData as $key => $value) {
                foreach ($value as $name => $fields) {
                    if (is_numeric($name)) continue;
                    foreach ($fields as $k => $v) {
                        $this->property->keyFeatures()->updateOrCreate([
                            'property_id' => $this->property->id,
                            'name' => $name,
                            'field' => $k
                        ],
                        [
                            'name' => $name,
                            'field' => $k,
                            'value' => $v
                        ]);
                    }
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
