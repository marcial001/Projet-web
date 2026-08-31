<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
        'nom',
        'description',
        'type', // ex: outil, véhicule, équipement
        'quantite_disponible',
        'localisation',
        'statut' // disponible, en utilisation, en maintenance
    ];
}
