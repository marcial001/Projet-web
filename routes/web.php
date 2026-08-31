<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\ChefChantier\TaskController;
use App\Http\Controllers\ChefChantier\AbsenceController;
use App\Http\Controllers\ChefChantier\EvaluationController;
use App\Http\Controllers\ChefEquipe\LeaveController;
use App\Http\Controllers\Admin\LeaveController as AdminLeaveController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Admin\MaterialEntreeController;
use App\Http\Controllers\Admin\MaterialSortieController;

//accueil
Route::get('/', [HomeController::class, 'index']);

//registration
Route::get('registration', [RegisteredUserController::class, 'create']);
Route::post('registration', [RegisteredUserController::class, 'store']);

//Login in 
Route::get('login', [AuthenticatedSessionController::class, 'create']);
Route::post('login', [AuthenticatedSessionController::class, 'store']);

//Logout
Route::get('logout', [AuthenticatedSessionController::class, 'destroy']);
Route::post('logout', [AuthenticatedSessionController::class, 'destroy']);

//forgot password
Route::get('forgot-password', [PasswordResetLinkController::class, 'create']);
Route::post('forgot-password', [PasswordResetLinkController::class, 'store']);

//profile management
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//route reservée à l'administrateur
Route::middleware(['auth', 'role.admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('employees', App\Http\Controllers\EmployeeController::class);
    Route::resource('users', UserController::class);
    //Route::resource('/profile', ProfileController::class);
    Route::get('tasks', [TaskController::class, 'index']); // rôle : chef de chantier
    Route::get('absences', [AbsenceController::class, 'index']); // rôle : chef de chantier
    Route::get('evaluations', [EvaluationController::class, 'index']); // rôle : chef de chantier
    Route::get('/admin/absences', [ProfileController::class, 'consulterAbsences'])->name('admin.absences.index');
    Route::get('/admin/tasks', [ProfileController::class, 'consulterTasks'])->name('admin.tasks.index');
    Route::get('/admin/leaves', [ProfileController::class, 'consulterLeaves'])->name('admin.leaves.index');
    Route::get('/admin/leaves', [AdminLeaveController::class, 'index'])->name('admin.leaves.index');
    Route::post('/admin/leaves/{leave}/approve', [AdminLeaveController::class, 'approve'])->name('admin.leaves.approve');
    Route::post('/admin/leaves/{leave}/reject', [AdminLeaveController::class, 'reject'])->name('admin.leaves.reject');
});

// Routes réservées au chef de chantier
Route::middleware(['auth', 'role.chef_chantier'])->prefix('chef-chantier')->name('chef-chantier.')->group(function () {
    // Dashboard du chef de chantier
    Route::get('/dashboard', [\App\Http\Controllers\ChefChantier\DashboardController::class, 'index'])->name('dashboard');

    // Gestion des employés
    Route::get('/employees', [\App\Http\Controllers\ChefChantier\EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/employees/create', [\App\Http\Controllers\ChefChantier\EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/employees', [\App\Http\Controllers\ChefChantier\EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/employees/{employee}', [\App\Http\Controllers\ChefChantier\EmployeeController::class, 'show'])->name('employees.show');
    Route::get('/employees/{employee}/edit', [\App\Http\Controllers\ChefChantier\EmployeeController::class, 'edit'])->name('employees.edit');
    Route::put('/employees/{employee}', [\App\Http\Controllers\ChefChantier\EmployeeController::class, 'update'])->name('employees.update');
    Route::delete('/employees/{employee}', [\App\Http\Controllers\ChefChantier\EmployeeController::class, 'destroy'])->name('employees.destroy');

    // Affectation employé → chef d'équipe (optionnel)
    // Route::get('/employees/{employee}/assigner-chef-equipe', [\App\Http\Controllers\ChefChantier\EmployeeController::class, 'assignerChefEquipe'])->name('employees.assigner');
    // Route::put('/employees/{employee}/assigner-chef-equipe', [\App\Http\Controllers\ChefChantier\EmployeeController::class, 'sauvegarderChefEquipe']);

    // Gestion des tâches
    Route::resource('tasks', TaskController::class);

    // Gestion des absences
    Route::resource('absences', AbsenceController::class);

    // Gestion des évaluations
    Route::resource('evaluations', EvaluationController::class);

    // Gestion des sorties de matériels
    Route::get('/materiels/sorties', [MaterialSortieController::class, 'index'])->name('materiels.sorties.index');
    Route::get('/materiels/sorties/create', [MaterialSortieController::class, 'create'])->name('materiels.sorties.create');
    Route::post('/materiels/sorties', [MaterialSortieController::class, 'store'])->name('materiels.sorties.store');
});

// Routes réservées au chef d'équipe
Route::middleware(['auth', 'role.chef_equipe'])->prefix('chef-equipe')->name('chef-equipe.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\ChefEquipe\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/mon-equipe', [\App\Http\Controllers\ChefEquipe\DashboardController::class, 'monEquipe'])->name('mon-equipe');
    // Congés
    Route::resource('leaves', LeaveController::class);
    Route::post('/leaves/{leave}/approve', [LeaveController::class, 'approve'])->name('leaves.approve');
    Route::post('/leaves/{leave}/reject', [LeaveController::class, 'reject'])->name('leaves.reject');
});

// Routes réservées aux directeurs et chefs de projet
Route::middleware(['auth', 'role.directeurs'])->prefix('directeur')->name('directeur.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Directeur\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [\App\Http\Controllers\Directeur\DashboardController::class, 'users'])->name('users.index');
    Route::get('/employees', [\App\Http\Controllers\Directeur\DashboardController::class, 'employees'])->name('employees.index');
    Route::get('/tasks', [\App\Http\Controllers\Directeur\DashboardController::class, 'tasks'])->name('tasks.index');
    Route::get('/absences', [\App\Http\Controllers\Directeur\DashboardController::class, 'absences'])->name('absences.index');
    Route::get('/leaves', [\App\Http\Controllers\Directeur\DashboardController::class, 'leaves'])->name('leaves.index');
    Route::get('/evaluations', [\App\Http\Controllers\Directeur\DashboardController::class, 'evaluations'])->name('evaluations.index');
});

// Gestion des matériels (admin)
Route::middleware(['auth', 'role.admin'])->prefix('admin/materiels')->name('admin.materiels.')->group(function () {
    Route::get('/', [MaterialController::class, 'index'])->name('index');
    Route::get('/nouveau', [MaterialController::class, 'create'])->name('create');
    Route::post('/store', [MaterialController::class, 'store'])->name('store');

    // Entrées de matériel
    Route::get('/entrees', [MaterialEntreeController::class, 'index'])->name('entrees.index');
    Route::post('/entree', [MaterialEntreeController::class, 'store'])->name('entree.store');

    // Sorties de matériel
    Route::get('/sorties', [MaterialSortieController::class, 'index'])->name('sorties.index');
    Route::post('/sortie', [MaterialSortieController::class, 'store'])->name('sortie.store');
});

require __DIR__ . '/auth.php';