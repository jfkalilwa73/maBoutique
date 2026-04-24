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
            $table->bigIncrements('id_utilisateur');
            $table->string('nom', 100);
            $table->string('prenom',100);
            $table->string('email', 191)->unique();
            $table->string('mot_de_passe',191);
            $table->date('date_de_naissance')->nullable();
            $table->enum('sexe',['M','F'])->nullable();
            $table->enum('role',['admin', 'commercant','vendeur'])->default('vendeur');
            $table->string('photo',191)->nullable();
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
