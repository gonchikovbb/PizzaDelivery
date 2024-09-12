<?php

namespace Database\Factories\User;

use App\Models\Role\Role;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'middle_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'phone_number' => '12345678913',
            'password' => 'password123',
            //'password_confirmation' => 'password123',
            'birthdate' => $this->faker->date(),
            'role_id' => Role::factory()->create(),
        ];
    }
}
