<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeocodingServices
{
    protected ?string $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.google_maps.key');
    }

    /**
     * Turn a free-text address into ['lat' => ..., 'lng' => ..., 'formatted_address' => ...].
     * Returns null if the address can't be resolved or the API call fails.
     */
    public function geocode(string $address): ?array
    {
        if (blank($address) || blank($this->apiKey)) {
            return null;
        }

        $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
            'address' => $address,
            'key' => $this->apiKey,
        ]);

        if (! $response->ok()) {
            Log::warning('Geocoding HTTP request failed', ['status' => $response->status()]);

            return null;
        }

        $data = $response->json();

        if (($data['status'] ?? null) !== 'OK' || empty($data['results'][0])) {
            Log::info('Geocoding returned no usable result', ['status' => $data['status'] ?? 'unknown', 'address' => $address]);

            return null;
        }

        $result = $data['results'][0];
        $location = $result['geometry']['location'];

        return [
            'lat' => $location['lat'],
            'lng' => $location['lng'],
            'formatted_address' => $result['formatted_address'],
        ];
    }
}