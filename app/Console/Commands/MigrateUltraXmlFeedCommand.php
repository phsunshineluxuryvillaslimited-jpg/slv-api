<?php
 /**
 * This command migrates property data from the Ultra XML feed to the new database structure. 
 * It fetches the XML data, parses it, and then inserts the relevant information into the properties, 
 * addresses, amenities, prices, photos, and networks tables. 
 * 
 * The command also logs the progress and any errors en1ered during the migration process.
 * 
 * Date: 2026-04-15
 * Author: Glenn Quinto
 * 
 * Version 1.0 - Initial migration command created.
 * Version 1.1 - Added error handling for XML parsing and HTTP requests.
 * Version 1.2 - Updated property type mapping and added support for additional fields.
 * Version 1.3 - Refactored code for better readability and maintainability.
 * Version 1.4 - Added logging for migration progress and errors.
 * Version 1.5 - Finalized migration logic and tested with sample XML data.
 * Version 1.6 - Cleaned up code and removed unnecessary comments.
 * Version 1.7 - Updated to handle new XML feed structure and additional property attributes.
 * Version 1.8 - Added support for handling large XML files and optimized database inserts.
 * Version 1.9 - Final testing and validation of migration process.
 * Version 2.0 - Ready for production deployment.
 */
namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use App\Models\Property;
use App\Models\PropertyType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Ramsey\Uuid\Type\Decimal;

#[Signature('app:migrate-ultra-xml-feed')]
#[Description('Copy data from Ultra XML feed to new database')]

class MigrateUltraXmlFeedCommand extends Command
{
    private $uploadWithinURL = false;

    private $ultraaXMLfeedUrl = 'https://feed.ultrait.me/kyero/?Guid=c7889ade-16ba-4f7c-ac97-e407085d715f';

    private $ultraXMLFeedFileName = 'ultra-feed.xml';

    /**4
     * Execute the console command.
     */
    public function handle()
    {
        /**
        * Condition to determine whether to fetch the XML feed from a URL or read from a local file.
        */
        if ($this->uploadWithinURL) {
            $response = Http::get($this->ultraaXMLfeedUrl);
     
            if ($response->failed()) {
                Log::error('Failed to fetch data from the XML feed. Status: ' . $response->status());
                return 1; 
            }

            $xmlData = simplexml_load_string($response->body());
        
            if ($xmlData === false) {
                Log::error('Failed to parse XML data from the feed.');
                return 1; 
            }
        /**
         * If not fetching from URL, attempt to load the XML data from a local file.
         */
        } else {
             $xmlData = simplexml_load_file( public_path() . '/files/' . $this->ultraXMLFeedFileName);

                if ($xmlData === false) {
                    Log::error('Failed to load XML file: ' . $this->ultraXMLFeedFileName);
                    return 1;
                }
        }

        $propertyTypes = PropertyType::pluck('id', 'name')->toArray();
        $totalProperties = count($xmlData->property);
        $propertiesData = [];
        $propertiesAddressData = [];
        $propertiesAmenitiesData = [];
        $propertiesPricesData = [];
        $ctr = 0;

        /**
         * Log the total number of records to migrate and start the migration process.
         */
        $this->line('Total Records to migrate: ' . $totalProperties);
        Log::info('Starting migration of Ultra XML feed. Total Records to migrate: ' . $totalProperties);

        /**
         * Iterate through each property in the XML feed, map the data to the corresponding database fields,
         * and insert the data into the properties, addresses, amenities, prices, photos, and networks tables.
         */
        foreach ($xmlData->property as $property) {
            
            if (strtolower($property->type) == 'town house') {
                $property->type = 'Townhouse';
            }

            if (strtolower($property->type) == 'commerial property') {
                $property->type = 'Commercial Property';
            }
            
            $propertyTypeId = $propertyTypes[current($property->type)] ?? null;

            $propertyType = (string) $property->price_freq;

            if (!in_array($propertyType, ['resale', 'new', 'sale', 'rental'])) {
                $propertyType = null;
            }

            $propertiesData = [
                'author_id'     => 1,
                'property_type_id' => (int) $propertyTypeId,
                'reference'     => (string) $property->ref,
                'description'   => (string) $property->desc->en,
                'leasehold'     => ((int) $property->leasehold === 1) ? 'yes' : 'no',
                'bedrooms'      => ($property->beds != null) ? (int) $property->beds : 0,
                'bathrooms'     => ($property->baths != null) ? (int) $property->baths : 0,
                'area_size'     => ($property->surface_area->build != null) ? (float) $property->surface_area->build : 0,
                'plot'          => ($property->surface_area->plot != null) ? (float) $property->surface_area->plot : 0,
                'pool'          => ($property->pool != null) ? 'yes' : 'no',
                'listing_type'  =>  $propertyType,
                'agent_id'      => 1,
                'status'        => 'published',
                'save_type'     => 'feed'
            ];

            $propertiesDataXMLFeed = [
                'external_feed_id' => (int) $property->id,
                'xml_feed_source'  => 'Ultra XML',
                'property_url'     => (string) $property->url,
                'property_type'    => (string) $property->type,
                'property_date'    => date('Y-m-d H:i:s', strtotime((string) $property->date)),
                'price_freq'       => (string) $property->price_freq,
                'part_owner'       => ($property->part_ownership != null) ? (int) $property->part_ownership : 0,
                'imported_at'      => now()
            ];
            
            $propertiesAddressData = [
                'region'        => (string) $property->province,
                'town_city'     => (string) $property->town,
                'locality'      => null,
                'latitude'      => (filter_var($property->location->latitude, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)) ? (float) filter_var($property->location->latitude, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : null,
                'longitude'     => (filter_var($property->location->longitude, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)) ? (float) filter_var($property->location->longitude, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) : null,
                'accuracy'      => 0,
                'map_address'   => null,
                'map_accuracy'  => 0
            ];
            
            $propertiesPricesData = [
                'basic_price' => (current($property->price) != null) ? (float) current($property->price) : 0,
            ];

            $photosData = [];
            if (!empty($property->images)) {
                $sort = 0;
                foreach ($property->images->image as $image) {
                    $photosData[] = [
                        'url' => (string) $image->url,
                        'type' => 'gallery',
                        'caption' => null,
                        'sort_order' => ++$sort
                    ];
                }
            }
     
            $network = [
                [
                    'external_feeds' => 'slv'
                ]
            ];
            
            /**
             * Saving section for the property and its related data to the database.
             * @var mixed
             */
            $property = Property::create($propertiesData);
            $property->externalFeeds()->create($propertiesDataXMLFeed);
            $property->address()->create($propertiesAddressData);
            $property->amenities()->create($propertiesAmenitiesData);
            $property->price()->create($propertiesPricesData);
            $property->photos()->createMany($photosData);
            $property->networks()->createMany($network);

            ++$ctr;
        }

        echo 'Total inserted records: '.$ctr;

        return 0; 
    }
}
