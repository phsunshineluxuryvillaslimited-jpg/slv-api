<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PropertiesXmlController extends Controller
{
    public function feed()
    {

        $data = Property::with('created_by')
            ->with('property_type')
            ->with('address')
            ->get();

        return response()
            ->view('property-xml.feed', ['properties' => $data])
            ->header('Content-Type', 'text/xml');
    }

    /**
     * Summary of downloadXml
     *
     * @return BinaryFileResponse
     */
    private function downloadXml(Property $property)
    {
        $pathToFile = storage_path('app/public/exports/properties.xml');

        return response()->download($pathToFile, 'properties.xml', [
            'Content-Type' => 'application/xml',
        ]);
    }
}
