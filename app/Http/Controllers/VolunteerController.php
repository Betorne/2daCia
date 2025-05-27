<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Volunteer;
use Illuminate\Http\Request;

class VolunteerController extends Controller
{
    public function create(Request $request)
    {
        $company = Company::findOrFail($request->company);
        return view('volunteers.create', compact('company'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'name' => 'required|string|max:255',
            'rut' => 'required|string|unique:volunteers,rut',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'position' => 'nullable|string|max:100',
            'photo' => 'nullable|image|max:2048',
        ]);

        $data = $request->only('company_id', 'name', 'rut', 'email', 'phone', 'position');

      if ($request->hasFile('photo')) {
    $data['photo'] = $request->file('photo')->store('volunteers', 'public');
}

        Volunteer::create($data);

        return redirect()->route('companies.volunteers', $request->company_id)->with('success', 'Voluntario registrado con éxito.');
    }
    public function edit(Volunteer $volunteer)
{
    $company = $volunteer->company;
    return view('volunteers.edit', compact('volunteer', 'company'));
}

public function update(Request $request, Volunteer $volunteer)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'rut' => 'required|string|unique:volunteers,rut,' . $volunteer->id,
        'email' => 'nullable|email',
        'phone' => 'nullable|string|max:20',
        'position' => 'nullable|string|max:100',
        'photo' => 'nullable|image|max:2048',
    ]);

    $data = $request->only('name', 'rut', 'email', 'phone', 'position');

    if ($request->hasFile('photo')) {
        $data['photo'] = $request->file('photo')->store('volunteers', 'public');
    }

    $volunteer->update($data);

    return redirect()->route('companies.volunteers', $volunteer->company_id)->with('success', 'Voluntario actualizado.');
}

public function destroy(Volunteer $volunteer)
{
    $companyId = $volunteer->company_id;
    $volunteer->delete();

    return redirect()->route('companies.volunteers', $companyId)->with('success', 'Voluntario eliminado.');
}
}
