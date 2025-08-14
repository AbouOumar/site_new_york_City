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
       Schema::create('sub_entites', function (Blueprint $table) {
    $table->id();
    $table->foreignId('entite_id')->constrained('entites')->onDelete('cascade');
    $table->string('nom'); // Nom du sous-service
    $table->decimal('prix', 10, 2)->nullable();
    $table->string('forfait')->nullable();
    $table->integer('nombre_place')->nullable();
    $table->string('emplacement')->nullable();
    $table->string('description')->nullable();
    $table->timestamps();
});
        //
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_entites');
    }
};
