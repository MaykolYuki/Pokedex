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
        Schema::create('pokemon', function(Blueprint $table){
            $table->string('id_pokemon', 36)->primary();
            $table->string('nombrePokemon', 400)->unique();
            $table->foreign('idRegion')->references('idRegion')->on('Region')->onDelete('cascade');
            $table->string('description', 2000);
            $table->float('size');
            $table->float('weight');
            $table->longText('imagen_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pokemon');
    }
};
