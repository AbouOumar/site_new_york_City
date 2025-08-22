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
        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->unique(); // Nom de l'utilisateur
            $table->string('email')->unique(); // Email de l'utilisateur
            $table->string('image')->nullable(); // l'image de l'utilisateur
            $table->foreignId('hotel_id')->nullable()->constrained('hotels'); // Hôtel de l'utilisateur
            $table->foreignId('sub_entite_id')->nullable()->constrained('sub_entites'); // Sous-entité de l'utilisateur
            $table->foreignId('role_id')->constrained('roles'); // Rôle de l'utilisateur
            $table->string('password'); // Mot de passe de l'utilisateur

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utilisateurs');
    }
};
