<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MaterialEntree;
use Illuminate\Http\Request;
use App\Models\Material;


class MaterialEntreeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     
   public function index() {
    $entrees = MaterialEntree::with('material')->get();
    return view('admin.materiels.entrees.index', compact('entrees'));
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
        $request->validate([
            'material_id' => 'required|exists:materials,id',
            'quantite' => 'required|integer|min:1',
            'date_entree' => 'required|date',
            'fournisseur' => 'required|string',
        ]);

        $entree = MaterialEntree::create($request->all());

        // Mettre à jour la quantité dispo dans le stock
        $material = Material::find($request->material_id);
        $material->increment('quantite_disponible', $request->quantite);

        return back()->with('success', 'Entrée enregistrée et stock mis à jour.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MaterialEntree $materialEntree)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MaterialEntree $materialEntree)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MaterialEntree $materialEntree)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MaterialEntree $materialEntree)
    {
        //
    }
}
