<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Carrera;
use App\Models\Ciclo;
use App\Models\Curso;
use App\Models\Asignacion;
use App\Models\Nota;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Crear Carreras Universitarias
        $ingSistemas = Carrera::create([
            'codigo' => 'ING-CC',
            'nombre' => 'Ingeniería en Ciencias de la Computación',
            'facultad' => 'Facultad de Ingeniería y Sistemas',
            'activa' => true,
        ]);

        $licDiseno = Carrera::create([
            'codigo' => 'LIC-DG',
            'nombre' => 'Licenciatura en Diseño Gráfico Web',
            'facultad' => 'Facultad de Arte y Diseño',
            'activa' => true,
        ]);

        // 2. Crear Ciclo Activo
        $cicloActual = Ciclo::create([
            'nombre' => 'Ciclo 02-2026',
            'fecha_inicio' => '2026-07-15',
            'fecha_fin' => '2026-12-05',
            'activo' => true,
        ]);

        // 3. Crear Usuarios (1 Admin, 2 Docentes, 3 Estudiantes)
        User::create([
            'name' => 'Administrador EduCore',
            'email' => 'admin@educore.edu.sv',
            'carnet' => 'ADM001',
            'rol' => 'admin',
            'password' => Hash::make('password123'),
        ]);

        $docente1 = User::create([
            'name' => 'Ing. Roberto Martínez',
            'email' => 'roberto.martinez@educore.edu.sv',
            'carnet' => 'DOC101',
            'rol' => 'docente',
            'password' => Hash::make('password123'),
        ]);

        $docente2 = User::create([
            'name' => 'Lic. Karla Hernández',
            'email' => 'karla.hernandez@educore.edu.sv',
            'carnet' => 'DOC102',
            'rol' => 'docente',
            'password' => Hash::make('password123'),
        ]);

        $est1 = User::create([
            'name' => 'Edward Fernando Pérez',
            'email' => 'edward@educore.edu.sv',
            'carnet' => 'PG101524',
            'rol' => 'estudiante',
            'carrera_id' => $ingSistemas->id,
            'password' => Hash::make('password123'),
        ]);

        $est2 = User::create([
            'name' => 'Sofía Alejandra Gómez',
            'email' => 'sofia@educore.edu.sv',
            'carnet' => 'GA102024',
            'rol' => 'estudiante',
            'carrera_id' => $ingSistemas->id,
            'password' => Hash::make('password123'),
        ]);

        $est3 = User::create([
            'name' => 'Marcela Beatriz Rivas',
            'email' => 'marcela@educore.edu.sv',
            'carnet' => 'RB103024',
            'rol' => 'estudiante',
            'carrera_id' => $licDiseno->id,
            'password' => Hash::make('password123'),
        ]);

        // 4. Crear Cursos (Materias)
        $cursoWeb = Curso::create([
            'codigo' => 'DPW-01',
            'nombre' => 'Desarrollo de Aplicaciones Web con Laravel',
            'descripcion' => 'Arquitectura MVC, Eloquent ORM y diseño con Blade.',
            'carrera_id' => $ingSistemas->id,
            'ciclo_id' => $cicloActual->id,
            'docente_id' => $docente1->id,
        ]);

        $cursoBD = Curso::create([
            'codigo' => 'BDD-02',
            'nombre' => 'Administración de Bases de Datos Relacionales',
            'descripcion' => 'Modelado entidad-relación, transacciones y optimización SQL.',
            'carrera_id' => $ingSistemas->id,
            'ciclo_id' => $cicloActual->id,
            'docente_id' => $docente2->id,
        ]);

        // 5. Inscribir Estudiantes en los Cursos
        $cursoWeb->estudiantes()->attach([$est1->id, $est2->id, $est3->id]);
        $cursoBD->estudiantes()->attach([$est1->id, $est2->id]);

        // 6. Crear Asignaciones (Evaluaciones) para el curso Web
        $lab1 = Asignacion::create([
            'curso_id' => $cursoWeb->id,
            'titulo' => 'Laboratorio 1: Configuración de Entorno y Rutas',
            'descripcion' => 'Instalación de Laragon y estructura inicial MVC.',
            'porcentaje' => 30,
            'fecha_entrega' => '2026-09-15',
        ]);

        $parcial1 = Asignacion::create([
            'curso_id' => $cursoWeb->id,
            'titulo' => 'Parcial 1: Modelos y Migraciones Eloquent',
            'descripcion' => 'Evaluación práctica de persistencia en MySQL.',
            'porcentaje' => 35,
            'fecha_entrega' => '2026-10-10',
        ]);

        $proyecto = Asignacion::create([
            'curso_id' => $cursoWeb->id,
            'titulo' => 'Proyecto Final: Sistema EduCore',
            'descripcion' => 'Defensa grupal del sistema de gestión académica.',
            'porcentaje' => 35,
            'fecha_entrega' => '2026-10-30',
        ]);

        // 7. Registrar Notas de prueba
        Nota::create(['asignacion_id' => $lab1->id, 'estudiante_id' => $est1->id, 'valor' => 9.50, 'observacion' => 'Excelente estructura']);
        Nota::create(['asignacion_id' => $parcial1->id, 'estudiante_id' => $est1->id, 'valor' => 9.00, 'observacion' => 'Muy buen dominio de Eloquent']);
        Nota::create(['asignacion_id' => $lab1->id, 'estudiante_id' => $est2->id, 'valor' => 8.80, 'observacion' => 'Buen trabajo']);
        Nota::create(['asignacion_id' => $parcial1->id, 'estudiante_id' => $est2->id, 'valor' => 8.50, 'observacion' => 'Aprobado']);
    }
}