<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    /** @use HasFactory<\Database\Factories\EvaluationFactory> */
    use HasFactory;
   
    protected $fillable = [
        'employee_id',
        'employee_nom',
        'score',
        'commentaire',
        'date',
        'evalué_par'
    ];

    public function employee()
    {
        return $this->belongsTo(\App\Models\Employee::class, 'employee_id');
    }

    public function evaluerPar()
    {
        return $this->belongsTo(\App\Models\User::class, 'evalue_par');
    }
}
