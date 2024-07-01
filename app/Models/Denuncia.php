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
      'denunciado',
      'denunciante',
      'publicacion',
      'contenido',
      'ID_tipodenuncia',
      'ID_estadodenuncia',
      'fecha_de_aprobacion',
  ];

    //relaciones
    public function denunciado(){
      return $this->belongsTo(Usuario::class, 'denunciado');
    }
    public function denunciante(){
      return $this->belongsTo(Usuario::class, 'denunciante');
    }
    public function publicacion(){
      return $this->belongsTo(Publicacion::class, 'publicacion');
    }

    public function estadodenuncia(){
      return $this->belongsTo(EstadoDenuncia::class, 'ID_estadodenuncia', 'ID_estadodenuncia');
    }
}
