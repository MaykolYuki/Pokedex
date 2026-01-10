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
        Schema::create('pokemon_type', function (Blueprint $table) {
            // 1. Definimos la llave primaria de la tabla pivote
            $table->string('id_pokemon_type', 36)->primary();

            // 2. Creamos las columnas PRIMERO (sin usar foreignId)
            $table->string('id_pokemon', 36);
            $table->string('id_type', 36);

            // 3. Definimos las relaciones después de crear las columnas
            $table->foreign('id_pokemon')
                ->references('id_pokemon')
                ->on('pokemon')
                ->onDelete('cascade');

            $table->foreign('id_type')
                ->references('id_type')
                ->on('type')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pokemon_type');
    }
};
