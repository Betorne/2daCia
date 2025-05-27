@foreach ($emergencies as $e)
<div id="emergency-slideover-{{ $e->id }}" class="hs-overlay hs-overlay-open:translate-x-0 hidden fixed top-0 end-0 transition-all transform translate-x-full z-50 w-full max-w-md h-full bg-white border-s shadow-lg"
     tabindex="-1">
    <div class="flex justify-between items-center p-4 border-b">
        <h3 class="text-lg font-bold text-gray-800">🚨 Emergencia #{{ $e->id }}</h3>
        <button type="button" class="hs-overlay-close text-gray-500 hover:text-gray-700">✖</button>
    </div>

    <div class="p-4 space-y-3 text-sm text-gray-700">
        <p><strong>📍 Dirección:</strong> {{ $e->address }}</p>
        <p><strong>📝 Descripción:</strong> {{ $e->description ?? 'Sin descripción' }}</p>
        <p><strong>📌 Tipo:</strong> {{ $e->type }}</p>
        <p><strong>⚠️ Prioridad:</strong>
            <span class="@if($e->priority == 'alta') text-red-600 @elseif($e->priority == 'media') text-yellow-600 @else text-green-600 @endif font-semibold">
                {{ ucfirst($e->priority) }}
            </span>
        </p>
        <p><strong>⏳ Estado:</strong>
            <span class="@if($e->status == 'pendiente') text-gray-600 @elseif($e->status == 'en_camino') text-blue-600 @else text-green-700 @endif font-semibold">
                {{ ucfirst(str_replace('_', ' ', $e->status)) }}
            </span>
        </p>
        <p><strong>📅 Fecha:</strong> {{ $e->created_at->format('d-m-Y H:i') }}</p>
    </div>

    <div class="p-4 border-t text-right">
        <button type="button" class="hs-overlay-close inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700">
            Cerrar
        </button>
    </div>
</div>
@endforeach
