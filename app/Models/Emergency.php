<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Emergency extends Model
{
    protected $fillable = [
           'emergency_type_id',
            'type',
            'address',
            'description',
            'priority',
            'status',
            ];

    public function dispatches()
    {
        return $this->hasMany(Dispatch::class);
        
    }
    public function type()
{
    return $this->belongsTo(EmergencyType::class, 'emergency_type_id');
}
}
