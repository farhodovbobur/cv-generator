<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectControllerTest extends TestCase
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

    public function test_index_returns_projects_with_successful_response()
    {
        Student::factory(5)->create();
        Project::factory(5)->create();

        $response = $this->getJson('/api/projects');

        $response->assertStatus(200)
            ->assertJsonStructure([
                [
                    'id', 'student_id', 'name'
                ]
            ]);
    }

    public function test_show_returns_project_with_successful_response()
    {
        Student::factory(5)->create();
        $project  = Project::factory()->create();
        $response = $this->getJson("/api/projects/$project->id");

        $response->assertStatus(200)
            ->assertJsonFragment([
                'id'         => $project->id,
                'student_id' => $project->student_id,
                'name'       => $project->name,
            ]);
    }

    public function test_show_returns_project_with_unsuccessful_response()
    {
        Student::factory(5)->create();
        Project::factory()->create();
        $response = $this->getJson("/api/projects/999");
        $response->assertStatus(404);
    }

    public function test_store_create_new_project_with_successful_response()
    {
        Student::factory(5)->create();
        $student_id = Student::query()->first()->id;
        $response   = $this->postJson('/api/projects', [
            'student_id' => $student_id,
            'name'       => 'New project name',
        ]);

        $response->assertStatus(201)
            ->assertJsonFragment([
                'student_id' => $student_id,
                'name'       => 'New project name',
            ]);
    }

    public function test_store_create_new_project_with_unsuccessful_response()
    {
        Student::factory(5)->create();
        $response = $this->postJson('/api/projects', [
            'student_id' => '',
            'name'       => '',
        ]);
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['student_id', 'name']);
    }

    public function test_update_project_with_successful_response()
    {
        Student::factory(5)->create();
        $project  = Project::factory()->create();
        $response = $this->putJson("/api/projects/$project->id", [
            'name' => 'New project name',
        ]);

        $response->assertStatus(202)
            ->assertJsonFragment([
                'name' => 'New project name',
            ]);
    }

    public function test_update_project_with_unsuccessful_response()
    {
        Student::factory(5)->create();
        Project::factory(5)->create();
        $project = Project::factory()->create();

        $response = $this->putJson("/api/projects/$project->id", [
            'student_id' => 'string',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['student_id']);
    }

    public function test_destroy_project_with_successful_response()
    {
        Student::factory(5)->create();
        $project  = Project::factory()->create();
        $response = $this->deleteJson("/api/projects/$project->id");
        $response->assertStatus(202);
        $this->assertDatabaseMissing('projects', [
            'id' => $project->id,
        ]);
    }

    public function test_destroy_project_with_unsuccessful_response()
    {
        Student::factory(5)->create();
        Project::factory(5)->create();
        $response = $this->deleteJson("/api/projects/999");
        $response->assertStatus(404);
    }
}
