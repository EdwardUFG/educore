<?php

use App\Http\Controllers\Academico\CursoController;
use App\Http\Controllers\Academico\InscripcionController;
use App\Http\Controllers\Administracion\UsuarioController;
use App\Http\Controllers\Evaluacion\NotaController;
use App\Http\Controllers\Evaluacion\PortalEstudianteController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [PanelController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/', [PanelController::class, 'index'])->name('panel');
    Route::get('/mis-notas', [PortalEstudianteController::class, 'index'])
        ->middleware('rol:estudiante,admin')
        ->name('mis-notas');

    Route::middleware('rol:admin')->group(function () {
        Route::resource('academico/cursos', CursoController::class)
            ->names('academico.cursos');

        Route::get('/admin/usuarios', [UsuarioController::class, 'index'])
            ->name('admin.usuarios.index');

        Route::get('/notas', [NotaController::class, 'index'])
            ->name('notas.index');
    });

    Route::prefix('academico/inscripciones')
        ->name('academico.inscripciones.')
        ->group(function () {
            Route::get('/', [InscripcionController::class, 'index'])
                ->middleware('rol:admin,estudiante')
                ->name('index');

            Route::post('/', [InscripcionController::class, 'store'])
                ->middleware('rol:admin,estudiante')
                ->name('store');

            Route::delete('/{curso}/{estudiante}', [InscripcionController::class, 'destroy'])
                ->middleware('rol:admin')
                ->name('destroy');
        });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
