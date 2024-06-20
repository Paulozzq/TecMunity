<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeGrupo extends Model
{
    use HasFactory;

    protected $table = 'likes_grupos';

    protected $fillable = [
        'ID_usuario',
        'ID_comentario_grupo',
        'ID_publicacion_grupo',
    ];

    /**
     * Relación: Obtener el usuario que dio el like.
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'ID_usuario');
    }

    /**
     * Relación: Obtener el comentario en grupo que recibió el like.
     */
    public function comentarioGrupo()
    {
        return $this->belongsTo(ComentarioGrupo::class, 'ID_comentario_grupo');
    }

    /**
     * Relación: Obtener la publicación en grupo que recibió el like.
     */
    public function publicacionGrupo()
    {
        return $this->belongsTo(PublicacionGrupo::class, 'ID_publicacion_grupo');
    }
}
