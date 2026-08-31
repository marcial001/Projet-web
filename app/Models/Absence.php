<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    /** @use HasFactory<\Database\Factories\AbsenceFactory> */
    use HasFactory;
     protected $fillable = [
        'employee_id',
        'date',
        'raison',
        'enregistré_par'
    ];

    public function employee()
    {
        return $this->belongsTo(\App\Models\Employee::class, 'employee_id');
    }

    public function enregistrePar()
    {
        return $this->belongsTo(\App\Models\User::class, 'enregistre_par');
    }
}
