<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDeveloperRequest;
use App\Http\Resources\DeveloperResource;
use App\Models\Developer;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $developers = Developer::paginate(10);
        
        return view('developers.index', compact('developers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
     
        return view('developers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDeveloperRequest $request)
    {
        $data = $request->validated();

        Developer::create($data);

        return redirect()->route('developer.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Developer $developer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Developer $developer)
    {
        view('developer.edit', compact('developer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Developer $developer)
    {
        $data = $request->all();
        
        $developer->update($data);

        return redirect()->route('developer.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Developer $developer)
    {
        //
    }
}
