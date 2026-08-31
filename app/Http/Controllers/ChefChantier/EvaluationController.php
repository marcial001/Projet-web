<?php

namespace App\Http\Controllers\ChefChantier;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Evaluation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class EvaluationController extends Controller
{
    public function index()
    {
        $evaluations = Evaluation::with(['employee', 'evaluerPar'])
            ->where('evalué_par', Auth::user()->id)
            ->latest()
            ->get();

        return view('chef-chantier.evaluations.index', compact('evaluations'));
    }

    public function create()
    {
        $employees = Employee::where('chef_chantier_id', Auth::user()->id)->get();
        return view('chef-chantier.evaluations.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employee,id',
            'score' => 'required|numeric|min:0|max:20',
            'commentaire' => 'nullable|string',
            'date' => 'required|date',
        ]);

        Evaluation::create([
            'employee_id' => $request->employee_id,
            'score' => $request->score,
            'commentaire' => $request->commentaire,
            'date' => $request->date,
            'evalué_par' => Auth::user()->id,
        ]);

        return redirect()->route('chef-chantier.evaluations.index')
                         ->with('success', 'Évaluation enregistrée avec succès.');
    }

    public function show(Evaluation $evaluation)
    {
        if ($evaluation->evalué_par !== Auth::user()->id) {
            abort(403);
        }

        return view('chef-chantier.evaluations.show', compact('evaluation'));
    }

    public function edit(Evaluation $evaluation)
    {
        if ($evaluation->evalué_par !== Auth::user()->id) {
            abort(403);
        }

        $employees = Employee::where('chef_chantier_id', Auth::user()->id)->get();
        return view('chef-chantier.evaluations.edit', compact('evaluation', 'employees'));
    }

    public function update(Request $request, Evaluation $evaluation)
    {
        if ($evaluation->evalué_par !== Auth::user()->id) {
            abort(403);
        }

        $request->validate([
            'employee_id' => 'required|exists:employee,id',
            'score' => 'required|numeric|min:0|max:20',
            'commentaire' => 'nullable|string',
            'date' => 'required|date',
        ]);

        $evaluation->update($request->only(['employee_id', 'score', 'commentaire', 'date']));

        return redirect()->route('chef-chantier.evaluations.index')
                         ->with('success', 'Évaluation mise à jour.');
    }

    public function destroy(Evaluation $evaluation)
    {
        if ($evaluation->evalué_par !== Auth::user()->id) {
            abort(403);
        }

        $evaluation->delete();

        return back()->with('success', 'Évaluation supprimée avec succès.');
    }
}