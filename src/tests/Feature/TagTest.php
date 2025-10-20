<?php

namespace Tests\Feature;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Tymon\JWTAuth\Facades\JWTAuth;

class TagTest extends TestCase
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
    public function it_can_list_all_tags(): void
    {

        Tag::factory(3)->create();

        $token = $this->getToken();

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
            'Accept' => 'application/json'
        ])->getJson('/api/tags');

        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'Listado de etiquetas obtenido correctamente.']);
    }

    #[Test]
    public function it_can_create_a_tag(): void
    {

        $token = $this->getToken();

        $payload = [
            'name' => 'New Tag',
            'description' => 'Test description'
        ];

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
            'Accept' => 'Application/json'
        ])->postJson('/api/tags', $payload);

        $response->assertStatus(201)
            ->assertJsonFragment(['message' => 'Etiqueta creada exitosamente.']);
    }

    #[Test]
    public function it_can_show_a_tag(): void
    {

        $token = $this->getToken();

        $tag = Tag::factory()->create();

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
            'Accept' => 'application/json'
        ])->getJson("/api/tags/{$tag->id}");

        $response->assertStatus(200)
            ->assertJsonFragment(['id' => $tag->id]);
    }

    #[Test]
    public function it_can_update_a_tag(): void
    {

        $token = $this->getToken();

        $tag = Tag::factory()->create();

        $payload = [
            'description' => 'Updated description'
        ];

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
            'Accept' => 'application/json'
        ])->putJson("/api/tags/{$tag->id}", $payload);

        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'Etiqueta actualizada correctamente.']);
    }

    #[Test]
    public function it_can_delete_a_tag(): void
    {

        $token = $this->getToken();

        $tag = Tag::factory()->create();

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
            'Accept' => "application/json"
        ])->deleteJson("/api/tags/{$tag->id}");

        $response->assertStatus(200)
            ->assertJsonFragment([
                'message' => 'Etiqueta eliminada correctamente.'
            ]);
    }
}
