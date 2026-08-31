<?php

namespace App\Http\Controllers\ChefChantier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Absence;
use App\Models\Evaluation;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
    {
        $tasks = Task::where('attribue_par', Auth::user()->id)->latest()->take(5)->get();
        $absencesToday = Absence::where('enregistré_par', Auth::user()->id)->whereDate('date', now())->count();
        $evaluations = Evaluation::where('evalué_par', Auth::user()->id)->latest()->take(5)->get();
        $employees = Employee::where('chef_chantier_id', Auth::user()->id)->get();

        return view('chef-chantier.dashboard', compact('tasks', 'absencesToday', 'evaluations', 'employees'));
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
