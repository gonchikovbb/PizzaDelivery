<?php

namespace Tests\Feature\Controllers\User;

use App\Models\Role\Role;
use App\Models\User\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\Feature\GuestResourceTestCase;
use Tests\TestCase;

class UserTest extends GuestResourceTestCase
{
    protected $route = "users";
    protected $modelClass = User::class;

    //public function generateFakeModel(): array
    //{
    //    Role::insert([
    //        ['name' => 'User'],
    //    ]);
    //
    //    $role = Role::query()->where('name', 'User')->first();
    //
    //    User::insert(
    //        [
    //            'first_name' => 'Tony',
    //            'middle_name' => 'Stark',
    //            'email' => 'iron@ya.ru',
    //            'phone_number' => '12345678901',
    //            'password' => Hash::make('password123'),
    //            'birthdate' => '1990-01-01',
    //            'role_id' => $role->id,
    //        ]);
    //
    //    $user = User::query()->where('email', 'iron@ya.ru')->first();
    //
    //    return $user->toArray();
    //}
}
