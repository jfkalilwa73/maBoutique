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
        Schema::create('produit_vendeur', function (Blueprint $table) {
            $table->uuid('id_produit_vendeur')->unique();
            $table->unsignedBigInteger('id_produit');
            $table->unsignedBigInteger('id_vendeur');
            $table->primary(['id_produit','id_vendeur']);
            $table->foreign('id_produit')->references('id_produit')->on('produits')->onDelete('cascade');
            $table->foreign('id_vendeur')->references('id_utilisateur')->on('utilisateurs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produit_vendeur');
    }
};
