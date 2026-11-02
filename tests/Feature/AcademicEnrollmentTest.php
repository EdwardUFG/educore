<?php

namespace Tests\Feature;

use App\Models\Carrera;
use App\Models\Ciclo;
use App\Models\Curso;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AcademicEnrollmentTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_sees_available_courses_and_can_enroll_themself(): void
    {
        $student = User::factory()->create(['rol' => 'estudiante']);
        $curso = $this->createCourse(User::factory()->create(['rol' => 'docente']));

        $this->actingAs($student)
            ->get(route('dashboard'))
            ->assertOk()
            ->assertSee('Materias')
            ->assertSee('Notas');

        $this->actingAs($student)
            ->get(route('academico.inscripciones.index'))
            ->assertOk()
            ->assertSee($curso->nombre);

        $this->actingAs($student)
            ->post(route('academico.inscripciones.store'), ['curso_id' => $curso->id])
            ->assertRedirect(route('academico.inscripciones.index'));

        $this->assertDatabaseHas('curso_user', [
            'curso_id' => $curso->id,
            'user_id' => $student->id,
        ]);
    }

    public function test_student_without_enrollments_sees_a_prompt_on_their_notes_page(): void
    {
        $student = User::factory()->create(['rol' => 'estudiante']);

        $this->actingAs($student)
            ->get(route('mis-notas'))
            ->assertOk()
            ->assertSee('Inscribe materias primero para consultar tus notas y actividades.')
            ->assertSee('Inscribir Materias');
    }

    public function test_teacher_only_sees_courses_assigned_to_their_user_id(): void
    {
        $teacher = User::factory()->create(['rol' => 'docente']);
        $otherTeacher = User::factory()->create(['rol' => 'docente']);
        $assignedCourse = $this->createCourse($teacher, 'WEB-01');
        $otherCourse = $this->createCourse($otherTeacher, 'DB-01');

        $this->actingAs($teacher)
            ->get(route('dashboard'))
            ->assertOk()
            ->assertSee('Materias')
            ->assertSee('Asignación de Tareas')
            ->assertSee('Notas')
            ->assertViewHas('cursos', fn ($cursos): bool => $cursos->modelKeys() === [$assignedCourse->id]);
    }

    public function test_teacher_cannot_access_enrollment_or_course_management_routes(): void
    {
        $teacher = User::factory()->create(['rol' => 'docente']);
        $course = $this->createCourse($teacher);

        $this->actingAs($teacher)
            ->get(route('academico.inscripciones.index'))
            ->assertForbidden();

        $this->actingAs($teacher)
            ->get(route('academico.cursos.create'))
            ->assertForbidden();

        $this->actingAs($teacher)
            ->post(route('academico.inscripciones.store'), ['curso_id' => $course->id])
            ->assertForbidden();

        $this->assertDatabaseMissing('curso_user', [
            'curso_id' => $course->id,
            'user_id' => $teacher->id,
        ]);
    }

    public function test_admin_navigation_routes_render_all_administration_links(): void
    {
        $admin = User::factory()->create(['rol' => 'admin']);

        $this->actingAs($admin)
            ->get(route('dashboard'))
            ->assertOk()
            ->assertSee('Gestión de Usuarios')
            ->assertSee('Asignar Clases')
            ->assertSee('Crear Materias')
            ->assertSee('Asignación de Tareas')
            ->assertSee('Notas');

        $this->actingAs($admin)->get(route('admin.usuarios.index'))->assertOk();
        $this->actingAs($admin)->get(route('academico.cursos.create'))->assertOk();
        $this->actingAs($admin)->get(route('notas.index'))->assertOk();
        $this->actingAs($admin)->get(route('mis-notas'))->assertOk();
    }

    public function test_admin_can_create_a_course_assigned_to_a_teacher(): void
    {
        $admin = User::factory()->create(['rol' => 'admin']);
        $teacher = User::factory()->create(['rol' => 'docente']);
        $existingCourse = $this->createCourse($teacher);

        $response = $this->actingAs($admin)->post(route('academico.cursos.store'), [
            'codigo' => 'NEW-01',
            'nombre' => 'Nueva materia',
            'carrera_id' => $existingCourse->carrera_id,
            'ciclo_id' => $existingCourse->ciclo_id,
            'docente_id' => $teacher->id,
        ]);

        $course = Curso::query()->where('codigo', 'NEW-01')->firstOrFail();

        $response->assertRedirect(route('academico.cursos.show', $course));
        $this->assertDatabaseHas('cursos', [
            'id' => $course->id,
            'docente_id' => $teacher->id,
        ]);
    }

    private function createCourse(User $teacher, string $code = 'MAT-01'): Curso
    {
        $carrera = Carrera::query()->create([
            'codigo' => 'CAR-'.$code,
            'nombre' => 'Ingeniería',
            'facultad' => 'Ingeniería',
            'activa' => true,
        ]);

        $ciclo = Ciclo::query()->create([
            'nombre' => 'Ciclo 01',
            'fecha_inicio' => '2026-01-01',
            'fecha_fin' => '2026-06-30',
            'activo' => true,
        ]);

        return Curso::query()->create([
            'codigo' => $code,
            'nombre' => 'Materia '.$code,
            'carrera_id' => $carrera->id,
            'ciclo_id' => $ciclo->id,
            'docente_id' => $teacher->id,
        ]);
    }
}
