<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name'); // Поле для имени
            $table->string('last_name'); // Поле для фамилии
            $table->string('email')->unique(); // Уникальный email
            $table->string('login')->unique(); // Уникальный логин
            $table->string('password'); // Поле для пароля (зашифрованного)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
