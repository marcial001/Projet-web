<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MaterialSortie;
use Illuminate\Http\Request;
use App\Models\Material;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;

class MaterialSortieController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $sorties = MaterialSortie::with(['material', 'destinataire'])
            ->where('chef_chantier_id', Auth::id())
            ->get();
        return view('admin.materiels.sorties.index', compact('sorties'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $materials = Material::all();
        $employees = Employee::all();
        return view('admin.materiels.sorties.create', compact('materials', 'employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'material_id' => 'required|exists:materials,id',
            'employe_id' => 'nullable|exists:employee,id',
            'quantite' => 'required|integer|min:1',
            'raison' => 'required|string',
            'destination' => 'required|string'
        ]);

        $sortie = MaterialSortie::create([
            'material_id' => $request->material_id,
            'employe_id' => $request->employe_id, // Correction ici
            'chef_chantier_id' => Auth::id(),
            'quantite' => $request->quantite,
            'raison' => $request->raison,
            'destination' => $request->destination,
            'date_sortie' => now(),
        ]);
        // Décrémenter le stock
        $material = Material::find($request->material_id);
        $material->decrement('quantite_disponible', $request->quantite);

        return back()->with('success', 'Matériel sorti du stock avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MaterialSortie $materialSortie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MaterialSortie $materialSortie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MaterialSortie $materialSortie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MaterialSortie $materialSortie)
    {
        //
    }
}