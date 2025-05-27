@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Nuevo despacho</h1>

    <form action="{{ route('dispatches.store') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label class="block mb-1 font-medium text-gray-700">Emergencia</label>
            <select name="emergency_id" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">
                @foreach ($emergencies as $e)
                    <option value="{{ $e->id }}">{{ $e->type }} – {{ $e->address }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1 font-medium text-gray-700">Selecciona unidades para despachar</label>
            <div class="flex flex-wrap gap-3">
                @foreach ($units as $u)
                    <label class="flex items-center border rounded px-3 py-2 cursor-pointer hover:bg-blue-50">
                        <input type="checkbox" name="unit_ids[]" value="{{ $u->id }}" class="mr-2">
                        {{ $u->code }} ({{ $u->type }})
                    </label>
                @endforeach
            </div>
        </div>

        <div>
            <label class="block mb-1 font-medium text-gray-700">Hora de despacho</label>
            <input type="datetime-local" name="dispatched_at"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">
        </div>

        <div>
            <label class="block mb-1 font-medium text-gray-700">Hora de llegada</label>
            <input type="datetime-local" name="arrival_time"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">
        </div>

        <div>
            <label class="block mb-1 font-medium text-gray-700">Hora de regreso</label>
            <input type="datetime-local" name="return_time"
                   class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">
        </div>

        <div class="pt-4">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded font-semibold">
                🚑 Despachar
            </button>
        </div>
    </form>
</div>
@endsection
