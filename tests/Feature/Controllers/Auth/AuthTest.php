<?php

namespace Tests\Feature\Controllers\Auth;

use App\Models\Role\Role;
use App\Models\User\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Проверка sign-up маршрута
     *
     * @return void
     */
    public function test_sign_up()
    {
        $role = Role::factory()->create(['name' => 'User']);

        $this->post('/api/auth/sign-up', [
            'first_name' => 'Tonny',
            'middle_name' => 'Stark',
            'role_id' => $role->id,
            'email' => 'iron@ya.ru',
            'password' => 'password',
            'password_confirmation' => 'password',
        ])->assertStatus(201);
    }

    /**
     * Проверка sign-in маршрута
     *
     * @return void
     */
    public function test_sign_in()
    {
        $this->addUser();

        $this->post('/api/auth/sign-in', [
            'email' => 'iron@ya.ru',
            'password' => 'password',
        ])->assertStatus(200);
    }

    /**
     * Проверка sign-out маршрута
     *
     * @return void
     */
    public function test_sign_out()
    {
        $this->addUser();

        $token = auth()->attempt(['email' => 'iron@ya.ru', 'password' => 'password']);

        $this->withHeaders(['Authorization' => "Bearer $token"])
            ->post('/api/auth/sign-out')->assertStatus(200);
    }

    /**
     * Проверка user-info маршрута
     *
     * @return void
     */
    public function test_get_info()
    {
        $this->addUser();

        $token = auth()->attempt(['email' => 'iron@ya.ru', 'password' => 'password']);

        $this->withHeaders(['Authorization' => "Bearer $token"])
            ->get('/api/auth/user-info')->assertStatus(200);
    }

    /**
     * Добавление пользователя
     *
     * @return User
     */
    protected function addUser()
    {
        $role = Role::factory()->create(['name' => 'User']);

        $user = User::create([
            'first_name' => 'Tonny',
            'middle_name' => 'Stark',
            'role_id' => $role->id,
            'email' => 'iron@ya.ru',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        return $user;
    }
}
