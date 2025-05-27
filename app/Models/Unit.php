<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = ['code', 'type', 'availability'];

    public function dispatches()
{
    return $this->hasMany(Dispatch::class);
}
}
