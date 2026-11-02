<?php

use App\Http\Controllers\Evaluacion\PortalEstudianteController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [PanelController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/', [PanelController::class, 'index'])->name('panel');
    Route::get('/mis-notas', [PortalEstudianteController::class, 'index'])
        ->middleware('rol:estudiante')
        ->name('mis-notas');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
