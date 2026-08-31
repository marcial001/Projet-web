<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Champs autorisés à la modification (mass assignment)
    protected $fillable = [
        'titre',
        'description',
        'statut',
        'remarque',
        'employee_id',
        'attribue_par'
    ];

    // Valeurs par défaut et conversions automatiques
    protected $casts = [
        'statut' => 'string', // en attente, en cours, terminée
    ];

    // Relation avec l’employé
    public function employee()
    {
        return $this->belongsTo(\App\Models\Employee::class, 'employee_id');
    }

    // Relation avec l'utilisateur qui a attribué la tâche (chef_chantier)
    public function attribuePar()
    {
        return $this->belongsTo(\App\Models\User::class, 'attribue_par');
    }
}