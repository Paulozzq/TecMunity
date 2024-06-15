<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denuncia extends Model
{
    use HasFactory;

    protected $table = 'denuncias';
    protected $primaryKey = 'ID_denuncias';

    public $incrementing =  true;


    protected $fillable = [
      'ID_denunciado',
      'ID_denunciante',
      'ID_publicacion',
      'contenido',
      'ID_tipodenuncia',
      'ID_estadodenuncia',
    ];

    //relaciones
    public function denunciado(){
      return $this->belongsTo(Usuario::class, 'ID_denunciado', 'ID_usuario');
    }
    public function denunciante(){
      return $this->belongsTo(Usuario::class, 'ID_denunciante', 'ID_usuario');
    }
    public function publicacion(){
      return $this->belongsTo(Publicacion::class, 'ID_publicacion', 'ID_publicacion');
    }
    public function Estadodenuncia(){
      return $this->belongsTo(Estadodenuncia::class, 'ID_estadodenuncia', 'ID_estadodenuncia');
    }
    public function tipodenuncia(){
      return $this->belongsTo(Tipodenuncia::class, 'ID_tipodenuncia', 'ID_tipodenuncia');
    }
}
