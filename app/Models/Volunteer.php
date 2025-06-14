<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    protected $fillable = [
        'name',
        'rut',
        'email',
        'phone',
        'photo',
        'position',
        'company_id',
        'service_code',
    ];

    public function company()
{
    return $this->belongsTo(Company::class);
}
}
