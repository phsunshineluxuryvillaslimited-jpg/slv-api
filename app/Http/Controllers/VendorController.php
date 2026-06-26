<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Http\Resources\VendorResource;
use App\Http\Requests\StoreVendorRequest;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendors = Vendor::paginate(10);
        
        return view('vendors.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vendors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVendorRequest $request)
    {
        $data = $request->validated();

        Vendor::create($data);

        return redirect()->route('vendor.index')
                    ->with('success', 'The vendor has been successfully saved!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vendor $vendor)
    {
         return view('vendors.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vendor $vendor)
    {
        $data = $request->all();
        
        $vendor->update($data);

        return redirect()->route('vendor.index')
                    ->with('success', 'The vendor has been successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendor $vendor)
    {
        //
    }
}
