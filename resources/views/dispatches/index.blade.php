@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Despachos</h1>

    <div class="mb-4">
        <a href="{{ route('dispatches.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
            ➕ Nuevo despacho
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm border border-gray-300 rounded">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-2 border-b text-left">Emergencia</th>
                    <th class="px-4 py-2 border-b text-left">Unidad</th>
                    <th class="px-4 py-2 border-b text-left">Despachado</th>
                    <th class="px-4 py-2 border-b text-left">Llegada</th>
                    <th class="px-4 py-2 border-b text-left">Regreso</th>
                </tr>
            </thead>
            <tbody class="text-gray-800">
               @php
    $grouped = $dispatches->groupBy('emergency_id');
@endphp

            @php
    $grouped = $dispatches->groupBy('emergency_id');
@endphp

@foreach ($grouped as $emergencyId => $group)
    @php
        $first = $group->first();
        $emergency = $first->emergency;
        $units = $group->map(fn($d) => $d->unit)->filter();
    @endphp

    <tr class="border-t">
        <td class="px-4 py-2 font-medium">{{ $emergency->type }} – {{ $emergency->address }}</td>

        <td class="px-4 py-2">
            <div class="flex flex-wrap gap-2">
                @forelse ($units as $unit)
                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm">
                        🚒 {{ $unit->code }} – {{ $unit->type }}
                    </span>
                @empty
                    <span class="text-gray-400 italic">Sin unidades</span>
                @endforelse
            </div>
        </td>

        <td class="px-4 py-2">{{ optional($first->dispatched_at)->format('d-m-Y H:i') }}</td>
        <td class="px-4 py-2">{{ optional($first->arrival_time)->format('d-m-Y H:i') }}</td>
        <td class="px-4 py-2">{{ optional($first->return_time)->format('d-m-Y H:i') }}</td>
    </tr>
@endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
