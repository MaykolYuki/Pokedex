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
        Schema::create('region', function(Blueprint $table){
            $table->string('idRegion', 36)->primary();
            $table->string('nameRegion', 200);
            $table->integer('generation');
            $table->string('description', 200);
            $table->longText('imagen_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('region');
    }
};
