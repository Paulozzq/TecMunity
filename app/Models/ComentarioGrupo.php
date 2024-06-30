<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComentarioGrupo extends Model
{
    use HasFactory;

    protected $table = 'comentario_grupo'; // Nombre de la tabla en la base de datos

    protected $primaryKey = 'ID_comentario'; // Nombre de la clave primaria

    protected $fillable = [
        'ID_publicacion_grupo',
        'ID_usuario',
        'nro_likes',
        'contenido',
        'url_media',
        'fecha',
        'reply',
    ];

    // Relación con el modelo Usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'ID_usuario', 'id');
    }

    // Relación con el modelo PublicacionGrupo
    public function publicacionGrupo()
    {
        return $this->belongsTo(PublicacionGrupo::class, 'ID_publicacion_grupo', 'ID_publicacion_grupo');
    }

    // Relación para obtener respuestas (subcomentarios)
    public function replies()
    {
        return $this->hasMany(ComentarioGrupo::class, 'reply', 'ID_comentario');
    }

    // Relación para obtener los likes del comentario
    public function likes()
    {
        return $this->hasMany(LikeGrupo::class, 'ID_comentario_grupo');
    }
}
