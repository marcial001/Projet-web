<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Material;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    Material::create([
        'nom' => 'Perceuse Bosch',
        'type' => 'outil',
        'quantite_disponible' => 5,
        'localisation' => 'Chantier A',
        'statut' => 'disponible'
    ]);

    Material::create([
        'nom' => 'Camion 3 tonnes',
        'type' => 'véhicule',
        'quantite_disponible' => 2,
        'localisation' => 'Garage central',
        'statut' => 'en utilisation'
    ]);
}
}
