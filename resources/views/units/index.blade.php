@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Unidades</h1>

    <div class="mb-4">
        <a href="{{ route('units.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
            ➕ Nueva unidad
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm border border-gray-300 rounded">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-2 border-b text-left">Código</th>
                    <th class="px-4 py-2 border-b text-left">Tipo</th>
                    <th class="px-4 py-2 border-b text-left">Disponible</th>
                    <th class="px-4 py-2 border-b text-left">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-gray-800">
                @foreach ($units as $unit)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border-b">{{ $unit->code }}</td>
                        <td class="px-4 py-2 border-b">{{ $unit->type }}</td>
                        <td class="px-4 py-2 border-b">
                            <span class="inline-block px-2 py-1 rounded text-xs font-medium
                                {{ $unit->availability ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $unit->availability ? 'Sí' : 'No' }}
                            </span>
                        </td>
                        <td class="px-4 py-2 border-b">
                            <a href="{{ route('units.edit', $unit) }}"
                               class="text-blue-600 hover:underline">
                                ✏️ Editar
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
