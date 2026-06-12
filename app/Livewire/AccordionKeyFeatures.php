<?php

namespace App\Livewire;

use Illuminate\Validation\ValidationException;
use Livewire\Component;

class AccordionKeyFeatures extends Component
{
    public ?int $openItem = null;

    public $keyFeature = [
        [
            'id' => 1,
            'title' => 'Views',
            'fields' => [
                [
                    'label' => 'Sea and Mountain Views',
                    'name' => 'keyFeature.views.sea_and_mountain_views',
                    'value' => false,
                ],
                [
                    'label' => 'Sea Views',
                    'name' => 'keyFeature.views.sea_views',
                    'value' => false,
                ],
                [
                    'label' => 'Panoramic Views',
                    'name' => 'keyFeature.views.panoramic_views',
                    'value' => false,
                ],
                [
                    'label' => 'Views of Town and Sea',
                    'name' => 'keyFeature.views.views_of_town_and_sea',
                    'value' => false,
                ],
                [
                    'label' => 'Overlooking the Marina',
                    'name' => 'keyFeature.views.overlooking_the_marina',
                    'value' => true,
                ],
                [
                    'label' => 'Overlooking the Golf Course',
                    'name' => 'keyFeature.views.overlooking_the_golf_course',
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
                    'name' => 'keyFeature.orientation.east',
                    'value' => false,
                ],
                [
                    'label' => 'South',
                    'name' => 'keyFeature.orientation.south',
                    'value' => false,
                ],
                [
                    'label' => 'Southwest',
                    'name' => 'keyFeature.orientation.southwest',
                    'value' => false,
                ],
                [
                    'label' => 'Southeast',
                    'name' => 'keyFeature.orientation.southeast',
                    'value' => false,
                ],
                [
                    'label' => 'West',
                    'name' => 'keyFeature.orientation.west',
                    'value' => false,
                ],
                [
                    'label' => 'North',
                    'name' => 'keyFeature.orientation.north',
                    'value' => false,
                ],
                [
                    'label' => 'Northwest',
                    'name' => 'keyFeature.orientation.northwest',
                    'value' => false,
                ],
                [
                    'label' => 'Northeast',
                    'name' => 'keyFeature.orientation.northeast',
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
                    'name' => 'keyFeature.private_parking.covered_parking',
                    'value' => false,

                ],
                [
                    'label' => 'Uncovered Parking',
                    'name' => 'keyFeature.private_parking.uncovered_parking',
                    'value' => false,
                ],
                [
                    'label' => 'Automatic Gate',
                    'name' => 'keyFeature.private_parking.assisted_garage_door',
                    'value' => false,
                ],
                [
                    'label' => 'Garage N Cars',
                    'name' => 'keyFeature.private_parking.garage_n_cars',
                    'value' => ['', false],
                ],
                [
                    'label' => 'Carport N Cars',
                    'name' => 'keyFeature.private_parking.carport_n_cars',
                    'value' => ['', false],
                ],
                [
                    'label' => 'Parking Spaces',
                    'name' => 'keyFeature.private_parking.parking_spaces',
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
                    'name' => 'keyFeature.kitchen.open_kitchen',
                    'value' => false,

                ],
                [
                    'label' => 'Fitted Kitchen',
                    'name' => 'keyFeature.kitchen.fitted_kitchen',
                    'value' => false,
                ],
                [
                    'label' => 'Kitchenette',
                    'name' => 'keyFeature.kitchen.kitchenette',
                    'value' => false,
                ],
                [
                    'label' => 'Breakfast Bar',
                    'name' => 'keyFeature.kitchen.breakfast_bar',
                    'value' => false,
                ],
                [
                    'label' => 'L-shaped Kitchen',
                    'name' => 'keyFeature.kitchen.l_shaped_kitchen',
                    'value' => false,
                ],
                [
                    'label' => 'Pantry',
                    'name' => 'keyFeature.kitchen.pantry',
                    'value' => false,
                ],
                [
                    'label' => 'Marble Countertop',
                    'name' => 'keyFeature.kitchen.marble_countertop',
                    'value' => false,
                ],
                [
                    'label' => 'Granite Countertop',
                    'name' => 'keyFeature.kitchen.granite_countertop',
                    'value' => false,
                ],
                [
                    'label' => 'Silestone Countertop',
                    'name' => 'keyFeature.kitchen.silestone_countertop',
                    'value' => false,
                ],
                [
                    'label' => 'Cedar Countertop',
                    'name' => 'keyFeature.kitchen.cedar_countertop',
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
                    'name' => 'keyFeature.extras.maids_room',
                    'value' => false,
                ],
                [
                    'label' => 'Storage/Room',
                    'name' => 'keyFeature.extras.storage_room',
                    'value' => false,
                ],
                [
                    'label' => 'Sauna',
                    'name' => 'keyFeature.extras.sauna',
                    'value' => false,
                ],
                [
                    'label' => 'Laundry Room',
                    'name' => 'keyFeature.extras.laudry_room',
                    'value' => false,
                ],
                [
                    'label' => 'Cinema/TV',
                    'name' => 'keyFeature.extras.cinema_tv',
                    'value' => false,
                ],
                [
                    'label' => 'Wine Cellar',
                    'name' => 'keyFeature.extras.wine_cellar',
                    'value' => false,
                ],
                [
                    'label' => 'Bar',
                    'name' => 'keyFeature.extras.bar',
                    'value' => false,
                ],
                [
                    'label' => 'Private Security',
                    'name' => 'keyFeature.extras.private_security',
                    'value' => false,
                ],
                [
                    'label' => 'Security Room',
                    'name' => 'keyFeature.extras.security_room',
                    'value' => false,
                ],
                [
                    'label' => 'Smoke Detectors',
                    'name' => 'keyFeature.extras.smoke_detectors',
                    'value' => false,
                ],
                [
                    'label' => 'Security Shutters',
                    'name' => 'keyFeature.extras.security_shutters',
                    'value' => false,
                ],
                [
                    'label' => 'Security Windows',
                    'name' => 'keyFeature.extras.security_windows',
                    'value' => false,
                ],
                [
                    'label' => 'Double Glazed Windows',
                    'name' => 'keyFeature.extras.double_glazed_windows',
                    'value' => false,
                ],
                [
                    'label' => 'Electric Blinds',
                    'name' => 'keyFeature.extras.electric_blinds',
                    'value' => false,
                ],
                [
                    'label' => 'Manual Shutters',
                    'name' => 'keyFeature.extras.manual_shutters',
                    'value' => false,
                ],
                [
                    'label' => 'Safe',
                    'name' => 'keyFeature.extras.safe',
                    'value' => false,
                ],
                [
                    'label' => 'Alarm',
                    'name' => 'keyFeature.extras.alarm',
                    'value' => false,
                ],
                [
                    'label' => 'CCTV',
                    'name' => 'keyFeature.extras.cctv',
                    'value' => false,
                ],
                [
                    'label' => 'Concierge',
                    'name' => 'keyFeature.extras.concierge',
                    'value' => false,
                ],
                [
                    'label' => 'Concierge Services',
                    'name' => 'keyFeature.extras.concierge_services',
                    'value' => false,
                ],
                [
                    'label' => 'Playroom',
                    'name' => 'keyFeature.extras.playroom',
                    'value' => false,
                ],
                [
                    'label' => 'Tennis/Basket court',
                    'name' => 'keyFeature.extras.tennis_basket_court',
                    'value' => false,
                ],
                [
                    'label' => 'Gym/Fitness',
                    'name' => 'keyFeature.extras.gym_fitness',
                    'value' => false,
                ],
                [
                    'label' => 'Jacuzzi',
                    'name' => 'keyFeature.extras.jacuzzi',
                    'value' => false,
                ],
                [
                    'label' => 'BBQ',
                    'name' => 'keyFeature.extras.bbq',
                    'value' => false,
                ],
                [
                    'label' => 'Fireplace',
                    'name' => 'keyFeature.extras.fireplace',
                    'value' => false,
                ],
                [
                    'label' => 'Gas Fireplace',
                    'name' => 'keyFeature.extras.gas_fireplace',
                    'value' => false,
                ],
                [
                    'label' => 'Annex',
                    'name' => 'keyFeature.extras.annex',
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
                    'name' => 'keyFeature.heating.central_diesel_heating',
                    'value' => false,
                ],
                [
                    'label' => 'Storage Heaters',
                    'name' => 'keyFeature.heating.storage_heaters',
                    'value' => false,
                ],
                [
                    'label' => 'Central Gas Heating',
                    'name' => 'keyFeature.heating.central_gas_heating',
                    'value' => false,
                ],
                [
                    'label' => 'Central Oil Heating',
                    'name' => 'keyFeature.heating.central_oil_heating',
                    'value' => false,
                ],
                [
                    'label' => 'Floor Heating',
                    'name' => 'keyFeature.heating.floor_heating',
                    'value' => false,
                ],
                [
                    'label' => 'Solar Panels',
                    'name' => 'keyFeature.heating.solar_panels',
                    'value' => false,
                ],
                [
                    'label' => 'Fireplace',
                    'name' => 'keyFeature.heating.fireplace',
                    'value' => false,
                ],
                [
                    'label' => 'Radiators',
                    'name' => 'keyFeature.heating.radiators',
                    'value' => false,
                ],
                [
                    'label' => 'Gas Fireplace',
                    'name' => 'keyFeature.heating.gas_fireplace',
                    'value' => false,
                ],
                [
                    'label' => 'Hydronic (boiler)',
                    'name' => 'keyFeature.heating.hydronic_boiler',
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
                    'name' => 'keyFeature.air_conditioning.pre_installation',
                    'value' => false,
                ],
                [
                    'label' => 'VRV Air Conditioning',
                    'name' => 'keyFeature.air_conditioning.vrv_air_conditioning',
                    'value' => false,
                ],
                [
                    'label' => 'Room Unit Air Conditioning',
                    'name' => 'keyFeature.air_conditioning.room_unit_air_conditioning',
                    'value' => false,
                ],
                [
                    'label' => 'Central Air Conditioning',
                    'name' => 'keyFeature.air_conditioning.central_air_conditioning',
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
                    'name' => 'keyFeature.inclusions.ceramic_cook_top',
                    'value' => false,
                ],
                [
                    'label' => 'Hob',
                    'name' => 'keyFeature.inclusions.hob',
                    'value' => false,
                ],
                [
                    'label' => 'Structured Cabling',
                    'name' => 'keyFeature.inclusions.structured_cabling',
                    'value' => false,
                ],
                [
                    'label' => 'Suspended Ceiling',
                    'name' => 'keyFeature.inclusions.suspended_ceiling',
                    'value' => false,
                ],
                [
                    'label' => 'Gas Cook Top',
                    'name' => 'keyFeature.inclusions.gas_cook_top',
                    'value' => false,
                ],
                [
                    'label' => 'Oven',
                    'name' => 'keyFeature.inclusions.oven',
                    'value' => false,
                ],
                [
                    'label' => 'Microwave',
                    'name' => 'keyFeature.inclusions.microwave',
                    'value' => false,
                ],
                [
                    'label' => 'Extractor Fan',
                    'name' => 'keyFeature.inclusions.extractor_fan',
                    'value' => false,
                ],
                [
                    'label' => 'Dishwasher',
                    'name' => 'keyFeature.inclusions.dishwasher',
                    'value' => false,
                ],
                [
                    'label' => 'Dryer',
                    'name' => 'keyFeature.inclusions.dryer',
                    'value' => false,
                ],
                [
                    'label' => 'Carpet',
                    'name' => 'keyFeature.inclusions.carpet',
                    'value' => false,
                ],
                [
                    'label' => 'Television',
                    'name' => 'keyFeature.inclusions.television',
                    'value' => false,
                ],
                [
                    'label' => 'Water Filtration',
                    'name' => 'keyFeature.inclusions.water_filtration',
                    'value' => false,
                ],
                [
                    'label' => 'Satellite Dish',
                    'name' => 'keyFeature.inclusions.satellite_dish',
                    'value' => false,
                ],
                [
                    'label' => 'Water Softener',
                    'name' => 'keyFeature.inclusions.water_softener',
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
                    'name' => 'keyFeature.furnished.unfurnished',
                    'value' => false,
                ],
                [
                    'label' => 'Partly Furnished',
                    'name' => 'keyFeature.furnished.partly_furnished',
                    'value' => false,
                ],
                [
                    'label' => 'Furnished',
                    'name' => 'keyFeature.furnished.furnished',
                    'value' => false,
                ],
            ],
        ],

    ];

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
