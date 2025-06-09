<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmergencyController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\DispatchController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmergencyTypeController;



Route::get('/', function () {
    return view('welcome');
});
//Compañias
Route::resource('companies', CompanyController::class);
Route::post('companies/{company}/volunteers/import', [CompanyController::class, 'importVolunteers'])->name('companies.volunteers.import');
Route::get('companies/{company}/volunteers', [CompanyController::class, 'showVolunteers'])->name('companies.volunteers');

Route::resource('companies', CompanyController::class);

Route::get('companies/{company}/edit', [CompanyController::class, 'edit'])->name('companies.edit');
Route::put('companies/{company}', [CompanyController::class, 'update'])->name('companies.update');

//Voluntarios
Route::get('volunteers/create', [VolunteerController::class, 'create'])->name('volunteers.create');
Route::post('volunteers', [VolunteerController::class, 'store'])->name('volunteers.store');

Route::get('volunteers/{volunteer}/edit', [VolunteerController::class, 'edit'])->name('volunteers.edit');
Route::put('volunteers/{volunteer}', [VolunteerController::class, 'update'])->name('volunteers.update');
Route::delete('volunteers/{volunteer}', [VolunteerController::class, 'destroy'])->name('volunteers.destroy');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


//menu
Route::resource('emergencies', EmergencyController::class);
Route::post('emergency-types/seed', [EmergencyTypeController::class, 'seed'])->name('emergency-types.seed');
Route::get('/emergencies/{emergency}', [EmergencyController::class, 'show'])->name('emergencies.show');
Route::put('/emergencies/{emergency}/finalize', [EmergencyController::class, 'finalize'])->name('emergencies.finalize');
Route::delete('/emergencies/{emergency}', [EmergencyController::class, 'destroy'])
    ->name('emergencies.destroy');


Route::resource('units', UnitController::class);
Route::resource('dispatches', DispatchController::class);

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
    

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
