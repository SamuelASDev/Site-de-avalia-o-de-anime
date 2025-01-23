<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Os atributos que podem ser atribuídos em massa.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public function animes()
    {
        return $this->belongsToMany(Anime::class, 'anime_usuario', 'idUsuario', 'idAnime')
                    ->withPivot('NotaAnime', 'Opinião') // Inclui as colunas adicionais da tabela pivô
                    ->withTimestamps(); // Inclui os campos created_at e updated_at
    }
}

