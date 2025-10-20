<?php

namespace Tests\Feature;

use App\Models\Furniture;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Tymon\JWTAuth\Facades\JWTAuth;

class FurnitureTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate');
    }

    protected function getToken(): string
    {
        $user = User::factory()->create([
            'password' => Hash::make('password')
        ]);

        return JWTAuth::fromUser($user);
    }

    #[Test]
    public function it_can_list_all_furnitures()
    {

        Furniture::factory()->count(3)->create();

        $token = $this->getToken();

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
            'Accept' => 'application/json'
        ])->getJson('/api/furniture');

        $response->assertStatus(200)->assertJsonCount(3, 'data');
    }

    #[Test]
    public function it_can_create_a_furniture()
    {

        $token = $this->getToken();

        $payload = [
            'name' => 'New Furniture',
            'description' => 'Test description',
            'price' => 3,
            'stock' => 2
        ];

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
            'Accept' => 'Application/json',
        ])->postJson('/api/furniture', $payload);

        $response->assertStatus(201)->assertJsonFragment(['name' => 'New Furniture']);
    }

    #[Test]
    public function it_can_show_a_furniture()
    {

        $token = $this->getToken();

        $furniture = Furniture::factory()->create();

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
            'Accept' => 'application/json'
        ])->getJson("/api/furniture/{$furniture->id}");

        $response->assertStatus(200)
            ->assertJsonFragment(['id' => $furniture->id]);
    }

    #[Test]
    public function it_can_update_a_furniture()
    {

        $token = $this->getToken();

        $furniture = Furniture::factory()->create();

        $payload = [
            'description' => 'Updated Furniture'
        ];

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
            'Accept' => "application/json"
        ])->putJson("/api/furniture/{$furniture->id}", $payload);

        $response->assertStatus(200)
            ->assertJsonFragment(['description' => 'Updated Furniture']);
    }

    #[Test]
    public function it_can_delete_a_furniture()
    {

        $token = $this->getToken();

        $furniture = Furniture::factory()->create();

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
            'Accept' => 'application/json'
        ])->deleteJson("/api/furniture/{$furniture->id}");

        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'Mueble eliminado correctamente.']);
    }
}
