<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardNavigationTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_can_open_notes_and_sees_the_navigation_link(): void
    {
        $student = User::factory()->create(['rol' => 'estudiante']);

        $response = $this->actingAs($student)->get(route('mis-notas'));

        $response->assertOk();
        $response->assertSee('Notas');
    }

    public function test_non_student_roles_do_not_see_the_notes_link(): void
    {
        foreach (['admin', 'docente'] as $role) {
            $user = User::factory()->create(['rol' => $role]);

            $response = $this->actingAs($user)->get(route('dashboard'));

            $response->assertOk();
            $response->assertDontSee('Mis Notas');
        }
    }

    public function test_teacher_cannot_open_the_notes_module(): void
    {
        $teacher = User::factory()->create(['rol' => 'docente']);

        $response = $this->actingAs($teacher)->get(route('mis-notas'));

        $response->assertForbidden();
    }
}
