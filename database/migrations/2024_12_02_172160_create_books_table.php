<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('books', function (Blueprint $table) {
        $table->id();  // Vytvoří 'id' sloupec jako unsignedBigInteger
        $table->string('title');  // Název knihy
        $table->unsignedBigInteger('author_id');  // Cizí klíč na tabulku 'authors'
        $table->boolean('available')->default(true);  // Sloupec pro dostupnost knihy, výchozí hodnota je true
        $table->timestamps();  // Sloupce pro vytvoření a aktualizaci časů

        // Definice cizího klíče
        $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
