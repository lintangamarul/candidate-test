<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BuildingPartTypeController;
use App\Http\Controllers\BuildingPartController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\MaterialController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard', [
        'projectsCount' => \App\Models\Project::count(),
        'buildingPartTypesCount' => \App\Models\BuildingPartType::count(),
        'materialsCount' => \App\Models\Material::count(),
        'suppliersCount' => \App\Models\Supplier::count(),
        'buildingPartsCount' => \App\Models\BuildingPart::count(),
        'recentProjects' => \App\Models\Project::latest()->take(5)->get(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Application routes
    Route::resource('projects', ProjectController::class);
    
    Route::resource('projects.building-parts', BuildingPartController::class)->parameters([
        'projects' => 'project',
        'building-parts' => 'buildingPart'
    ]);
    
    Route::resource('building-part-types', BuildingPartTypeController::class);
    
    Route::resource('materials', MaterialController::class);
    
    Route::resource('suppliers', SupplierController::class);
});

require __DIR__.'/auth.php';