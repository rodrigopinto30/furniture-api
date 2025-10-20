<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Attributes\Test;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    protected function getToken(): string
    {
        $user = User::factory()->create([
            'password' => Hash::make('password')
        ]);

        return JWTAuth::fromUser($user);
    }

    #[Test]
    public function it_can_list_all_categories()
    {
        Category::factory()->count(3)->create();

        $token = $this->getToken();

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
            'Accept' => 'application/json'
        ])->getJson('/api/categories');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    #[Test]
    public function it_can_create_a_category()
    {
        $token = $this->getToken();

        $payload = [
            'name' => 'New Category',
            'description' => 'Test description'
        ];

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
            'Accept' => 'application/json'
        ])->postJson('/api/categories', $payload);

        $response->assertStatus(201)
            ->assertJsonFragment(['name' => 'New Category']);
    }

    #[Test]
    public function it_can_show_a_category()
    {
        $token = $this->getToken();

        $category = Category::factory()->create();

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
            'Accept' => 'application/json'
        ])->getJson("/api/categories/{$category->id}");

        $response->assertStatus(200)
            ->assertJsonFragment(['id' => $category->id]);
    }

    #[Test]
    public function it_can_update_a_category()
    {
        $token = $this->getToken();

        $category = Category::factory()->create();

        $payload = [
            'name' => 'Updated Category',
            'description' => 'Updated description'
        ];

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
            'Accept' => 'application/json'
        ])->putJson("/api/categories/{$category->id}", $payload);

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Updated Category']);
    }

    #[Test]
    public function it_can_delete_a_category()
    {
        $token = $this->getToken();

        $category = Category::factory()->create();

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
            'Accept' => 'application/json'
        ])->deleteJson("/api/categories/{$category->id}");

        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'Categoría eliminada correctamente.']);
    }
}
