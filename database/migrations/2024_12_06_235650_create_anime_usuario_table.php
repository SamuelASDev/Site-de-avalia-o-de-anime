<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimeUsuarioTable extends Migration
{
    public function up()
    {
        Schema::create('anime_usuario', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idUsuario')->constrained('users')->onDelete('cascade'); // Relacionamento com a tabela 'users'
            $table->foreignId('idAnime')->constrained('animes')->onDelete('cascade');  // Relacionamento com a tabela 'animes'
            $table->integer('NotaAnime'); // Nota do anime (ex: de 0 a 10)
            $table->text('Opinião'); // Opinião sobre o anime
            $table->timestamps(); // Campos de criação e atualização
        });
    }

    public function down()
    {
        Schema::dropIfExists('anime_usuario');
    }
}
