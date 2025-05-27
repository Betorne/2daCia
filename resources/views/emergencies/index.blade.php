@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Emergencias</h1>

    <div class="mb-4">
        <a href="{{ route('emergencies.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
            ➕ Nueva emergencia
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm border border-gray-300 rounded">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-2 border-b">ID</th>
                    <th class="px-4 py-2 border-b">Tipo</th>
                    <th class="px-4 py-2 border-b">Dirección</th>
                    <th class="px-4 py-2 border-b">Prioridad</th>
                    <th class="px-4 py-2 border-b">Estado</th>
                    <th class="px-4 py-2 border-b">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-gray-800">
                @foreach($emergencies as $emergency)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border-b">{{ $emergency->id }}</td>
                        <td class="px-4 py-2 border-b">{{ $emergency->type }}</td>
                        <td class="px-4 py-2 border-b">{{ $emergency->address }}</td>
                        <td class="px-4 py-2 border-b capitalize">{{ $emergency->priority }}</td>
                        <td class="px-4 py-2 border-b capitalize">{{ $emergency->status }}</td>
                        <td class="px-4 py-2 border-b space-x-2">
                           @php
                            $data = $emergency->toArray();
                            $data['units'] = $emergency->dispatches->map(fn($d) => [
                                'code' => $d->unit->code,
                                'type' => $d->unit->type
                            ])->values();
                        @endphp

                        <button
                            type="button"
                            class="hs-overlay-toggle ..."
                            data-hs-overlay="#emergency-slideover"
                            data-emergency='@json($data)'>
                            Ver detalle
                        </button>
                            <a href="{{ route('emergencies.edit', $emergency) }}"
                               class="text-yellow-600 hover:underline">✏️ Editar
                            </a>
                            <form action="{{ route('emergencies.destroy', $emergency) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta emergencia?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline text-sm">
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
<div id="emergency-slideover" class="hs-overlay hidden fixed inset-y-0 end-0 z-50 w-full max-w-md bg-white shadow-lg transition-all translate-x-full hs-overlay-open:translate-x-0">
    <div class="flex justify-between items-center p-4 border-b">
        <h3 class="text-lg font-bold text-gray-800">🚨 Detalle Emergencia</h3>

        <button type="button"
        class="text-gray-500 hover:text-gray-700"
        data-hs-overlay="#emergency-slideover">
    ✖
</button>

    </div>

    <div class="p-4 text-sm text-gray-700 space-y-3" id="slideover-content">
        <p><strong>ID:</strong> <span id="sld-id">–</span></p>
        <p><strong>Dirección:</strong> <span id="sld-address">–</span></p>
        <p><strong>Tipo:</strong> <span id="sld-type">–</span></p>
        <p><strong>Descripción:</strong> <span id="sld-description">–</span></p>
        <p><strong>Prioridad:</strong> <span id="sld-priority">–</span></p>
        <p><strong>Estado:</strong> <span id="sld-status">–</span></p>
        <p><strong>Fecha:</strong> <span id="sld-date">–</span></p>
    </div>

    <div class="p-4 border-t text-right">
<!-- Unidades asignadas -->
<div class="bg-gray-50 border rounded p-3 mt-4">
    <h4 class="text-sm font-semibold text-gray-600 mb-2">🚒 Unidades asignadas</h4>
    <ul id="sld-units" class="text-sm text-gray-700 space-y-1">
        <li class="text-gray-400 italic">Cargando...</li>
    </ul>
</div>
<!-- Botón "Cerrar" en el footer -->
        <button type="button"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                data-hs-overlay="#emergency-slideover">
            Cerrar
        </button>

    </div>
    <!-- Acciones -->
<div class="p-4 border-t space-y-3">

    <!-- Botón: Finalizar emergencia -->
    <form id="finalize-form" method="POST" action="" onsubmit="return confirm('¿Estás seguro/a que deseas finalizar esta emergencia?');">
        @csrf
        @method('PUT')
        <button type="submit"
                class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded text-sm font-medium">
            🔚 Finalizar emergencia
        </button>
    </form>

</div>
<div id="units-modal" class="hs-overlay hidden fixed inset-0 z-50 bg-black bg-opacity-40 flex justify-center items-center">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6 relative">
        <button type="button" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700" onclick="closeUnitsModal()">✖</button>
        <h3 class="text-lg font-bold mb-4">Unidades asignadas</h3>
        <ul id="units-list" class="space-y-2 text-sm text-gray-700"></ul>
    </div>
</div>

</div>

@endsection

