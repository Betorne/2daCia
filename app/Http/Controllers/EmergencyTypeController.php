<?php

namespace App\Http\Controllers;

use App\Models\EmergencyType;
use Illuminate\Http\RedirectResponse;

class EmergencyTypeController extends Controller
{
    public function seed(): RedirectResponse
    {
        $types = [
            ['code' => '10-0', 'description' => 'Llamado estructural'],
            ['code' => '10-0-1', 'description' => 'Casa habitación / Local comercial'],
            ['code' => '10-0-2', 'description' => 'Edificio'],
            ['code' => '10-0-3', 'description' => 'Fábrica / Local público'],
            ['code' => '10-0-4', 'description' => 'Población / Alto riesgo'],
            ['code' => '10-0-5', 'description' => 'Depósito Hazmat o gas / Explosión'],
            ['code' => '10-0-6', 'description' => 'Subterráneo'],
            ['code' => '10-1', 'description' => 'Fuego en vehículo'],
            ['code' => '10-2', 'description' => 'Pastizales / Forestal'],
            ['code' => '10-3', 'description' => 'Salvamento de personas'],
            ['code' => '10-4', 'description' => 'Rescate vehicular'],
            ['code' => '10-5', 'description' => 'Incidente Hazmat'],
            ['code' => '10-6', 'description' => 'Emanación de gas'],
            ['code' => '10-7', 'description' => 'Emergencia eléctrica'],
            ['code' => '10-8', 'description' => 'Llamado no clasificado'],
            ['code' => '10-9', 'description' => 'Apoyo a otros servicios (no emergencia)'],
            ['code' => '10-10', 'description' => 'Remoción de escombros o rebrote'],
            ['code' => '10-11', 'description' => 'Servicio aéreo'],
            ['code' => '10-12', 'description' => 'Apoyo a otro cuerpo de bomberos'],
            ['code' => '10-13', 'description' => 'Atentado terrorista'],
            ['code' => '10-14', 'description' => 'Avión que cayó o impactó estructura'],
            ['code' => '10-15', 'description' => 'Simulacro'],
            ['code' => '10-16', 'description' => 'Emergencia en túnel'],
            ['code' => '10-17', 'description' => 'Emergencia en Metro'],
        ];

        foreach ($types as $type) {
            EmergencyType::firstOrCreate(
                ['code' => $type['code']],
                ['description' => $type['description']]
            );
        }

        return back()->with('success', 'Tipos de emergencia creados.');
    }
}
