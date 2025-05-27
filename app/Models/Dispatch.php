<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dispatch extends Model
{
    protected $fillable = ['emergency_id', 'unit_id', 'dispatched_at', 'arrival_time', 'return_time'];

    public function emergency()
    {
        return $this->belongsTo(Emergency::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
