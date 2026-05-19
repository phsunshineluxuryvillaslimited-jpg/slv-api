<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\PropertyAddress;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

#[Signature('app:migrate-property-data')]
#[Description('Copy old data properties to new database')]
class MigratePropertyDataCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $oldProperties = DB::table('properties_old')->get();
        $propertyTypes = PropertyType::pluck('id', 'name')->toArray();
        $propertiesData = [];
        $propertiesAddressData = [];
        $propertiesAmenitiesData = [];
        $propertiesPricesData = [];
        $ctr = 0;

         $this->line('Total Records to migrate: '.count($oldProperties));

        foreach ($oldProperties as $oldProperty) {

            if (strtolower($oldProperty->property_type) == 'town house') {
                $oldProperty->property_type = 'Townhouse';
            }

            if (strtolower($oldProperty->property_type) == 'commerial property') {
                $oldProperty->property_type = 'Commercial Property';
            }
            
            $propertyTypeId = $propertyTypes[$oldProperty->property_type];

            $propertiesData = [
                'author_id' => 1,
                'property_type_id' => $propertyTypeId,
                'reference'     => $oldProperty->reference,
                'description'   => $oldProperty->property_description,
                'title_deeds'   => null,
                'leasehold'     => ($oldProperty->leasehold != null) ? strtolower($oldProperty->leasehold) : 'no',
                'bedrooms'      => ($oldProperty->bedrooms != null) ? $oldProperty->bedrooms : 0,
                'bathrooms'     => ($oldProperty->bathrooms != null) ? $oldProperty->bathrooms : 0,
                'build'         => ($oldProperty->build != null) ? $oldProperty->build : 0,
                'terrace'       => ($oldProperty->terrace_m2 != null) ? floatval($oldProperty->terrace_m2) : 0,
                'plot'          => ($oldProperty->plot_m2 != null) ? floatval($oldProperty->plot_m2) : 0,
                'plot_description' => $oldProperty->plot_description,
                'agent_id'      => 1,
                'year_of_construction' => $oldProperty->yearConstruction,
                'pool'          => ($oldProperty->pool != null) ? floatval($oldProperty->plot_m2) : 0,
                'pool_description' => $oldProperty->pool_description,
                'listing_type'  => $oldProperty->listing_type,
                'plan_zone'     => $oldProperty->plan_zone,
                'sea_view'      => ($oldProperty->sea_view != null) ? strtolower($oldProperty->sea_view) : 'no',
                'for_sale_board' => ($oldProperty->for_sale_board != null) ? strtolower($oldProperty->for_sale_board) : 'no',
                'status'        => $oldProperty->property_status,
                'save_type'     => 'finished'
            ];
            $property = Property::create($propertiesData);

            $propertiesAddressData = [
                'property_id'   => $property->id,
                'region'        => $oldProperty->region,
                'town_city'     => $oldProperty->town,
                'locality'      => null,
                'latitude'      => $oldProperty->latitude,
                'longitude'     => $oldProperty->longitude,
                'accuracy'      => 0,
                'map_address'   => $oldProperty->address,
                'map_accuracy'  => 0
            ];

            $property->address()->insert($propertiesAddressData);

            $propertiesAmenitiesData[] = [
                'property_id'   => $property->id,
                'amenities'     => ($oldProperty->amenities_km != null) ? $oldProperty->amenities_km : 0,
                'airport'       => ($oldProperty->airport_km != null) ? $oldProperty->airport_km : 0,
                'sea'           => ($oldProperty->sea_km != null) ? $oldProperty->sea_km : 0,
                'public_transport' => ($oldProperty->public_transport_km != null) ? $oldProperty->public_transport_km : 0,
                'schools'       => ($oldProperty->schools_km != null) ? $oldProperty->schools_km : 0,
                'resorts'       => ($oldProperty->resort_km != null) ? $oldProperty->resort_km : 0,
                'covered'       => ($oldProperty->covered != null) ? $oldProperty->covered : 0,
                'attic'         => ($oldProperty->attic_m2 != null) ? $oldProperty->attic_m2 : 0,
                'roof_garden'   => ($oldProperty->roofgarden_m2 != null) ? $oldProperty->roofgarden_m2 : 0,
                'covered_veranda'=> ($oldProperty->covered_veranda_m2 != null) ? $oldProperty->covered_veranda_m2 : 0,
                'uncovered_veranda'=> ($oldProperty->uncovered_veranda_m2 != null) ? $oldProperty->uncovered_veranda_m2 : 0,
                'covered_parking'=> ($oldProperty->covered_parking_m2 != null) ? $oldProperty->covered_parking_m2 : 0,
                'basement'      => ($oldProperty->basement_m2 != null) ? $oldProperty->basement_m2 : 0,
                'countyard'     => ($oldProperty->courtyard_m2 != null) ? $oldProperty->courtyard_m2 : 0,
                'garden'        => ($oldProperty->garden_m2 != null) ? $oldProperty->garden_m2 : 0
            ];

            $property->amenities()->insert($propertiesAmenitiesData);

            $propertiesPricesData[] = [
                'property_id'   => $property->id,
                'is_poa'=> $oldProperty->is_poa,
                'basic_price'=> ($oldProperty->price != null) ? $oldProperty->price :0,
                'original_price'=> ($oldProperty->price_original != null) ? $oldProperty->price_original : 0,
                'total_reduction_percentage'=> ($oldProperty->reduction_percent != null) ? $oldProperty->reduction_percent : 0,
                'total_reduction_price'=> ($oldProperty->reducedPrice) ? $oldProperty->reducedPrice : 0,
                'commission'=> ($oldProperty->commission != null) ? $oldProperty->commission : 0,
                'communal_charges'=> ($oldProperty->communalCharge) ? $oldProperty->communalCharge : 0,
            ];

            $property->price()->insert($propertiesPricesData);

            $photos = ($oldProperty->photos != null) ? json_decode($oldProperty->photos) : [];

            if (!empty($photos)) {
                $photosData = [];
                foreach ($photos as $key => $photo) {
                    $photosData[] = [
                        'property_id' => $property->id,
                        'url' => $photo,
                        'type' => 'gallery',
                        'caption' => null,
                        'sort_order' => $key + 1
                    ];
                }

                // insert photos if a relationship exists, e.g. $property->photos()->insert($photosData);
                $property->photos()->insert($photosData);
                
            }

            $network = [
                'property_id' => $property->id,
                'external_feeds' => 'slv' 
            ];

            $property->networks()->insert($network);

            ++$ctr;
        }

        echo 'Total inserted records: '.$ctr;

        return 0; 
    }
}
