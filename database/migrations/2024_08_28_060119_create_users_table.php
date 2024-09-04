<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->comment('Имя');
            $table->string('middle_name')->comment('Фамилия');
            $table->string('email')->comment('Email');
            $table->char('phone_number', 12)->nullable()->comment('Номер телефона');
            $table->string('password');
            $table->date('birthdate')->nullable()->comment('Дата рождения');
            $table->foreignId('role_id')->constrained()->on('roles')->onDelete('cascade');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
