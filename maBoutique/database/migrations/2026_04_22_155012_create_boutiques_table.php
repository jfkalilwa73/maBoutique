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
        Schema::create('boutiques', function (Blueprint $table) {
            $table->bigIncrements('id_boutique');
            $table->unsignedBigInteger('id_commercant');
            $table->string('nom',100);
            $table->text('description')->nullable();
            $table->timestamps();
            $table->foreign('id_commercant')->references('id_utilisateur')->on('utilisateurs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boutiques');
    }
};
