<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    /** @use HasFactory<\Database\Factories\LeaveFactory> */
    use HasFactory;

    protected $fillable = [
    'employee_id',
    'date_debut',
    'date_fin',
    'raison',
    'statut',
    'approuve_par'
];

public function employee()
{
    return $this->belongsTo(Employee::class, 'employee_id');
}

public function approbateur()
{
    return $this->belongsTo(User::class, 'approuve_par');
}
}
