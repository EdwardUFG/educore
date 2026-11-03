
<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Academico\CursoController;
use App\Http\Controllers\Academico\InscripcionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Administracion\CarreraController;
use App\Http\Controllers\Administracion\CicloController;
use App\Http\Controllers\Administracion\UsuarioController;

// Página principal
Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas para usuarios autenticados
Route::middleware('auth')->group(function () {

    // Perfil del usuario
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    // MODULO 3: Gestión de cursos (CRUD)
    Route::resource(
        'academico/cursos',
        CursoController::class
    )->names('academico.cursos');

    // MODULO 3: Gestión de inscripciones

    // Consultar inscripciones
    Route::get(
        'academico/inscripciones',
        [InscripcionController::class, 'index']
    )->name('academico.inscripciones.index');

    // Inscribir estudiante en un curso
    Route::post(
        'academico/inscripciones',
        [InscripcionController::class, 'store']
    )->name('academico.inscripciones.store');

    // Retirar estudiante de un curso
    Route::delete(
        'academico/inscripciones/{curso}/{estudiante}',
        [InscripcionController::class, 'destroy']
    )->name('academico.inscripciones.destroy');
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

// Rutas de autenticación de Laravel Breeze
require __DIR__.'/auth.php';
