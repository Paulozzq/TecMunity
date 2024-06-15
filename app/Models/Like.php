<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $table = 'likes';

    protected $fillable = [
        'ID_usuario', 'ID_publicacion', 'ID_comentario',
    ];

    // Relación con el modelo Usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'ID_usuario', 'ID_usuario');
    }

    public function publicacion()
    {
        return $this->belongsTo(Publicacion::class, 'ID_publicacion', 'ID_publicacion');
    }

    public function comentario()
    {
        return $this->belongsTo(Comentario::class, 'ID_comentario', 'ID_comentario');
    }
}
