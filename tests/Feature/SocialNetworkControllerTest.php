<?php

namespace Tests\Feature;

use App\Models\SocialNetwork;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SocialNetworkControllerTest extends TestCase
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

    public function test_index_returns_networks_with_successful_response()
    {
        SocialNetwork::factory(5)->create();

        $response = $this->getJson('/api/networks');

        $response->assertStatus(200)
            ->assertJsonStructure([
                [
                    'id', 'name', 'url', 'created_at'
                ]
            ]);
    }

    public function test_show_returns_network_with_successful_response()
    {
        $network  = SocialNetwork::factory()->create();
        $response = $this->getJson("/api/networks/$network->id");

        $response->assertStatus(200)
            ->assertJsonFragment([
                'id'   => $network->id,
                'name' => $network->name,
            ]);
    }

    public function test_show_returns_network_with_unsuccessful_response()
    {
        SocialNetwork::factory()->create();
        $response = $this->getJson("/api/categories/999");
        $response->assertStatus(404);
    }

    public function test_store_create_new_network_with_successful_response()
    {
        $response = $this->postJson('/api/networks', [
            'name' => 'New network name',
            'url'  => 'http://network.url',
        ]);

        $response->assertStatus(201)
            ->assertJsonFragment([
                'name' => 'New network name',
                'url'  => 'http://network.url',
            ]);
    }

    public function test_store_create_new_network_with_unsuccessful_response()
    {

        $response = $this->postJson('/api/networks', [
            'name' => '',
            'url'  => '',
        ]);
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'url']);
    }

    public function test_update_network_with_successful_response()
    {
        $network  = SocialNetwork::factory()->create();
        $response = $this->putJson("/api/networks/$network->id", [
            'name' => 'New network name',
        ]);

        $response->assertStatus(202)
            ->assertJsonFragment([
                'name' => 'New network name',
            ]);
    }

    public function test_update_network_with_unsuccessful_response()
    {
        SocialNetwork::factory(5)->create();
        $network = SocialNetwork::factory()->create();

        $response = $this->putJson("/api/networks/$network->id", [
            'name' => $network->name,
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name']);
    }

    public function test_destroy_network_with_successful_response()
    {
        $network  = SocialNetwork::factory()->create();
        $response = $this->deleteJson("/api/networks/$network->id");
        $response->assertStatus(202);
        $this->assertDatabaseMissing('social_networks', [
            'id' => $network->id,
        ]);
    }

    public function test_destroy_network_with_unsuccessful_response()
    {
        SocialNetwork::factory(5)->create();
        $response = $this->deleteJson("/api/networks/999");
        $response->assertStatus(404);
    }
}
