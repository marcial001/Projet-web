<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
    use HasFactory;

    protected $table = 'employee';
    protected $fillable = [
        'name',
        'prenom',
        'phone',
        'fonction',
        'chef_chantier_id',
        'chef_equipe_id', // Si vous avez besoin de cette colonne pour un chef d'équipe
    ];

    // Relation avec le chef de chantier
    public function chefChantier()
    {
        return $this->belongsTo(\App\Models\User::class, 'chef_chantier_id');
    }

    // Relation avec le chef d'équipe
    public function chefEquipe()
    {
        return $this->belongsTo(\App\Models\User::class, 'chef_equipe_id');
    }
}
