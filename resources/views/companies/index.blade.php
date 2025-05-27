@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Compañías de Bomberos</h1>

    <div class="flex justify-between items-center mb-4">
        <a href="{{ route('companies.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
            ➕ Nueva compañía
        </a>
        <form method="GET" action="{{ route('companies.index') }}" class="flex">
            <input type="text" name="search" placeholder="Buscar compañía..."
                value="{{ request('search') }}"
                class="border rounded-l px-3 py-2 focus:outline-none focus:ring w-64">
            <button type="submit"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-r">
                🔍
            </button>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300 rounded text-sm">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-3 border-b">Nombre</th>
                    <th class="px-4 py-3 border-b">Código</th>
                    <th class="px-4 py-3 border-b text-center">Voluntarios</th>
                    <th class="px-4 py-3 border-b text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-gray-800">
                @foreach($companies as $company)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border-b">{{ $company->name }}</td>
                        <td class="px-4 py-2 border-b">{{ $company->code }}</td>
                        <td class="px-4 py-2 border-b text-center">{{ $company->volunteers->count() }}</td>
                        <td class="px-4 py-2 border-b text-center space-x-2">
                            <a href="{{ route('companies.volunteers', $company) }}"
                               class="text-blue-600 hover:underline">
                                📋 Ver
                            </a>
                        <a href="{{ route('companies.edit', $company) }}" class="text-yellow-600 hover:underline">
                            ✏️ Editar
                        </a>
                            <form action="{{ route('companies.destroy', $company) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">
                                    🗑️ Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
