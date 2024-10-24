<?php

namespace Tests\Feature;

use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Database\Seeders\RolePermissionsSeeder;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;

class UserTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RolePermissionsSeeder::class);
        $this->seed(UserSeeder::class);
    }

    public function testLoginSuccess()
    {
        $response = $this->postJson('/api/users/login', [
            'username' => 'admin',
            'password' => 'password',
        ]);

        $response->assertStatus(200)
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

    public function testCurrentUserSuccess()
    {
        $user = User::where('username', 'admin')->first();
        // $user->assignRole('admin');
        $token = JWTAuth::fromUser($user);

        $this->getJson('/api/users/current', [
            'Authorization' => 'Bearer ' . $token,
        ])->assertStatus(200)
            ->assertJson([
                'data' => [
                    'username' => 'admin',
                    'name' => 'Administrator',
                ]
            ]);
    }
}
