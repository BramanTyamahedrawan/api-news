<?php

namespace Tests\Feature;

use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testLoginSuccess()
    {
        $this->seed([UserSeeder::class]);
        $response = $this->postJson('/api/users/login', [
            'username' => 'admin',
            'password' => 'password',
        ])->assertStatus(200)
            ->assertJson([
                'data' => [
                    'username' => 'admin',
                    'name' => 'Administrator',
                ]
            ]);
        $this->assertArrayHasKey('token', $response->json('data'));
    }

    public function testLoginFailure()
    {
        $this->seed([UserSeeder::class]);
        $this->postJson('/api/users/login', [
            'username' => 'admin',
            'password' => 'wrongpassword',
        ])->assertStatus(401)
            ->assertJson([
                'errors' => [
                    'message' => 'Unauthorized',
                ]
            ]);
    }

    public function testLoginUserNotFound()
    {
        $this->seed([UserSeeder::class]);
        $this->postJson('/api/users/login', [
            'username' => 'nonexistent',
            'password' => 'password',
        ])->assertStatus(401)
            ->assertJson([
                'errors' => [
                    'message' => 'Unauthorized',
                ]
            ]);
    }
}
