<?php

namespace App\Http\Controllers\ChefChantier;

use App\Models\Absence;
use App\Models\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;


class AbsenceController extends Controller
{
    public function index()
    {
        $absences = Absence::where('enregistré_par', Auth::user()->id)->with('employee')->get();
        return view('chef-chantier.absences.index', compact('absences'));
    }

    public function create()
    {
        $employees = Employee::where('chef_chantier_id', Auth::user()->id)->get();
        return view('chef-chantier.absences.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employee,id',
            'date' => 'required|date',
            'raison' => 'required',
        ]);

        Absence::create([
            'employee_id' => $request->employee_id,
            'date' => $request->date,
            'raison' => $request->raison,
            'enregistré_par' => Auth::user()->id,
        ]);

        return redirect()->route('chef-chantier.absences.index')->with('success', 'Absence enregistrée.');
    }
    public function edit(Absence $absence)
    {
        // Vérifier que l'utilisateur connecté a le droit d'accéder à cette absence
        if ($absence->enregistré_par !== Auth::user()->id) {
            abort(403, "Vous n'êtes pas autorisé à modifier cette absence");
        }

        // Charger les employés sous sa responsabilité
        $employees = Employee::where('chef_chantier_id', Auth::user()->id)->get();

        return view('chef-chantier.absences.edit', compact('absence', 'employees'));
    }
    public function update(Request $request, Absence $absence)
    {
        // Vérifier que l’absence appartient bien au chef de chantier connecté
        if ($absence->enregistré_par !== Auth::user()->id) {
            abort(403, "Accès interdit");
        }

        // Validation des champs
        $request->validate([
            'employee_id' => 'required|exists:employee,id',
            'date' => 'required|date',
            'raison' => 'required|string|max:500',
        ]);

        // Mise à jour de l'absence
        $absence->update([
            'employee_id' => $request->employee_id,
            'date' => $request->date,
            'raison' => $request->raison,
        ]);

        return redirect()->route('chef-chantier.absences.index')->with('success', 'Absence mise à jour avec succès');
    }
    
}