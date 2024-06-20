<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicacionGrupo extends Model
{
    use HasFactory;

    protected $table = 'publicacion_grupo';
    protected $primaryKey = 'ID_publicacion';

    protected $fillable = [
        'ID_grupo',
        'ID_usuario',
        'contenido',
        'url_media',
        'nro_likes',
    ];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'ID_grupo', 'ID_grupos');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'ID_usuario', 'id');
    }
    public function comentarios()
    {
        return $this->hasMany(ComentarioGrupo::class, 'ID_publicacion_grupo', 'ID_publicacion_grupo');
    }
    public function likes()
    {
        return $this->hasMany(LikeGrupo::class, 'ID_publicacion_grupo');
    }
}
