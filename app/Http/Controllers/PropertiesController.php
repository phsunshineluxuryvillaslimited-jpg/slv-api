<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;

class PropertiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $properties = Property::with([
            'propertyType',
            'address' => function($query) {
                $query->select('id', 'property_id', 'region', 'town_city');
            },
            'price' => function($query) {
                $query->select('id', 'property_id', 'basic_price');
            },
            'photos' => function($query) {
                $query->select('id', 'property_id', 'url');
            },
            'amenities' => function($query) {
                $query->select('id', 'property_id');
            },
            'networks'
        ])
        ->select('id', 'property_type_id', 'reference', 'bedrooms', 'plot', 'area_size', 'status')
        ->paginate(10);

        return view("properties.index", compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("properties.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     return view("step", ['sample' =>'test']);
    // }

    /**
     * Display the specified resource.
     */
    public function show(Property $property, Request $id)
    {
        return view("properties.show", compact('property'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        $editMode = 'editMode';
        return view("properties.edit", compact('property', $editMode));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
