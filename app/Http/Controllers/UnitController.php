<?php

namespace App\Http\Controllers;
use App\Models\Unit;

use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index()
{
    $units = Unit::all();
    return view('units.index', compact('units'));
}

public function create()
{
    return view('units.create');
}

public function store(Request $request)
{
    Unit::create($request->validate([
        'code' => 'required|unique:units',
        'type' => 'required',
        'availability' => 'required|boolean',
    ]));

    return redirect()->route('units.index');
}
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
