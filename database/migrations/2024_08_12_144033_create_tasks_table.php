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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id(); // Поле id, целочисленное, автоинкрементируемое и уникальное
            $table->string('title', 50); // Поле название, строковое, длина до 50 символов
            $table->text('description'); // Поле описание, текстовое значение
            $table->integer('difficulty')->unsigned()->check(function($table) {
                $table->where('difficulty', '>=', 1)
                      ->where('difficulty', '<=', 5);
            }); // Поле сложность, целочисленное значение от 1 до 5
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
