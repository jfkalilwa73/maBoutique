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
        Schema::create('boutiques_produits', function (Blueprint $table) {
            $table->unsignedBigInteger('id_boutique');
            $table->unsignedBigInteger('id_produit');
            $table->primary(['id_boutique','id_produit']);
            $table->foreign('id_boutique')->references('id_boutique')->on('boutiques')->onDelete('cascade');
            $table->foreign('id_produit')->references('id_produit')->on('produits')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boutiques_produits');
    }
};
