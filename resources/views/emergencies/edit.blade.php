@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Editar emergencia</h1>

    <form action="{{ route('emergencies.update', $emergency) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1 font-medium text-gray-700">Tipo</label>
            <input type="text" name="type" value="{{ $emergency->type }}" required
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">
        </div>

        <div>
            <label class="block mb-1 font-medium text-gray-700">Dirección</label>
            <input type="text" name="address" value="{{ $emergency->address }}" required
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">
        </div>

        <div>
            <label class="block mb-1 font-medium text-gray-700">Descripción</label>
            <textarea name="description" rows="4"
                      class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">{{ $emergency->description }}</textarea>
        </div>

        <div>
            <label class="block mb-1 font-medium text-gray-700">Prioridad</label>
            <select name="priority" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">
                <option value="alta" {{ $emergency->priority == 'alta' ? 'selected' : '' }}>Alta</option>
                <option value="media" {{ $emergency->priority == 'media' ? 'selected' : '' }}>Media</option>
                <option value="baja" {{ $emergency->priority == 'baja' ? 'selected' : '' }}>Baja</option>
            </select>
        </div>

        <div>
            <label class="block mb-1 font-medium text-gray-700">Estado</label>
            <select name="status" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">
                <option value="pendiente" {{ $emergency->status == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="en_camino" {{ $emergency->status == 'en_camino' ? 'selected' : '' }}>En camino</option>
                <option value="finalizada" {{ $emergency->status == 'finalizada' ? 'selected' : '' }}>Finalizada</option>
            </select>
        </div>

        <div class="pt-4">
            <button type="submit"
                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded font-semibold">
                💾 Actualizar emergencia
            </button>
        </div>
    </form>
</div>
@endsection
