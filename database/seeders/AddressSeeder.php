<?php

namespace Database\Seeders;

use App\Models\Address\Address;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Создание 15 адресов
        Address::insert([
            ['title' => 'Офис 1', 'city' => 'Москва', 'street' => 'Ленина', 'building' => '1', 'floor' => '1', 'room' => '101'],
            ['title' => 'Офис 2', 'city' => 'Москва', 'street' => 'Ленина', 'building' => '2', 'floor' => '2', 'room' => '202'],
            ['title' => 'Офис 3', 'city' => 'Москва', 'street' => 'Ленина', 'building' => '3', 'floor' => '3', 'room' => '303'],
            ['title' => 'Офис 4', 'city' => 'Москва', 'street' => 'Ленина', 'building' => '4', 'floor' => '4', 'room' => '404'],
            ['title' => 'Офис 5', 'city' => 'Москва', 'street' => 'Ленина', 'building' => '5', 'floor' => '5', 'room' => '505'],
            ['title' => 'Офис 6', 'city' => 'Санкт-Петербург', 'street' => 'Невский проспект', 'building' => '1', 'floor' => '1', 'room' => '101'],
            ['title' => 'Офис 7', 'city' => 'Санкт-Петербург', 'street' => 'Невский проспект', 'building' => '2', 'floor' => '2', 'room' => '202'],
            ['title' => 'Офис 8', 'city' => 'Санкт-Петербург', 'street' => 'Невский проспект', 'building' => '3', 'floor' => '3', 'room' => '303'],
            ['title' => 'Офис 9', 'city' => 'Санкт-Петербург', 'street' => 'Невский проспект', 'building' => '4', 'floor' => '4', 'room' => '404'],
            ['title' => 'Офис 10', 'city' => 'Санкт-Петербург', 'street' => 'Невский проспект', 'building' => '5', 'floor' => '5', 'room' => '505'],
            ['title' => 'Офис 11', 'city' => 'Казань', 'street' => 'Баумана', 'building' => '1', 'floor' => '1', 'room' => '101'],
            ['title' => 'Офис 12', 'city' => 'Казань', 'street' => 'Баумана', 'building' => '2', 'floor' => '2', 'room' => '202'],
            ['title' => 'Офис 13', 'city' => 'Казань', 'street' => 'Баумана', 'building' => '3', 'floor' => '3', 'room' => '303'],
            ['title' => 'Офис 14', 'city' => 'Казань', 'street' => 'Баумана', 'building' => '4', 'floor' => '4', 'room' => '404'],
            ['title' => 'Офис 15', 'city' => 'Казань', 'street' => 'Баумана', 'building' => '5', 'floor' => '5', 'room' => '505'],
        ]);
    }
}
