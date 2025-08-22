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
        Schema::create('entites', function (Blueprint $table) {
            $table->id(); 
            $table->string('nom'); // Nom de l'entité
            $table->string('image')->nullable(); // l'image de l'entité
            $table->string('description')->nullable(); // Description de l'entité
            $table->foreignId('hotel_id')->constrained('hotels'); // Hôtel responsable de l'entité
            $table->enum('type', ['Restaurant', 'Boites', 'Plein air','Piscine','Chambres']); // Type de l'entité
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entites');
    }
};
