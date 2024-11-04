<?php

namespace Tests\Feature;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_index_returns_students_with_successful_response()
    {
        Student::factory(5)->create();

        $response = $this->getJson('/api/students');

        $response->assertStatus(200)
            ->assertJsonStructure([
                [
                    'id', 'nt_id', 'first_name', 'last_name', 'middle_name',
                    'gender', 'date_of_birth', 'phone', 'email', 'bio', 'image', 'created_at'
                ]
            ]);
    }

    public function test_show_returns_student_with_successful_response()
    {
        $student  = Student::factory()->create();
        $response = $this->getJson("/api/students/$student->id");

        $response->assertStatus(200)
            ->assertJsonFragment([
                'id'          => $student->id,
                'nt_id'       => $student->nt_id,
                'first_name'  => $student->first_name,
                'last_name'   => $student->last_name,
                'middle_name' => $student->middle_name,
            ]);
    }

    public function test_show_returns_student_with_unsuccessful_response()
    {
        Student::factory()->create();
        $response = $this->getJson("/api/categories/999");
        $response->assertStatus(404);
    }

    public function test_store_create_new_student_with_successful_response()
    {
        $response = $this->postJson('/api/students', [
            'first_name' => 'New student first name',
            'last_name'  => 'New student last name'
        ]);

        $response->assertStatus(201)
            ->assertJsonFragment([
                'first_name' => 'New student first name',
                'last_name'  => 'New student last name'
            ]);
    }

    public function test_store_create_new_student_with_unsuccessful_response()
    {

        $response = $this->postJson('/api/students', [
            'first_name' => '',
            'last_name'  => ''
        ]);
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['first_name', 'last_name']);
    }

    public function test_update_student_with_successful_response()
    {
        $student  = Student::factory()->create();
        $response = $this->putJson("/api/students/$student->id", [
            'first_name' => 'New student first name',
        ]);

        $response->assertStatus(202)
            ->assertJsonFragment([
                'first_name' => 'New student first name',
            ]);
    }

    public function test_update_student_with_unsuccessful_response()
    {
        Student::factory(5)->create();
        $student = Student::factory()->create();

        $response = $this->putJson("/api/students/$student->id", [
            'nt_id' => $student->nt_id,
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['nt_id']);
    }

    public function test_destroy_student_with_successful_response()
    {
        $student  = Student::factory()->create();
        $response = $this->deleteJson("/api/students/$student->id");
        $response->assertStatus(202);
        $this->assertDatabaseMissing('students', [
            'id' => $student->id,
        ]);
    }

    public function test_destroy_student_with_unsuccessful_response()
    {
        Student::factory(5)->create();
        $response = $this->deleteJson("/api/students/999");
        $response->assertStatus(404);
    }
}
