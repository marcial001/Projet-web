<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialEntree extends Model
{
    protected $fillable = [
        'material_id',
        'quantite',
        'date_entree',
        'fournisseur',
        'numero_facture',
        'etat'
    ];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}