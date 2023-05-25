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
        Schema::create('temps_taches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tache_id')->constrained('taches')->onUpdate('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onUpdate('cascade');
            $table->string('temps_passer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temps_taches');
    }
};
