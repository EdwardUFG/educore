<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Administracion\CarreraController;
use App\Http\Controllers\Administracion\CicloController;
use App\Http\Controllers\Administracion\UsuarioController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')
    ->prefix('administracion')
    ->name('administracion.')
    ->group(function () {

        Route::resource('carreras', CarreraController::class)
            ->except(['show']);
            
        Route::resource('ciclos', CicloController::class)
            ->except(['show']);

        Route::resource('usuarios', UsuarioController::class)
        ->except(['show']);
    });

require __DIR__.'/auth.php';
