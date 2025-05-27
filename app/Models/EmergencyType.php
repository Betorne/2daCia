<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmergencyType extends Model
{
    protected $fillable = ['code', 'description'];

    public function emergencies()
    {
        return $this->hasMany(Emergency::class);
    }
}