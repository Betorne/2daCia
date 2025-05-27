<?php

namespace App\Http\Controllers;
use App\Models\Emergency;
use App\Models\EmergencyType;

use Illuminate\Http\Request;

class EmergencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $emergencies = Emergency::latest()->get();
    return view('emergencies.index', compact('emergencies'));
}

public function create()
{
     $emergencyTypes = EmergencyType::all();
    return view('emergencies.create', compact('emergencyTypes'));
}

public function store(Request $request)
{
    $validated = $request->validate([
        'emergency_type_id' => 'required|exists:emergency_types,id',
        'address' => 'required|string|max:255',
        'description' => 'nullable|string',
        'priority' => 'required|in:alta,media,baja',
    ]);

    Emergency::create([
        'emergency_type_id' => $validated['emergency_type_id'],
        'type' => EmergencyType::find($validated['emergency_type_id'])->description, // este campo
        'address' => $validated['address'],
        'description' => $validated['description'] ?? null,
        'priority' => $validated['priority'],
        'status' => 'pendiente',
    ]);

    return redirect()->route('emergencies.index')->with('success', 'Emergencia creada con éxito.');
}


    /**
     * Display the specified resource.
     */
 public function show(Emergency $emergency)
{
    
    return view('emergencies.show', compact('emergency'));
}

    /**
     * Show the form for editing the specified resource.
     */
   public function edit(Emergency $emergency)
{
    return view('emergencies.edit', compact('emergency'));
}

public function update(Request $request, Emergency $emergency)
{
    $data = $request->validate([
        'type' => 'required|string',
        'address' => 'required|string',
        'description' => 'nullable|string',
        'priority' => 'required|in:alta,media,baja',
        'status' => 'required|in:pendiente,en_camino,finalizada',
    ]);

    $emergency->update($data);
 // ✅ Si la emergencia se marca como finalizada, liberar unidades
    if ($data['status'] === 'finalizada') {
        foreach ($emergency->dispatches as $dispatch) {
            $dispatch->unit->update(['availability' => true]);
        }
    }
    return redirect()->route('emergencies.index')->with('success', 'Emergencia actualizada');
}

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Emergency $emergency)
{
    // 🔐 Opcional: también podrías eliminar despachos asociados
    $emergency->dispatches()->delete();

    $emergency->delete();

    return redirect()->route('emergencies.index')->with('success', 'Emergencia eliminada correctamente.');
}
    public function finalize(Emergency $emergency)
{
    $emergency->update(['status' => 'finalizada']);

    // Liberar unidades asociadas si aplica
    foreach ($emergency->dispatches as $dispatch) {
        $dispatch->unit->update(['availability' => true]);
    }

    return redirect()->route('emergencies.index')->with('success', 'Emergencia finalizada.');
}
}
