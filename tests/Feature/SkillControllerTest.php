<?php

namespace Tests\Feature;

use App\Models\Skill;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SkillControllerTest extends TestCase
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

    public function test_index_returns_skills_with_successful_response()
    {
        Skill::factory(5)->create();

        $response = $this->getJson('/api/skills');

        $response->assertStatus(200)
            ->assertJsonStructure([
                [
                    'id', 'name'
                ]
            ]);
    }

    public function test_show_returns_skill_with_successful_response()
    {
        $skill  = Skill::factory()->create();
        $response = $this->getJson("/api/skills/$skill->id");

        $response->assertStatus(200)
            ->assertJsonFragment([
                'id'   => $skill->id,
                'name' => $skill->name,
            ]);
    }

    public function test_show_returns_skill_with_unsuccessful_response()
    {
        Skill::factory()->create();
        $response = $this->getJson("/api/categories/999");
        $response->assertStatus(404);
    }

    public function test_store_create_new_skill_with_successful_response()
    {
        $response = $this->postJson('/api/skills', [
            'name' => 'New skill name',
        ]);

        $response->assertStatus(201)
            ->assertJsonFragment([
                'name' => 'New skill name',
            ]);
    }

    public function test_store_create_new_skill_with_unsuccessful_response()
    {

        $response = $this->postJson('/api/skills', [
            'name' => '',
        ]);
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name']);
    }

    public function test_update_skill_with_successful_response()
    {
        $skill  = Skill::factory()->create();
        $response = $this->putJson("/api/skills/$skill->id", [
            'name' => 'New skill name',
        ]);

        $response->assertStatus(202)
            ->assertJsonFragment([
                'name' => 'New skill name',
            ]);
    }

    public function test_update_skill_with_unsuccessful_response()
    {
        Skill::factory(5)->create();
        $skill = Skill::factory()->create();

        $response = $this->putJson("/api/skills/$skill->id", [
            'name' => $skill->name,
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name']);
    }

    public function test_destroy_skill_with_successful_response()
    {
        $skill  = Skill::factory()->create();
        $response = $this->deleteJson("/api/skills/$skill->id");
        $response->assertStatus(202);
        $this->assertDatabaseMissing('skills', [
            'id' => $skill->id,
        ]);
    }

    public function test_destroy_skill_with_unsuccessful_response()
    {
        Skill::factory(5)->create();
        $response = $this->deleteJson("/api/skills/999");
        $response->assertStatus(404);
    }
}
