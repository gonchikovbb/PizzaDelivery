<?php

namespace Tests\Feature\Controllers\Auth;

use App\Models\User\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_sign_up()
    {
        $response = $this->post('/api/auth/sign-up', [
            'first_name' => 'Tonny',
            'middle_name' => 'Stark',
            'role_id' => 3,
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
        ]);
    }

    /** @test */
    public function user_can_sign_in()
    {
        $user = User::create([
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        $response = $this->post('/api/auth/sign-in', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200);
        $this->assertArrayHasKey('token', $response->json());
    }

    /** @test */
    public function user_can_sign_out()
    {
        $user = User::create([
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        $token = auth()->attempt(['email' => 'test@example.com', 'password' => 'password']);

        $response = $this->withHeaders(['Authorization' => "Bearer $token"])
            ->post('/api/auth/sign-out');

        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_refresh_token()
    {
        $user = User::create([
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        $token = auth()->attempt(['email' => 'test@example.com', 'password' => 'password']);

        $response = $this->withHeaders(['Authorization' => "Bearer $token"])
            ->get('/api/auth/refresh');

        $response->assertStatus(200);
        $this->assertArrayHasKey('token', $response->json());
    }

    /** @test */
    public function user_can_get_info()
    {
        $user = User::create([
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        $token = auth()->attempt(['email' => 'test@example.com', 'password' => 'password']);

        $response = $this->withHeaders(['Authorization' => "Bearer $token"])
            ->get('/api/auth/user-info');

        $response->assertStatus(200);
        $this->assertEquals($user->email, $response->json()['email']);
    }
}
