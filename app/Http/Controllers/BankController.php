<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;
use App\Http\Resources\BankResource;
use App\Http\Requests\StoreBankRequest;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banks = Bank::paginate(10);
        
        return view('banks.index', compact('banks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('banks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBankRequest $request)
    {
        $data = $request->validated();

        Bank::create($data);

        return redirect()->route('bank.index')
            ->with('success', 'The bank has been successfully saved!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bank $bank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bank $bank)
    {
        return view('banks.edit',  compact('bank'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreBankRequest $request, Bank $bank)
    {
        $data = $request->all();
        
        $bank->update($data);

        return redirect()->route('bank.index')
                    ->with('success', 'The bank has been successfully saved!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bank $bank)
    {
        //
    }
}
