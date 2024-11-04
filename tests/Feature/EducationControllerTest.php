<?php

namespace Tests\Feature;

use App\Models\Education;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EducationControllerTest extends TestCase
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

    public function test_index_returns_educations_with_successful_response()
    {
        Student::factory(5)->create();
        Education::factory(5)->create();

        $response = $this->getJson('/api/educations');

        $response->assertStatus(200)
            ->assertJsonStructure([
                [
                    'id', 'student_id', 'name'
                ]
            ]);
    }

    public function test_show_returns_education_with_successful_response()
    {
        Student::factory(5)->create();
        $education = Education::factory()->create();
        $response   = $this->getJson("/api/educations/$education->id");

        $response->assertStatus(200)
            ->assertJsonFragment([
                'id'         => $education->id,
                'student_id' => $education->student_id,
                'name'    => $education->name,
            ]);
    }

    public function test_show_returns_education_with_unsuccessful_response()
    {
        Student::factory(5)->create();
        Education::factory()->create();
        $response = $this->getJson("/api/educations/999");
        $response->assertStatus(404);
    }

    public function test_store_create_new_education_with_successful_response()
    {
        Student::factory(5)->create();
        $student_id = Student::query()->first()->id;
        $response   = $this->postJson('/api/educations', [
            'student_id' => $student_id,
            'name'    => 'Education name',
        ]);

        $response->assertStatus(201)
            ->assertJsonFragment([
                'student_id' => $student_id,
                'name'    => 'Education name',
            ]);
    }

    public function test_store_create_new_education_with_unsuccessful_response()
    {
        Student::factory(5)->create();
        $response = $this->postJson('/api/educations', [
            'student_id' => '',
            'name'    => '',
        ]);
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['student_id', 'name']);
    }

    public function test_update_education_with_successful_response()
    {
        Student::factory(5)->create();
        $education = Education::factory()->create();
        $response   = $this->putJson("/api/educations/$education->id", [
            'name' => 'Education name',
        ]);

        $response->assertStatus(202)
            ->assertJsonFragment([
                'name' => 'Education name',
            ]);
    }

    public function test_update_education_with_unsuccessful_response()
    {
        Student::factory(5)->create();
        Education::factory(5)->create();
        $education = Education::factory()->create();

        $response = $this->putJson("/api/educations/$education->id", [
            'student_id' => 'string',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['student_id']);
    }

    public function test_destroy_education_with_successful_response()
    {
        Student::factory(5)->create();
        $education = Education::factory()->create();
        $response   = $this->deleteJson("/api/educations/$education->id");
        $response->assertStatus(202);
        $this->assertDatabaseMissing('education', [
            'id' => $education->id,
        ]);
    }

    public function test_destroy_education_with_unsuccessful_response()
    {
        Student::factory(5)->create();
        Education::factory(5)->create();
        $response = $this->deleteJson("/api/educations/999");
        $response->assertStatus(404);
    }
}
