<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    use HasFactory;

    protected $table = 'publicaciones';
    protected $primaryKey = 'ID_publicacion';

    protected $fillable = [
        'ID_usuario',
        'contenido',
        'url_media'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'ID_usuario','ID_usuario');
    }
    public function denuncia(){
      return $this->hasMany(Denuncia::class, 'ID_publicacion', 'ID_publicacion');
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'ID_publicacion', 'ID_publicacion');
    }


    // Relación uno a muchos con la tabla Likes
    public function likes()
    {
    return $this->hasMany(Like::class, 'ID_publicacion', 'ID_publicacion');
    }
    public function isVideo()
    {
        $ext = pathinfo($this->url_media, PATHINFO_EXTENSION);
        return in_array($ext, ['mp4', 'mov', 'avi']);
    }
}
