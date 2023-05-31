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
        Schema::create('taches', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description');
            $table->foreignId('equipe_id')->constrained('equipes')->onUpdate('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onUpdate('cascade');
            $table->timestamp('date_heure_livraison');
            $table->unsignedBigInteger('colonne_id');
            $table->foreign('colonne_id')->references('id')->on('colonnes');                            
            $table->enum('priorite', ['Haute', 'Moyenne', 'Basse']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taches');
    }
};
