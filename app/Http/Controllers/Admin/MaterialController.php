<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
    {
        $materials = Material::all();
        return view('admin.materiels.index', compact('materials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $materials = Material::all();
        return view('admin.materiels.create', compact('materials'));
    }

    /**
     * Store a newly created resource in storage.
     */
     public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:191',
            'type' => 'required|string|max:191',
            'quantite_disponible' => 'required|integer|min:0',
            'localisation' => 'nullable|string',
        ]);

        Material::create($request->all());
        return redirect()->route('admin.materiels.index')->with('success', 'Matériel ajouté.');
    }

    /**
     * Display the specified resource.
     */
   public function show(Material $materiel)
    {
        return view('admin.materiels.show', compact('materiel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Material $material)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Material $material)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Material $material)
    {
        //
    }
}
