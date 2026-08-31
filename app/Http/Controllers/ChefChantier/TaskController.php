<?php

namespace App\Http\Controllers\ChefChantier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('attribue_par', Auth::user()->id)->with('employee')->get();
        return view('chef-chantier.tasks.index', compact('tasks'));
    }

    public function create()
    {
        $employees = Employee::where('chef_chantier_id', Auth::user()->id)->get();
        return view('chef-chantier.tasks.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required',
            'employee_id' => 'required|exists:employee,id',
            'statut' => 'in:en attente,en cours,terminée',
            'remarque' => 'nullable',
        ]);

        Task::create([
            'titre' => $request->titre,
            'description' => $request->description,
            'statut' => $request->statut ?? 'en attente',
            'remarque' => $request->remarque,
            'employee_id' => $request->employee_id,
            'attribue_par' => Auth::user()->id,
        ]);

        return redirect()->route('chef-chantier.tasks.index')->with('success', 'Tâche créée avec succès.');
    }

    public function edit(Task $task)
    {
        if ($task->attribue_par !== Auth::user()->id) abort(403);

        $employees = Employee::where('chef_chantier_id', Auth::user()->id)->get();
        return view('chef-chantier.tasks.edit', compact('task', 'employees'));
    }

    public function update(Request $request, Task $task)
    {
        if ($task->attribue_par !== Auth::user()->id) abort(403);

        $request->validate([
            'titre' => 'required',
            'employee_id' => 'required|exists:employee,id',
            'statut' => 'in:en attente,en cours,terminée',
        ]);

        $task->update($request->all());

        return redirect()->route('chef-chantier.tasks.index')->with('success', 'Tâche mise à jour.');
    }

    public function destroy(Task $task)
    {
        if ($task->attribue_par !== Auth::user()->id) abort(403);
        $task->delete();
        return back()->with('success', 'Tâche supprimée.');
    }
}