<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialSortie extends Model
{
    protected $fillable = [
        'material_id',
        'employe_id',
        'chef_chantier_id',
        'quantite',
        'date_sortie',
        'raison',
        'destination',
        'statut_retour'
    ];

    // Relation avec le matériel
    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    // Relation avec l'employé destinataire
    public function destinataire()
    {
        return $this->belongsTo(Employee::class, 'employe_id');
    }

    // Relation avec le chef de chantier (utilisateur)
    public function chefChantier()
    {
        return $this->belongsTo(\App\Models\User::class, 'chef_chantier_id');
    }
}