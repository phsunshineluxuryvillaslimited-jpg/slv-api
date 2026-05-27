<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\PropertyTypeResource;
use Illuminate\Http\Request;
use App\Models\PropertyType;
class PropertyTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PropertyTypeResource::collection(PropertyType::all()->sortBy('name'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $propertyType = PropertyType::create($data);

        return $propertyType;
    }

    /**
     * Display the specified resource.
     */
    public function show(PropertyType $property_type)
    {
        return PropertyTypeResource::make($property_type);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PropertyType $property_type)
    {
        $data = $request->all();
        $property_type->update($data);

        return new PropertyTypeResource($property_type);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PropertyType $property_type)
    {
        $property_type->delete();

        return response()->noContent();
    }
}
