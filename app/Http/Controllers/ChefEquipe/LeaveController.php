<?php

namespace App\Http\Controllers\ChefEquipe;

use App\Models\Employee;
use App\Models\Leave;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    public function index()
    {
        $employees = Employee::where('chef_equipe_id', Auth::user()->id)->get();
        $leaves = Leave::whereIn('employee_id', $employees->pluck('id'))->with('employee')->get();
        return view('chef-equipe.leaves.index', compact('leaves', 'employees'));
    }

    public function create()
    {
        $employees = Employee::where('chef_equipe_id', Auth::user()->id)->get();
        return view('chef-equipe.leaves.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employee,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'raison' => 'required|string',
        ]);

        Leave::create([
            'employee_id' => $request->employee_id,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'raison' => $request->raison,
            'statut' => 'en attente',
        ]);

        return redirect()->route('chef-equipe.leaves.index')->with('success', 'Demande de congé envoyée.');
    }


    public function edit(Leave $leave)
    {
        $leave->load('employee'); // Ajoute cette ligne

        if (!$leave->employee || $leave->employee->chef_equipe_id !== Auth::user()->id) {
            abort(403);
        }

        $employees = Employee::where('chef_equipe_id', Auth::user()->id)->get();
        return view('chef-equipe.leaves.edit', compact('leave', 'employees'));
    }

    public function update(Request $request, Leave $leave)
    {
        if ($leave->employee->chef_equipe_id !== Auth::user()->id) {
            abort(403);
        }

        $request->validate([
            'employee_id' => 'required|exists:employee,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'raison' => 'required|string',
        ]);

        $leave->update($request->only(['employee_id', 'date_debut', 'date_fin', 'raison']));

        return redirect()->route('chef-equipe.leaves.index')->with('success', 'Congé mis à jour.');
    }

    public function approve(Leave $leave)
    {
        if ($leave->employee->chef_equipe_id !== Auth::user()->id) {
            abort(403);
        }

        $leave->update(['statut' => 'accepté', 'approuve_par' => auth::user()->id]);
        return back()->with('success', 'Congé approuvé avec succès.');
    }

    public function reject(Leave $leave)
    {
        if ($leave->employee->chef_equipe_id !== Auth::user()->id) {
            abort(403);
        }

        $leave->update(['statut' => 'refusé', 'approuve_par' => Auth::user()->id]);
        return back()->with('success', 'Congé refusé.');
    }
    public function destroy(Leave $leave)
{
    if ($leave->employee->chef_equipe_id !== Auth::user()->id) {
        abort(403);
    }

    $leave->delete();
    return redirect()->route('chef-equipe.leaves.index')->with('success', 'Congé supprimé avec succès.');
}
}