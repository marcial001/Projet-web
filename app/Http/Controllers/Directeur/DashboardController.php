<?php

namespace App\Http\Controllers\Directeur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Task;
use App\Models\Absence;
use App\Models\Leave;
use App\Models\Evaluation;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        $employees = Employee::with(['chefChantier', 'chefEquipe'])->get();
        $absences = Absence::with('employee')->latest()->take(5)->get();
        $leaves = Leave::with('employee')->latest()->take(5)->get();
        $absencesCount = Absence::count();
        $employeeCount = Employee::count();
        $leavesCount = Leave::count();
        $usersCount = User::count();
        $tasksCount = Task::count();
        $completedTasksCount = Task::where('statut', 'terminée')->count(); // <-- AJOUT ICI
        $evaluationsCount = Evaluation::count();
        $evaluations = Evaluation::with('employee')->latest()->take(5)->get();

        return view('directeurs.dashboard.index', compact(
            'employees',
            'absences',
            'leaves',
            'employeeCount',
            'completedTasksCount',
            'absencesCount',
            'leavesCount',
            'evaluationsCount',
            'evaluations',
            'usersCount',
            'tasksCount'
        ));
    }

    public function users()
    {
        $users = User::all();
        return view('directeurs.users.index', compact('users'));
    }
    public function employees()
    {
        $employees = Employee::with(['chefChantier', 'chefEquipe'])->get();
        return view('employee.list', compact('employees'));
    }

    public function tasks()
    {
        $tasks = Task::with('employee')->get();
        return view('directeurs.tasks.index', compact('tasks'));
    }

    public function absences()
    {
        $absences = Absence::with('employee')->get();
        return view('directeurs.absences.index', compact('absences'));
    }

    public function leaves()
    {
        $leaves = Leave::with('employee')->get();
        return view('directeurs.leaves.index', compact('leaves'));
    }

    public function evaluations()
    {
        $evaluations = Evaluation::with('employee')->get();
        return view('directeurs.evaluations.index', compact('evaluations'));
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
