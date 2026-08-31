<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    public function index()
    {
        $leaves = Leave::with('employee')->get();
        return view('admin.leaves.index', compact('leaves'));
    }

    public function approve(Leave $leave)
    {
        $leave->update(['statut' => 'accepté', 'approuve_par' => Auth::user()->id]);
        return back()->with('success', 'Congé approuvé par l\'admin.');
    }

    public function reject(Leave $leave)
    {
        $leave->update(['statut' => 'refusé', 'approuve_par' => Auth::user()->id]);
        return back()->with('success', 'Congé refusé par l\'admin.');
    }
}