@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Registrar nueva unidad</h1>

    <form action="{{ route('units.store') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label class="block mb-1 font-medium text-gray-700">Código</label>
            <input type="text" name="code" required
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">
        </div>

        <div>
            <label class="block mb-1 font-medium text-gray-700">Tipo</label>
            <input type="text" name="type" required
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">
        </div>

        <div>
            <label class="block mb-1 font-medium text-gray-700">¿Disponible?</label>
            <select name="availability"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">
                <option value="1">Sí</option>
                <option value="0">No</option>
            </select>
        </div>

        <div class="pt-4">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded font-semibold">
                🚒 Guardar unidad
            </button>
        </div>
    </form>
</div>
@endsection
