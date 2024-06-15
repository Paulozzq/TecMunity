<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;

    protected $table = 'grupos';

   protected $primaryKey = 'ID_grupo';

   protected $fillable = [
       'nombre', 'descripcion', 'ID_carrera', 'ID_creador',
   ];


   public function carrera()
   {
       return $this->belongsTo(Carrera::class, 'ID_carrera', 'ID_carrera');
   }

   public function creador()
   {
       return $this->belongsTo(Usuario::class, 'ID_creador', 'ID_usuario');
   }
   public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'ID_grupo', 'ID_grupo');
    }
}
