@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">📊 Dashboard de Emergencias</h1>

    {{-- Indicadores --}}
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded shadow p-4 text-center">
            <p class="text-lg font-semibold text-gray-700">Total</p>
            <p class="text-2xl font-bold">{{ $total }}</p>
        </div>
        <div class="bg-yellow-100 rounded shadow p-4 text-center">
            <p class="text-lg font-semibold text-yellow-700">Pendientes</p>
            <p class="text-2xl font-bold">{{ $pendientes }}</p>
        </div>
        <div class="bg-blue-100 rounded shadow p-4 text-center">
            <p class="text-lg font-semibold text-blue-700">En camino</p>
            <p class="text-2xl font-bold">{{ $enCamino }}</p>
        </div>
        <div class="bg-green-100 rounded shadow p-4 text-center">
            <p class="text-lg font-semibold text-green-700">Finalizadas</p>
            <p class="text-2xl font-bold">{{ $finalizadas }}</p>
        </div>
        <div class="bg-gray-100 rounded shadow p-4 text-center">
            <p class="text-lg font-semibold text-gray-700">Unidades disponibles</p>
            <p class="text-2xl font-bold">{{ $unidadesDisponibles }} / {{ $unidadesTotales }}</p>
        </div>
    </div>

    {{-- Gráfico por tipo --}}
    <div class="bg-white rounded shadow p-6 mb-6">
        <h2 class="text-xl font-bold mb-4">Emergencias por Tipo</h2>
        <canvas id="chartTipo"></canvas>
    </div>

    {{-- Gráfico por prioridad --}}
    <div class="bg-white rounded shadow p-6 mb-6">
        <h2 class="text-xl font-bold mb-4">Distribución por Prioridad</h2>
        <canvas id="chartPrioridad"></canvas>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctxTipo = document.getElementById('chartTipo').getContext('2d');
new Chart(ctxTipo, {
    type: 'bar',
    data: {
        labels: {!! json_encode($porTipo->pluck('type')) !!},
        datasets: [{
            label: 'Cantidad',
            data: {!! json_encode($porTipo->pluck('total')) !!},
            backgroundColor: 'rgba(59, 130, 246, 0.7)'
        }]
    }
});

const ctxPrioridad = document.getElementById('chartPrioridad').getContext('2d');
new Chart(ctxPrioridad, {
    type: 'pie',
    data: {
        labels: {!! json_encode($porPrioridad->pluck('priority')) !!},
        datasets: [{
            label: 'Cantidad',
            data: {!! json_encode($porPrioridad->pluck('total')) !!},
            backgroundColor: [
                'rgba(239, 68, 68, 0.7)',
                'rgba(251, 191, 36, 0.7)',
                'rgba(34, 197, 94, 0.7)'
            ]
        }]
    }
});
</script>
@endsection
