<?php

namespace App\Http\Controllers\ChefEquipe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChefEquipe;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use App\Models\Task;
use App\Models\Leave;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Employés sous sa responsabilité
        $employees = Employee::where('chef_equipe_id', Auth::user()->id)->get();

        // Tâches des employés de son équipe
        $tasks = Task::whereIn('employee_id', $employees->pluck('id'))->get();

        // Congés en attente d'approbation
        $pendingLeaves = Leave::whereIn('employee_id', $employees->pluck('id'))
            ->where('statut', 'en attente')
            ->get();

        return view('chef-equipe.dashboard.index', compact('employees', 'tasks', 'pendingLeaves'));
    }

    public function monEquipe()
    {
        // Récupère les employés de l'équipe du chef connecté
        $employees = Employee::where('chef_equipe_id', Auth::user()->id)->get();
        return view('chef-equipe.mon-equipe', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(string $id)
    {
        //
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
