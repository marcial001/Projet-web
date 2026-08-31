<?php

namespace App\Http\Controllers\ChefChantier;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::where('chef_chantier_id', Auth::user()->id)->get();
        return view('chef-chantier.employees.index', compact('employees'));
    }

    public function create()
    {
        // Liste des chefs d'équipe pour l'affectation
        $chefsEquipe = \App\Models\User::where('role', 'chef_equipe')->get();
        return view('chef-chantier.employees.create', compact('chefsEquipe'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'fonction' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
            'chef_equipe_id' => 'nullable|exists:users,id',
        ]);

        Employee::create([
            'name' => $request->name,
            'prenom' => $request->prenom,
            'fonction' => $request->fonction,
            'phone' => $request->phone,
            'chef_chantier_id' => Auth::user()->id,
            'chef_equipe_id' => $request->chef_equipe_id,
        ]);

        return redirect()->route('chef-chantier.employees.index')
            ->with('success', 'Employé créé avec succès.');
    }

    public function show(Employee $employee)
    {
        if ($employee->chef_chantier_id !== Auth::user()->id) {
            abort(403, "Vous n'êtes pas autorisé à consulter cet employé.");
        }
        return view('chef-chantier.employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        if ($employee->chef_chantier_id !== Auth::user()->id) {
            abort(403, "Vous ne pouvez pas modifier cet employé");
        }
        $chefsEquipe = \App\Models\User::where('role', 'chef_equipe')->get();
        return view('chef-chantier.employees.edit', compact('employee', 'chefsEquipe'));
    }

    public function update(Request $request, Employee $employee)
    {
        if ($employee->chef_chantier_id !== Auth::user()->id) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'fonction' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15',
            'chef_equipe_id' => 'nullable|exists:users,id',
        ]);

        $employee->update([
            'name' => $request->name,
            'prenom' => $request->prenom,
            'fonction' => $request->fonction,
            'phone' => $request->phone,
            'chef_equipe_id' => $request->chef_equipe_id,
        ]);

        return redirect()->route('chef-chantier.employees.index')
            ->with('success', 'Employé mis à jour.');
    }

    public function destroy(Employee $employee)
    {
        if ($employee->chef_chantier_id !== Auth::user()->id) {
            abort(403, "Vous ne pouvez pas supprimer cet employé.");
        }

        $employee->delete();

        return back()->with('success', 'Employé supprimé avec succès.');
    }
}