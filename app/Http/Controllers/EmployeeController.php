<?php
namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Liste tous les employés.
     */
    public function index()
    {
        $employees = Employee::with('chefChantier')->get();
        return view('employee.list', compact('employees'));
    }

    /**
     * Affiche le formulaire pour créer un nouvel employé.
     */
    public function create()
    {
        $chefs = \App\Models\User::where('role', 'chef_chantier')->get();
        return view('employee.create', compact('chefs'));
    }

    /**
     * Enregistre un nouvel employé.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'phone' => 'required|string|max:255|unique:employee,phone',
            'fonction' => 'required|string|max:255',
            'chef_chantier_id' => 'nullable|exists:users,id',
        ]);


        Employee::create($request->all());

        return redirect()->route('employees.index')->with('success', 'Employé créé avec succès.');
    }

    /**
     * Affiche les détails d’un employé.
     */
    public function show(Employee $employee)
    {
        $employee->load('chefChantier');
        return view('employee.show', compact('employee'));
    }

    /**
     * Affiche le formulaire d’édition d’un employé.
     */
    public function edit(Employee $employee)
    {
        $chefs = \App\Models\User::where('role', 'chef_chantier')->get();
        return view('employee.edit', compact('employee', 'chefs'));
    }

    /**
     * Met à jour un employé existant.
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'phone' => 'required|string|max:255|unique:employee,phone,' . $employee->id,
            'fonction' => 'required|string|max:255',
            'chef_chantier_id' => 'nullable|exists:users,id',
        ]);

        $employee->update($request->all());

        return redirect()->route('employees.index')->with('success', 'Employé mis à jour avec succès.');
    }

    /**
     * Supprime un employé.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employé supprimé avec succès.');
    }
}