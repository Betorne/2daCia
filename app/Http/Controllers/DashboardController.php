<?php

namespace App\Http\Controllers;

use App\Models\Emergency;
use App\Models\Unit;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        
        // Conteo general de emergencias
        $total = Emergency::count();
        $pendientes = Emergency::where('status', 'pendiente')->count();
        $enCamino = Emergency::where('status', 'en_camino')->count();
        $finalizadas = Emergency::where('status', 'finalizada')->count();

        // Unidades
        $unidadesTotales = Unit::count();
        $unidadesDisponibles = Unit::where('availability', true)->count();
        $unidadesOcupadas = Unit::where('availability', false)->count();

        // Gráfico de emergencias por tipo
        $porTipo = Emergency::select('type', DB::raw('count(*) as total'))
            ->groupBy('type')
            ->orderBy('total', 'desc')
            ->get();

        // Gráfico de emergencias por prioridad
        $porPrioridad = Emergency::select('priority', DB::raw('count(*) as total'))
            ->groupBy('priority')
            ->orderBy('priority')
            ->get();

        return view('dashboard', compact(
            'total',
            'pendientes',
            'enCamino',
            'finalizadas',
            'unidadesTotales',
            'unidadesDisponibles',
            'unidadesOcupadas',
            'porTipo',
            'porPrioridad'
        ));
    }
}
