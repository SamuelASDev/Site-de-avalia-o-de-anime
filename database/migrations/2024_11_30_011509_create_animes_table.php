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
        Schema::create('animes', function (Blueprint $table) {
            $table->id(); // ID auto incrementado
            $table->string('titulo'); // Título do anime
            $table->text('resumo'); // Resumo do anime
            $table->string('imagem_url'); // URL da imagem
            $table->date('data_lancamento'); // Data de lançamento
            $table->timestamps(); // Created at e Updated at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animes');
    }
};
