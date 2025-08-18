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
    Schema::create('reservations', function (Blueprint $table) {
        $table->id();
        $table->string('numero_reservation')->unique();
        $table->string('nom_client');
        $table->string('telephone_client');
        $table->string('email_client')->nullable();
        $table->foreignId('entite_id')->constrained()->onDelete('cascade');
        $table->foreignId('subEntite_id')->nullable()->constrained()->onDelete('cascade');
        $table->dateTime('date_debut');
        $table->dateTime('date_fin');
        $table->decimal('prix', 10, 2);
        $table->enum('statut', ['en_attente', 'confirmé', 'annulé'])->default('en_attente');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
