@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Voluntarios – {{ $company->name }}</h1>

    {{-- Mensajes de sesión --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <a href="{{ route('companies.index') }}" class="text-blue-600 hover:underline mb-4 inline-block">← Volver a compañías</a>

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <a href="{{ route('volunteers.create', ['company' => $company->id]) }}"
           class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded">
            ➕ Agregar voluntario
        </a>
        <form method="GET" action="{{ route('companies.volunteers', $company) }}" class="flex flex-col sm:flex-row gap-2 sm:items-center">
            <div class="flex flex-col sm:flex-row gap-2 sm:items-center">
                <input type="text" name="search" placeholder="Buscar voluntario por nombre, RUT o cargo"
                    value="{{ request('search') }}"
                    class="border border-gray-300 rounded px-3 py-2 w-full sm:w-80 focus:outline-none focus:ring">
                <button type="submit" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded text-sm">
                    🔍 Buscar
                </button>
                @if(request('search'))
                    <a href="{{ route('companies.volunteers', $company) }}" class="text-sm text-blue-600 hover:underline">
                        Limpiar búsqueda
                    </a>
                @endif
            </div>
        </form>


        <form action="{{ route('companies.volunteers.import', $company) }}" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row gap-2 sm:items-center">
            @csrf
            <input type="file" name="csv_file" required accept=".csv"
                   class="block border border-gray-300 rounded px-3 py-1 text-sm w-64">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white py-1.5 px-4 rounded text-sm">
                📁 Importar CSV
            </button>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300 text-sm rounded">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-2 border-b">Foto</th>
                    <th class="px-4 py-2 border-b">Nombre</th>
                    <th class="px-4 py-2 border-b">RUT</th>
                    <th class="px-4 py-2 border-b">Correo</th>
                    <th class="px-4 py-2 border-b">Teléfono</th>
                    <th class="px-4 py-2 border-b">Cargo</th>
                    <th class="px-4 py-2 border-b">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($volunteers as $v)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border-b text-center">
                            @if($v->photo)
                                <img src="{{ asset('storage/' . $v->photo) }}" alt="Foto de {{ $v->name }}" class="w-14 h-14 object-cover rounded-full mx-auto">
                            @else
                                <span class="text-gray-500 italic">Sin foto</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 border-b">{{ $v->name }}</td>
                        <td class="px-4 py-2 border-b">{{ $v->rut }}</td>
                        <td class="px-4 py-2 border-b">{{ $v->email }}</td>
                        <td class="px-4 py-2 border-b">{{ $v->phone }}</td>
                        <td class="px-4 py-2 border-b">{{ $v->position }}</td>
                        <td class="px-4 py-2 border-b text-center">
                            <a href="{{ route('volunteers.edit', $v) }}" class="text-blue-600 hover:underline">✏️ Editar</a>

                            <form action="{{ route('volunteers.destroy', $v) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('¿Estás seguro que deseas eliminar este voluntario?')"
                                        class="text-red-600 hover:underline ml-2">
                                    🗑️ Borrar
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
