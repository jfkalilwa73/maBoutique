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
        Schema::create('produits', function (Blueprint $table) {
            $table->bigIncrements('id_produit');
            $table->unsignedBigInteger('id_vendeur')->nullable();
            $table->unsignedBigInteger('id_categorie')->nullable();
            $table->string('nom',100);
            $table->text('description')->nullable();
            $table->decimal('prix',10, 2);
            $table->unsignedInteger('quantite')->default(0);
            $table->string('photo', 191)->nullable();
            $table->timestamps();
            $table->foreign('id_vendeur')->references('id_utilisateur')->on('utilisateurs')->onDelete('cascade');
            $table->foreign('id_categorie')->references('id_categorie')->on('categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
