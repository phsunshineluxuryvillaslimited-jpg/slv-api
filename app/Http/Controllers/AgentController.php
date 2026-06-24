<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Http\Resources\AgentResource;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agent = Agent::paginate(10);
        
        return view('agents.index', compact('agent'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('agents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validated();

        Agent::create($data);

        return redirect()->route('agent.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Agent $agent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agent $agent)
    {
        return view('agents.edit', compact('agent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agent $agent)
    {
        $data = $request->all();
        
        $agent->update($data);

        return redirect()->route('agent.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agent $agent)
    {
        //
    }
}
