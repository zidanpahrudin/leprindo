<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        // User yang akan digunakan untuk auth
        $this->user = User::factory()->create();
    }

    /** @test */
    public function authenticated_user_can_view_users_list()
    {
        $this->actingAs($this->user)
             ->getJson('/dashboard/users')
             ->assertStatus(200);
    }

    /** @test */
    public function authenticated_user_can_view_single_user()
    {
        $otherUser = User::factory()->create();

        $this->actingAs($this->user)
             ->getJson("/dashboard/users/{$otherUser->id}")
             ->assertStatus(200)
             ->assertJsonFragment([
                 'id' => $otherUser->id,
             ]);
    }

    /** @test */
    public function authenticated_user_can_create_user()
    {
        $payload = [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => 'password123',
        ];

        $this->actingAs($this->user)
             ->postJson('/dashboard/users', $payload)
             ->assertStatus(201)
             ->assertJsonFragment([
                 'email' => 'testuser@example.com',
             ]);

        $this->assertDatabaseHas('users', [
            'email' => 'testuser@example.com',
        ]);
    }

    /** @test */
    public function authenticated_user_can_update_user()
    {
        $otherUser = User::factory()->create();

        $payload = ['name' => 'Updated Name'];

        $this->actingAs($this->user)
             ->putJson("/dashboard/users/{$otherUser->id}", $payload)
             ->assertStatus(200)
             ->assertJsonFragment(['name' => 'Updated Name']);

        $this->assertDatabaseHas('users', ['id' => $otherUser->id, 'name' => 'Updated Name']);
    }

    /** @test */
    public function authenticated_user_can_delete_user()
    {
        $otherUser = User::factory()->create();

        $this->actingAs($this->user)
             ->deleteJson("/dashboard/users/{$otherUser->id}")
             ->assertStatus(204);

        $this->assertDatabaseMissing('users', ['id' => $otherUser->id]);
    }

    /** @test */
    public function guest_cannot_access_users_routes()
    {
        $this->getJson('/dashboard/users')->assertStatus(401);
    }
}
