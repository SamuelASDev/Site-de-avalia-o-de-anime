<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimeUsuario extends Model
{
    use HasFactory;

    // Definir a tabela associada
    protected $table = 'anime_usuario';

    // Definir os campos que podem ser preenchidos (mass assignment)
    protected $fillable = [
        'idUsuario',
        'idAnime',
        'NotaAnime',
        'Opinião',
    ];

    // Relacionamento com o modelo de Anime (um Anime pode ter várias avaliações)
    public function anime()
    {
        return $this->belongsTo(Anime::class, 'idAnime');
    }

    // Relacionamento com o modelo de User (um Usuário pode fazer várias avaliações)
    public function user()
    {
        return $this->belongsTo(User::class, 'idUsuario');
    }
}
