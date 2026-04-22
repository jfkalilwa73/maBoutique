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
        Schema::create('boutique_vendeur', function (Blueprint $table) {
            $table->unsignedBigInteger('id_boutique');
            $table->unsignedBigInteger('id_vendeur');
            $table->timestamps();
            $table->primary(['id_boutique','id_vendeur']);
            $table->foreign('id_boutique')->references('id_boutique')->on('boutiques')->onDelete('cascade');
            $table->foreign('id_vendeur')->references('id_utilisateur')->on('utilisateurs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boutique_vendeur');
    }
};
