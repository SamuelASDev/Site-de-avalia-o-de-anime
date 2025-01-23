<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo', 'resumo', 'imagem_url', 'data_lancamento'
    ];

    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'anime_usuario', 'idAnime', 'idUsuario')
                    ->withPivot('NotaAnime', 'Opinião') // Inclui as colunas adicionais da tabela pivô
                    ->withTimestamps(); // Inclui os campos created_at e updated_at
    }
}
