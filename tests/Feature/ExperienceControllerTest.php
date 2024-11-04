<?php

namespace Tests\Feature;

use App\Models\Experience;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExperienceControllerTest extends TestCase
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

    public function test_index_returns_experiences_with_successful_response()
    {
        Student::factory(5)->create();
        Experience::factory(5)->create();

        $response = $this->getJson('/api/experiences');

        $response->assertStatus(200)
            ->assertJsonStructure([
                [
                    'id', 'student_id', 'company'
                ]
            ]);
    }

    public function test_show_returns_experience_with_successful_response()
    {
        Student::factory(5)->create();
        $experience = Experience::factory()->create();
        $response   = $this->getJson("/api/experiences/$experience->id");

        $response->assertStatus(200)
            ->assertJsonFragment([
                'id'         => $experience->id,
                'student_id' => $experience->student_id,
                'company'    => $experience->company,
            ]);
    }

    public function test_show_returns_experience_with_unsuccessful_response()
    {
        Student::factory(5)->create();
        Experience::factory()->create();
        $response = $this->getJson("/api/experiences/999");
        $response->assertStatus(404);
    }

    public function test_store_create_new_experience_with_successful_response()
    {
        Student::factory(5)->create();
        $student_id = Student::query()->first()->id;
        $response   = $this->postJson('/api/experiences', [
            'student_id' => $student_id,
            'company'    => 'Company name',
        ]);

        $response->assertStatus(201)
            ->assertJsonFragment([
                'student_id' => $student_id,
                'company'    => 'Company name',
            ]);
    }

    public function test_store_create_new_experience_with_unsuccessful_response()
    {
        Student::factory(5)->create();
        $response = $this->postJson('/api/experiences', [
            'student_id' => '',
            'company'    => '',
        ]);
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['student_id', 'company']);
    }

    public function test_update_experience_with_successful_response()
    {
        Student::factory(5)->create();
        $experience = Experience::factory()->create();
        $response   = $this->putJson("/api/experiences/$experience->id", [
            'company' => 'Company name',
        ]);

        $response->assertStatus(202)
            ->assertJsonFragment([
                'company' => 'Company name',
            ]);
    }

    public function test_update_experience_with_unsuccessful_response()
    {
        Student::factory(5)->create();
        Experience::factory(5)->create();
        $experience = Experience::factory()->create();

        $response = $this->putJson("/api/experiences/$experience->id", [
            'student_id' => 'string',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['student_id']);
    }

    public function test_destroy_experience_with_successful_response()
    {
        Student::factory(5)->create();
        $experience = Experience::factory()->create();
        $response   = $this->deleteJson("/api/experiences/$experience->id");
        $response->assertStatus(202);
        $this->assertDatabaseMissing('experiences', [
            'id' => $experience->id,
        ]);
    }

    public function test_destroy_experience_with_unsuccessful_response()
    {
        Student::factory(5)->create();
        Experience::factory(5)->create();
        $response = $this->deleteJson("/api/experiences/999");
        $response->assertStatus(404);
    }
}
