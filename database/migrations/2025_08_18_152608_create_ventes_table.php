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
        Schema::create('ventes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_entite_id')->nullable()->constrained()->onDelete('cascade'); 
            // $table->integer('quantite');
            $table->decimal('total', 10, 2);
            $table->decimal('remise_globale', 10, 2)->default(0);
            $table->decimal('net', 10, 2);
    
            // Statut de paiement / commande
            $table->enum('etat_commande', ['en_attente', 'validee', 'annulee'])->default('en_attente'); 
            $table->enum('status', ['soldé', 'credit'])->default('soldé'); 

            $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventes');
    }
};
