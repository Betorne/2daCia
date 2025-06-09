@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Registrar emergencia</h1>

    <form action="{{ route('emergency-types.seed') }}" method="POST" class="mb-4">
        @csrf
        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">
            Crear tipos de emergencia
        </button>
    </form>

    <form action="{{ route('emergencies.store') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label class="block mb-1 font-medium text-gray-700">Tipo de emergencia</label>
            <select name="emergency_type_id" class="w-full border rounded px-3 py-2 focus:ring focus:outline-none">
                @foreach ($emergencyTypes as $type)
                    <option value="{{ $type->id }}">{{ $type->code }} – {{ $type->description }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1 font-medium text-gray-700">Dirección</label>
            <input type="text" name="address" required
                   class="w-full border rounded px-3 py-2 focus:ring focus:outline-none">
        </div>

        <div>
            <label class="block mb-1 font-medium text-gray-700">Descripción</label>
            <textarea name="description" rows="4"
                      class="w-full border rounded px-3 py-2 focus:ring focus:outline-none"></textarea>
        </div>

        <div>
            <label class="block mb-1 font-medium text-gray-700">Prioridad</label>
            <select name="priority" class="w-full border rounded px-3 py-2 focus:ring focus:outline-none">
                <option value="alta">Alta</option>
                <option value="media" selected>Media</option>
                <option value="baja">Baja</option>
            </select>
        </div>

        <div class="pt-4">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded font-semibold">
                🚨 Guardar emergencia
            </button>
        </div>
    </form>
</div>
@endsection
