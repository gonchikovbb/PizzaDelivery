<?php

namespace Database\Seeders;

use App\Models\User\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Создание 15 пользователей
        User::insert([
            [
                'first_name' => 'Иван',
                'middle_name' => 'Иванов',
                'email' => 'ivan@example.com',
                'phone_number' => '12345678901',
                'password' => Hash::make('password123'),
                'birthdate' => '1990-01-01',
                'role_id' => 1,
            ],
            [
                'first_name' => 'Петр',
                'middle_name' => 'Петров',
                'email' => 'petr@example.com',
                'phone_number' => '12345678902',
                'password' => Hash::make('password123'),
                'birthdate' => '1991-02-02',
                'role_id' => 2,
            ],
            [
                'first_name' => 'Сергей',
                'middle_name' => 'Сергеев',
                'email' => 'sergey@example.com',
                'phone_number' => '12345678903',
                'password' => Hash::make('password123'),
                'birthdate' => '1992-03-03',
                'role_id' => 3,
            ],
            [
                'first_name' => 'Алексей',
                'middle_name' => 'Алексеев',
                'email' => 'aleksey@example.com',
                'phone_number' => '12345678904',
                'password' => Hash::make('password123'),
                'birthdate' => '1993-04-04',
                'role_id' => 3,
            ],
            [
                'first_name' => 'Дмитрий',
                'middle_name' => 'Дмитриев',
                'email' => 'dmitry@example.com',
                'phone_number' => '12345678905',
                'password' => Hash::make('password123'),
                'birthdate' => '1994-05-05',
                'role_id' => 3,
            ],
            [
                'first_name' => 'Андрей',
                'middle_name' => 'Андреев',
                'email' => 'andrey@example.com',
                'phone_number' => '12345678906',
                'password' => Hash::make('password123'),
                'birthdate' => '1995-06-06',
                'role_id' => 3,
            ],
            [
                'first_name' => 'Николай',
                'middle_name' => 'Николаев',
                'email' => 'nikolay@example.com',
                'phone_number' => '12345678907',
                'password' => Hash::make('password123'),
                'birthdate' => '1996-07-07',
                'role_id' => 3,
            ],
            [
                'first_name' => 'Владимир',
                'middle_name' => 'Владимиров',
                'email' => 'vladimir@example.com',
                'phone_number' => '12345678908',
                'password' => Hash::make('password123'),
                'birthdate' => '1997-08-08',
                'role_id' => 3,
            ],
            [
                'first_name' => 'Станислав',
                'middle_name' => 'Станиславов',
                'email' => 'stanislav@example.com',
                'phone_number' => '12345678909',
                'password' => Hash::make('password123'),
                'birthdate' => '1998-09-09',
                'role_id' => 3,
            ],
            [
                'first_name' => 'Максим',
                'middle_name' => 'Максимов',
                'email' => 'maxim@example.com',
                'phone_number' => '12345678910',
                'password' => Hash::make('password123'),
                'birthdate' => '1999-10-10',
                'role_id' => 3,
            ],
            [
                'first_name' => 'Евгений',
                'middle_name' => 'Евгеньев',
                'email' => 'evgeny@example.com',
                'phone_number' => '12345678911',
                'password' => Hash::make('password123'),
                'birthdate' => '2000-11-11',
                'role_id' => 3,
            ],
            [
                'first_name' => 'Роман',
                'middle_name' => 'Романов',
                'email' => 'roman@example.com',
                'phone_number' => '12345678912',
                'password' => Hash::make('password123'),
                'birthdate' => '2001-12-12',
                'role_id' => 3,
            ],
            [
                'first_name' => 'Артем',
                'middle_name' => 'Артемов',
                'email' => 'artem@example.com',
                'phone_number' => '12345678913',
                'password' => Hash::make('password123'),
                'birthdate' => '2002-01-01',
                'role_id' => 3,
            ],
            [
                'first_name' => 'Игорь',
                'middle_name' => 'Игорев',
                'email' => 'igor@example.com',
                'phone_number' => '12345678914',
                'password' => Hash::make('password123'),
                'birthdate' => '2003-02-02',
                'role_id' => 3,
            ],
            [
                'first_name' => 'Виктор',
                'middle_name' => 'Викторов',
                'email' => 'viktor@example.com',
                'phone_number' => '12345678915',
                'password' => Hash::make('password123'),
                'birthdate' => '2004-03-03',
                'role_id' => 3,
            ],
        ]);
    }
}
