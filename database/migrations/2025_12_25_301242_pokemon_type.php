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
        Schema::disableForeignKeyConstraints();

        Schema::create('pokemon_type', function (Blueprint $table) {
            $table->string('id_pokemon_type', 36)->primary();
            $table->string('id_pokemon', 36);
            $table->string('id_type', 36);

            $table->foreign('id_pokemon')
                ->references('id_pokemon')
                ->on('pokemon')
                ->onDelete('cascade');

            $table->foreign('id_type')
                ->references('id_type')
                ->on('type')
                ->onDelete('cascade');
        });

        Schema::enableForeignKeyConstraints();
    }

    public function down(): void
    {
        Schema::dropIfExists('pokemon_type');
    }
};
