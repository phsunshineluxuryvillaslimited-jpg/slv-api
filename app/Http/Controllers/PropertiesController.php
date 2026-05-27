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
        $properties = Property::paginate(10);
        return view("properties.index", compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page = 1;
        return view("properties.create" , compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return view("step", ['sample' =>'test']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $property = Property::findOrFail($id);
        return view("properties.show", compact('property'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view("properties.edit");
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
