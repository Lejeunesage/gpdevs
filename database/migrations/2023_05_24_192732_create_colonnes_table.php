<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('colonnes', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('projet_id');
        $table->string('titre');
        $table->integer('numero_ordre')->unsigned();
        $table->foreign('projet_id')->references('id')->on('projets')->onDelete('cascade');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('colonnes');
}

};
