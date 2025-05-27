@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-xl font-bold mb-6 text-gray-800">Editar Compañía</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <strong>Errores:</strong>
            <ul class="list-disc list-inside mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('companies.update', $company) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium">Nombre:</label>
            <input type="text" name="name" class="w-full border rounded px-3 py-2"
                   value="{{ old('name', $company->name) }}" required>
        </div>

        <div>
            <label class="block font-medium">Código:</label>
            <input type="text" name="code" class="w-full border rounded px-3 py-2"
                   value="{{ old('code', $company->code) }}" required>
        </div>

        <div class="flex gap-4 mt-6">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Guardar cambios
            </button>
            <a href="{{ route('companies.index') }}" class="text-blue-600 hover:underline mt-2">← Cancelar</a>
        </div>
    </form>
</div>
@endsection
