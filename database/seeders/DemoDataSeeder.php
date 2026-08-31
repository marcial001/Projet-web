<?php

namespace Database\Seeders;

use App\Models\Absence;
use App\Models\Employee;
use App\Models\Evaluation;
use App\Models\Leave;
use App\Models\Material;
use App\Models\MaterialEntree;
use App\Models\MaterialSortie;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@chantier.local'],
            [
                'name' => 'Admin Principal',
                'phone' => '0600000001',
                'role' => 'admin',
                'password' => Hash::make('admin123'),
            ]
        );

        $chefChantier = User::firstOrCreate(
            ['email' => 'chefchantier@chantier.local'],
            [
                'name' => 'Chef Chantier A',
                'phone' => '0600000002',
                'role' => 'chef_chantier',
                'password' => Hash::make('chef123'),
            ]
        );

        $chefEquipe = User::firstOrCreate(
            ['email' => 'chefequipe@chantier.local'],
            [
                'name' => 'Chef Equipe A',
                'phone' => '0600000003',
                'role' => 'chef_equipe',
                'password' => Hash::make('equipe123'),
            ]
        );

        $directeur = User::firstOrCreate(
            ['email' => 'directeur@chantier.local'],
            [
                'name' => 'Directeur RH',
                'phone' => '0600000004',
                'role' => 'directeurs',
                'password' => Hash::make('directeur123'),
            ]
        );

        $employeesSeed = [
            ['name' => 'Ali', 'prenom' => 'Benali', 'phone' => '0611111111', 'fonction' => 'Maçon'],
            ['name' => 'Karim', 'prenom' => 'Said', 'phone' => '0622222222', 'fonction' => 'Cariste'],
            ['name' => 'Nassim', 'prenom' => 'Ait', 'phone' => '0633333333', 'fonction' => 'Électricien'],
            ['name' => 'Youssef', 'prenom' => 'Amrani', 'phone' => '0644444444', 'fonction' => 'Plombier'],
            ['name' => 'Samir', 'prenom' => 'Mansouri', 'phone' => '0655555555', 'fonction' => 'Menuisier'],
            ['name' => 'Hassan', 'prenom' => 'Mourad', 'phone' => '0666666666', 'fonction' => 'Soudeur'],
            ['name' => 'Omar', 'prenom' => 'Belkacem', 'phone' => '0677777777', 'fonction' => 'Charpentier'],
            ['name' => 'Anas', 'prenom' => 'Haddad', 'phone' => '0688888888', 'fonction' => 'Peintre'],
            ['name' => 'Mouad', 'prenom' => 'Khalifa', 'phone' => '0699999999', 'fonction' => 'Installateur'],
            ['name' => 'Reda', 'prenom' => 'Sassi', 'phone' => '0601010101', 'fonction' => 'Finisseur'],
        ];

        $employees = [];
        foreach ($employeesSeed as $employeeData) {
            $employee = Employee::firstOrCreate(
                ['phone' => $employeeData['phone']],
                [
                    'name' => $employeeData['name'],
                    'prenom' => $employeeData['prenom'],
                    'phone' => $employeeData['phone'],
                    'fonction' => $employeeData['fonction'],
                    'chef_chantier_id' => $chefChantier->id,
                    'chef_equipe_id' => $chefEquipe->id,
                ]
            );
            $employees[] = $employee;
        }

        $taskTitles = [
            'Préparation du site',
            'Pose des fondations',
            'Installation du réseau électrique',
            'Levage des poutres',
            'Réalisation du bardage',
            'Peinture intérieure',
            'Contrôle qualité',
            'Préparation de la livraison',
            'Nettoyage final',
            'Clôture du chantier',
        ];

        foreach ($taskTitles as $index => $title) {
            $employee = $employees[$index % count($employees)];
            Task::firstOrCreate(
                [
                    'titre' => $title,
                    'employee_id' => $employee->id,
                ],
                [
                    'description' => 'Travail à effectuer selon le planning du chantier et le cahier des charges technique.',
                    'statut' => ['en attente', 'en cours', 'terminée'][ $index % 3 ],
                    'remarque' => 'À revoir avec le responsable chantier dès validation.',
                    'attribue_par' => $chefChantier->id,
                ]
            );
        }

        foreach (range(1, 12) as $index) {
            $employee = $employees[$index % count($employees)];
            $date = now()->subDays($index * 3);
            Absence::firstOrCreate(
                [
                    'employee_id' => $employee->id,
                    'date' => $date->toDateString(),
                ],
                [
                    'raison' => $index % 2 === 0 ? 'Maladie légère' : 'Raison familiale',
                    'enregistré_par' => $chefChantier->id,
                ]
            );
        }

        foreach (range(1, 10) as $index) {
            $employee = $employees[$index % count($employees)];
            Evaluation::firstOrCreate(
                [
                    'employee_id' => $employee->id,
                    'date' => now()->subDays($index * 5)->toDateString(),
                ],
                [
                    'score' => 12 + ($index % 5),
                    'commentaire' => 'Evaluation périodique du niveau de performance et du respect des délais.',
                    'evalué_par' => $chefEquipe->id,
                ]
            );
        }

        foreach (range(1, 8) as $index) {
            $employee = $employees[$index % count($employees)];
            $start = now()->addDays($index + 1)->toDateString();
            $end = now()->addDays($index + 4)->toDateString();
            Leave::firstOrCreate(
                [
                    'employee_id' => $employee->id,
                    'date_debut' => $start,
                    'date_fin' => $end,
                ],
                [
                    'raison' => 'Congé annuel / besoin personnel',
                    'statut' => ['en attente', 'accepté', 'refusé'][ $index % 3 ],
                    'approuve_par' => $chefEquipe->id,
                ]
            );
        }

        $materialsData = [
            ['nom' => 'Perceuse sans fil', 'type' => 'outil', 'description' => 'Perceuse sans fil 18V', 'quantite_disponible' => 8, 'localisation' => 'Atelier central', 'statut' => 'disponible'],
            ['nom' => 'Camion 3T', 'type' => 'véhicule', 'description' => 'Camion de transport interne', 'quantite_disponible' => 2, 'localisation' => 'Garage', 'statut' => 'en utilisation'],
            ['nom' => 'Scie circulaire', 'type' => 'outil', 'description' => 'Scie circulaire professionnele', 'quantite_disponible' => 5, 'localisation' => 'Magasin 2', 'statut' => 'disponible'],
            ['nom' => 'Échafaudage modulaire', 'type' => 'equipement', 'description' => 'Échafaudage standard 6m', 'quantite_disponible' => 4, 'localisation' => 'Dépôt A', 'statut' => 'disponible'],
            ['nom' => 'Niveleur laser', 'type' => 'outil', 'description' => 'Niveleur optique et laser', 'quantite_disponible' => 3, 'localisation' => 'Atelier B', 'statut' => 'disponible'],
            ['nom' => 'Mini pelle', 'type' => 'véhicule', 'description' => 'Mini pelle compact', 'quantite_disponible' => 1, 'localisation' => 'Terrain principal', 'statut' => 'en utilisation'],
            ['nom' => 'Coffret d’outils', 'type' => 'outil', 'description' => 'Coffret complet pour menuisiers', 'quantite_disponible' => 6, 'localisation' => 'Magasin 1', 'statut' => 'disponible'],
            ['nom' => 'Groupe électrogène', 'type' => 'equipement', 'description' => 'Groupe de secours 5kva', 'quantite_disponible' => 2, 'localisation' => 'Dépôt électrique', 'statut' => 'disponible'],
        ];

        $materials = [];
        foreach ($materialsData as $materialData) {
            $material = Material::firstOrCreate(
                ['nom' => $materialData['nom']],
                $materialData
            );
            $materials[] = $material;
        }

        foreach ($materials as $index => $material) {
            MaterialEntree::firstOrCreate(
                [
                    'material_id' => $material->id,
                    'numero_facture' => 'FAC-2026-' . ($index + 1),
                ],
                [
                    'quantite' => 10 + $index,
                    'date_entree' => now()->subDays(15 + $index)->toDateString(),
                    'fournisseur' => 'Fournisseur ' . ($index + 1),
                    'etat' => 'neuf',
                ]
            );
        }

        foreach ($materials as $index => $material) {
            $employee = $employees[$index % count($employees)];
            MaterialSortie::firstOrCreate(
                [
                    'material_id' => $material->id,
                    'date_sortie' => now()->subDays($index + 2)->toDateString(),
                ],
                [
                    'employe_id' => $employee->id,
                    'chef_chantier_id' => $chefChantier->id,
                    'quantite' => max(1, intdiv($material->quantite_disponible, 2)),
                    'raison' => 'Utilisation sur chantier',
                    'destination' => 'Zone de travail ' . ($index + 1),
                    'statut_retour' => ['non_rendu', 'rendu', 'endommagé'][ $index % 3 ],
                ]
            );
        }

        $this->command->info('Demo data seeded successfully.');
        $this->command->info('Admin login: admin@chantier.local / admin123');
    }
}
