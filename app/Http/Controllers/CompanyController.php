<?php

namespace App\Http\Controllers;
use App\Models\Company;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function importVolunteers(Request $request, Company $company)
{
    $request->validate([
        'csv_file' => 'required|mimes:csv,txt',
    ]);

    $file = fopen($request->file('csv_file')->getRealPath(), 'r');
    $header = fgetcsv($file); // leer encabezado

    while (($row = fgetcsv($file)) !== false) {
        $data = array_combine($header, $row);

        $validator = Validator::make($data, [
            'name' => 'required|string',
            'rut' => 'required|string|unique:volunteers,rut',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
        ]);

        if ($validator->fails()) continue;

        $company->volunteers()->create($data);
    }

    fclose($file);

    return back()->with('success', 'Voluntarios importados correctamente.');
}
public function showVolunteers(Request $request, Company $company)
{
    $query = $company->volunteers()->orderBy('name');

    if ($request->has('search') && $request->search !== '') {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('rut', 'like', "%{$search}%")
              ->orWhere('position', 'like', "%{$search}%");
        });
    }

    $volunteers = $query->get();

    return view('companies.volunteers', compact('company', 'volunteers'));
}

    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
{
 
    $query = Company::with('volunteers');

    if ($request->has('search') && $request->search !== '') {
        $search = $request->search;
        $query->where('name', 'like', "%{$search}%")
              ->orWhere('code', 'like', "%{$search}%");
    }

    $companies = $query->get(); // O usa paginate() si quieres

    return view('companies.index', compact('companies'));


}

    /**
     * Show the form for creating a new resource.
     */
   public function create()
{
    return view('companies.create');
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'code' => 'required|string|max:50|unique:companies,code',
    ]);

   try {
    Company::create($request->only('name', 'code'));
} catch (Exception $e) {
    dd($e->getMessage(), $e->getTraceAsString());
}

    return redirect()->route('companies.index')->with('success', 'Compañía registrada con éxito.');
}



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
   public function edit(Company $company)
{
    return view('companies.edit', compact('company'));
}

public function update(Request $request, Company $company)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'code' => 'required|string|max:50|unique:companies,code,' . $company->id,
    ]);

    $company->update($request->only('name', 'code'));

    return redirect()->route('companies.index')->with('success', 'Compañía actualizada correctamente.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Compañía eliminada correctamente.');
    }
}
