<?php

namespace App\Http\Controllers;
use App\Models\Dispatch;
use App\Models\Emergency;
use App\Models\Unit;
use Illuminate\Http\Request;

class DispatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  
public function index()
{
    $dispatches = Dispatch::with('emergency', 'unit')->get();
    return view('dispatches.index', compact('dispatches'));
}

public function create()
{
    $emergencies = Emergency::all();
    $units = Unit::where('availability', true)->get();
    return view('dispatches.create', compact('emergencies', 'units'));
}

public function store(Request $request)
{
   $request->validate([
        'emergency_id' => 'required|exists:emergencies,id',
        'unit_ids' => 'required|array|min:1',
        'unit_ids.*' => 'exists:units,id',
    ]);

    foreach ($request->unit_ids as $unitId) {
        Dispatch::create([
            'emergency_id' => $request->emergency_id,
            'unit_id' => $unitId,
            'dispatched_at' => now(),
        ]);

        // Marcar unidad como no disponible
        Unit::where('id', $unitId)->update(['availability' => false]);
    }

    return redirect()->route('dispatches.index')->with('success', 'Unidades despachadas con éxito');
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
