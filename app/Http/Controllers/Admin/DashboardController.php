<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\employee;
use App\Models\User;
use App\Models\Task;
use App\Models\Absence;
use App\Models\Leave;
use App\Models\Evaluation;
use App\Models\Material;



class DashboardController extends Controller
{

    public function index()
    {
        /*Statistiques */
        $totalUsers = User::count();
        $totalEmployees = Employee::count();
        $tasks = Task::all();
        $evaluations = Evaluation::all();
        $pendingTasks = Task::where('statut', 'en attente')->count();
        $absencesToday = Absence::whereDate('date', now())->count();
        $pendingLeaves = Leave::where('statut', 'en attente')->count();

        // Récupère les matériels
        $materials = Material::all();
        $totalMaterials = $materials->count();
        $totalEntrees = \App\Models\MaterialEntree::count();
        $totalSorties = \App\Models\MaterialSortie::count();



        /*
        return view('admin.dashboard.index', compact(
            'totalUsers',
            'totalEmployees',
            'totalTasks',
            'pendingTasks',
            'absencesToday',
            'pendingLeaves'
        )); */

        //$employee = Employee::with('chefChantier')->first();
        return view('admin.dashboard', compact(
            'totalUsers',
            'totalEmployees',
            'tasks',
            'pendingTasks',
            'absencesToday',
            'pendingLeaves',
            'evaluations',
            'materials',
            'totalMaterials',
            'totalEntrees',
            'totalSorties'
        ));
    }
}

