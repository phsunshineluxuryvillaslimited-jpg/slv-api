<?php

namespace App\Livewire;

use Livewire\Component;

class AccordionKeyFeatures extends Component
{
    public ?int $openItem = null;

    public $items = [
        [
            'id' => 1,
            'title' => 'Views',
            'fields' => [
                [
                    'label' => 'Sea and Mountain Views',
                    'name' => 'views[sea_and_mountain_views]',
                    'value' => false
                ],
                [
                    'label' => 'Sea Views',
                    'name' => 'views[sea_views]',
                    'value' => false
                ],
                [
                    'label' => 'Panoramic Views',
                    'name' => 'views[panoramic_views]',
                    'value' => false
                ],
                [
                    'label' => 'Views_of_Town_and_Sea',
                    'name' => 'views[views_of_town_and_sea]',
                    'value' => false
                ],
                [
                    'label' => 'Overlooking the Marina',
                    'name' => 'views[overlooking_the_marina]',
                    'value' => true
                ],
                [
                    'label' => 'Overlooking the Golf Course',
                    'name' => 'views[overlooking_the_golf_course]',
                    'value' => false
                ],
            ]
        ],
        [
            'id' => 2,
            'title' => 'Orientation',
            'fields' => [
                [
                    'label' => 'East',
                    'name' => 'orientation[east]',
                    'value' => false
                ],
                [
                    'label' => 'South',
                    'name' => 'orientation[south]',
                    'value' => false
                ],
                [
                    'label' => 'Southwest',
                    'name' => 'orientation[southwest]',
                    'value' => false
                ],
                [
                    'label' => 'Southeast',
                    'name' => 'orientation[southeast]',
                    'value' => false
                ],
                [
                    'label' => 'West',
                    'name' => 'orientation[west]',
                    'value' => false
                ],
                [
                    'label' => 'North',
                    'name' => 'orientation[north]',
                    'value' => false
                ],
                [
                    'label' => 'Northwest',
                    'name' => 'orientation[northwest]',
                    'value'=> false
                ],
                [
                    'label' => 'Northeast',
                    'name' => 'orientation[northeast]',
                    'value' => false
                ],
                
            ]
        ],
        [
            'id' => 3,
            'title' => 'Private Parking',
            'fields' => [
                [
                    'label' => 'Covered Parking',
                    'name' => 'private_parking[covered_parking]',
                    'value' => false

                ],
                [
                    'label' => 'Uncovered Parking',
                    'name' => 'private_parking[uncovered_parking]',
                    'value'=> false
                ],
                [
                    'label'=> 'Automatic Gate',
                    'name' => 'private_parking[assisted_garage_door]',
                    'value'=> false
                ],
                [
                    'label'=> 'Garage N Cars',
                    'name' => 'private_parking[garage_n_cars]',
                    'value'=> ['', false]
                ],
                [
                    'label'=> 'Carport N Cars',
                    'name' => 'private_parking[carport_n_cars]',
                    'value'=> ['', false]
                ],
                [
                    'label'=> 'Parking Spaces',
                    'name' => 'private_parking[parking_spaces]',
                    'value'=> false
                ]
            ]
        ],
        [
            'id' => 4,
            'title' => 'Kitchen',
            'fields' => [
                [
                    'label' => 'Open Kitchen',
                    'name' => 'kitchen[open_kitchen]',
                    'value' => false

                ],
                [
                    'label' => 'Fitted Kitchen',
                    'name' => 'kitchen[fitted_kitchen]',
                    'value'=> false
                ],
                [
                    'label'=> 'Kitchenette',
                    'name' => 'kitchen[fitted_kitchen]',
                    'value'=> false
                ],
                [
                    'label'=> 'Breakfast Bar',
                    'name' => 'kitchen[breakfast_bar]',
                    'value'=> false
                ],
                [
                    'label'=> 'L-shaped Kitchen',
                    'name' => 'kitchen[l_shaped_kitchen]',
                    'value'=> false
                ],
                [
                    'label'=> 'Pantry',
                    'name' => 'kitchen[pantry]',
                    'value'=> false
                ],
                [
                    'label'=> 'Marble Countertop',
                    'name' => 'kitchen[marble_countertop]',
                    'value'=> false
                ],
                [
                    'label'=> 'Granite Countertop',
                    'name' => 'kitchen[granite_countertop]',
                    'value'=> false
                ],
                [
                    'label'=> 'Silestone Countertop',
                    'name' => 'kitchen[silestone_countertop]',
                    'value'=> false
                ],
                [
                    'label'=> 'Cedar Countertop',
                    'name' => 'kitchen[cedar_countertop]',
                    'value'=> false
                ]
            ]
        ],
        [
            'id' => 5,
            'title' => 'Extras',
            'fields' => [
                [
                    'label'=> "Maid's Room",
                    'name' => 'extras[maids_room]',
                    'value'=> false
                ],
                [
                    'label'=> "Storage/Room",
                    'name' => 'extras[storage_room]',
                    'value'=> false
                ],
                [
                    'label'=> "Sauna",
                    'name' => 'extras[sauna]',
                    'value'=> false
                ],
                [
                    'label'=> "Laundry Room",
                    'name' => 'extras[laudry_room]',
                    'value'=> false
                ],
                [
                    'label'=> "Cinema/TV",
                    'name' => 'extras[cinema_tv]',
                    'value'=> false
                ],
                [
                    'label'=> "Wine Cellar",
                    'name' => 'extras[wine_cellar]',
                    'value'=> false
                ],
                [
                    'label'=> "Bar",
                    'name' => 'extras[bar]',
                    'value'=> false
                ],
                [
                    'label'=> "Private Security",
                    'name' => 'extras[private_security]',
                    'value'=> false
                ],
                [
                    'label'=> "Security Room",
                    'name' => 'extras[security_room]',
                    'value'=> false
                ],
                [
                    'label'=> "Smoke Detectors",
                    'name' => 'extras[smoke_detectors]',
                    'value'=> false
                ],
                [
                    'label'=> "Security Shutters",
                    'name' => 'extras[security_shutters]',
                    'value'=> false
                ],
                [
                    'label'=> "Security Windows",
                    'name' => 'extras[security_windows]',
                    'value'=> false
                ],
                [
                    'label'=> "Double Glazed Windows",
                    'name' => 'extras[double_glazed_windows]',
                    'value'=> false
                ],
                [
                    'label'=> "Electric Blinds",
                    'name' => 'extras[electric_blinds]',
                    'value'=> false
                ],
                [
                    'label'=> "Manual Shutters",
                    'name' => 'extras[manual_shutters]',
                    'value'=> false
                ],
                [
                    'label'=> "Safe",
                    'name' => 'extras[safe]',
                    'value'=> false
                ],
                [
                    'label'=> "Alarm",
                    'name' => 'extras[alarm]',
                    'value'=> false
                ],
                [
                    'label'=> "CCTV",
                    'name' => 'extras[cctv]',
                    'value'=> false
                ],
                [
                    'label'=> "Concierge",
                    'name' => 'extras[concierge]',
                    'value'=> false
                ],
                [
                    'label'=> "Concierge Services",
                    'name' => 'extras[concierge_services]',
                    'value'=> false
                ],
                [
                    'label'=> "Playroom",
                    'name' => 'extras[playroom]',
                    'value'=> false
                ],
                [
                    'label'=> "Tennis/Basket court",
                    'name' => 'extras[tennis_basket_court]',
                    'value'=> false
                ],
                [
                    'label'=> "Gym/Fitness",
                    'name' => 'extras[gym_fitness]',
                    'value'=> false
                ],
                [
                    'label'=> "Jacuzzi",
                    'name' => 'extras[jacuzzi]',
                    'value'=> false
                ],
                [
                    'label'=> "BBQ",
                    'name' => 'extras[bbq]',
                    'value'=> false
                ],
                [
                    'label'=> "Fireplace",
                    'name' => 'extras[fireplace]',
                    'value'=> false
                ],
                [
                    'label'=> "Gas Fireplace",
                    'name' => 'extras[gas_fireplace]',
                    'value'=> false
                ],
                [
                    'label'=> "Annex",
                    'name' => 'extras[annex]',
                    'value'=> false
                ]
            ],
        ],
        [
            'id' => 6,
            'title' => 'Heating',
            'fields' => [
                [
                    'label'=> 'Central Diesel Heating',
                    'name'=> 'heating[central_diesel_heating]',
                    'value'=> false
                ],
                [
                    'label'=> 'Storage Heaters',
                    'name'=> 'heating[storage_heaters]',
                    'value'=> false
                ],
                [
                    'label'=> 'Central Gas Heating',
                    'name'=> 'heating[central_gas_heating]',
                    'value'=> false
                ],
                [
                    'label'=> 'Central Oil Heating',
                    'name'=> 'heating[central_oil_heaing]',
                    'value'=> false
                ],
                [
                    'label'=> 'Floor Heating',
                    'name'=> 'heating[floor_heating]',
                    'value'=> false
                ],
                [
                    'label'=> 'Solar Panels',
                    'name'=> 'heating[solar_panels]',
                    'value'=> false
                ],
                [
                    'label'=> 'Fireplace',
                    'name'=> 'heating[fireplace]',
                    'value'=> false
                ],
                [
                    'label'=> 'Radiators',
                    'name'=> 'heating[radiators]',
                    'value'=> false
                ],
                [
                    'label'=> 'Gas Fireplace',
                    'name'=> 'heating[gas_fireplace]',
                    'value'=> false
                ],
                [
                    'label'=> 'Hydronic (boiler)',
                    'name'=> 'heating[hydronic_boiler]',
                    'value'=> false
                ]
            ]
        ],
        [
            'id' => 7,
            'title' => 'Air Conditioning',
            'fields' => [
                [
                    'label'=> 'Pre-Installation',
                    'name'=> 'air_conditioning[pre_installation]',
                    'value'=> false
                ],
                [
                    'label'=> 'VRV Air Conditioning',
                    'name'=> 'air_conditioning[vrv_air_conditioning]',
                    'value'=> false
                ],
                [
                    'label'=> 'Room Unit Air Conditioning',
                    'name'=> 'air_conditioning[room_unit_air_conditioning]',
                    'value'=> false
                ],
                [
                    'label'=> 'Central Air Conditioning',
                    'name'=> 'air_conditioning[central_air_conditioning]',
                    'value'=> false
                ]
            ]
        ],
        [
            'id' => 8,
            'title' => 'Inclusions',
            'fields' => [
                [
                    'label'=> 'Ceramic Cook Top',
                    'name'=> 'inclusions[ceramic_cook_top]',
                    'value'=> false
                ],
                [
                    'label'=> 'Hob',
                    'name'=> 'inclusions[hob]',
                    'value'=> false
                ],
                [
                    'label'=> 'Structured Cabling',
                    'name'=> 'inclusions[structured_cabling]',
                    'value'=> false
                ],
                [
                    'label'=> 'Suspended Ceiling',
                    'name'=> 'inclusions[suspended_ceiling]',
                    'value'=> false
                ],
                [
                    'label' => 'Gas Cook Top',
                    'name' => 'inclusions[gas_cook_top]',
                    'value' => false
                ],
                [
                    'label' => 'Oven',
                    'name' => 'inclusions[oven]',
                    'value' => false
                ],
                [
                    'label'=> 'Microwave',
                    'name'=> 'inclusions[microwave]',
                    'value'=> false
                ],
                [
                    'label' => 'Extractor Fan',
                    'name' => 'inclusions[extractor_fan]',
                    'value' => false
                ],
                [
                    'label' => 'Dishwasher',
                    'name' => 'inclusions[dishwasher]',
                    'value' => false
                ],
                [
                    'label'=> 'Dryer',
                    'name'=> 'inclusions[dryer]',
                    'value'=> false
                ],
                [
                    'label' => 'Carpet',
                    'name' => 'inclusions[carpet]',
                    'value' => false
                ],
                [
                    'label' => 'Television',
                    'name' => 'inclusions[television]',
                    'value' => false
                ],
                [
                    'label'=> 'Water Filtration',
                    'name'=> 'inclusions[water_filtration]',
                    'value'=> false
                ],
                [
                    'label' => 'Satellite Dish',
                    'name' => 'inclusions[satellite_dish]',
                    'value' => false
                ],
                [
                    'label' => 'Water Softener',
                    'name' => 'inclusions[water_softener]',
                    'value' => false
                ]
            ]
        ],
        [
            'id' => 9,
            'title' => 'Furnished',
            'fields' => [
                [
                    'label'=> 'Unfurnished',
                    'name'=> 'furnished[unfurnished]',
                    'value'=> false
                ],
                [
                    'label'=> 'Partly Furnished',
                    'name'=> 'furnished[partly_furnished]',
                    'value'=> false
                ],
                [
                    'label'=> 'Furnished',
                    'name'=> 'furnished[furnished]',
                    'value'=> false
                ]
            ]
        ],

    ];

    public function toggle($id)
    {

        $this->openItem = $this->openItem === $id ? null : $id;
    }

    public function render()
    {
        return view('livewire.accordion-key-features');
    }
}
