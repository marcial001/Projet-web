<?php

namespace App\Http\Controllers\Directeur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Task;
use App\Models\Absence;
use App\Models\Leave;   

class RapportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('directeur.rapports.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $type)
    {
        $data = [];

        if ($type === 'employés') {
            $data['items'] = Employee::with(['chefChantier', 'chefEquipe'])->get();
            $data['title'] = 'Employés';
            $data['columns'] = ['Nom', 'Email', 'Poste', 'Chef de Chantier', 'Chef d’équipe'];
        } elseif ($type === 'tâches') {
            $data['items'] = Task::with('employe')->get();
            $data['title'] = 'Tâches';
            $data['columns'] = ['Titre', 'Statut', 'Employé', 'Remarque'];
        } elseif ($type === 'absences') {
            $data['items'] = Absence::with('employe')->get();
            $data['title'] = 'Absences';
            $data['columns'] = ['Date', 'Raison', 'Employé'];
        } elseif ($type === 'conges') {
            $data['items'] = Leave::with('employe')->get();
            $data['title'] = 'Demandes de Congés';
            $data['columns'] = ['Dates', 'Raison', 'Statut', 'Employé'];
        }

        return view("directeur.rapports.$type", compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
