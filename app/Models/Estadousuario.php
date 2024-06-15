<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estadousuario extends Model
{
    use HasFactory;
    protected $table = 'estadosusuarios';
    protected $primaryKey = 'ID_estadousuario';
    public $incrementing = true;
    protected $keyType = 'bigint';
    public $timestamp = true;

    protected $fillable =[
      'nombre', 'descripcion',
    ];


    public function usuarios(){
      return $this->hasMany(Usuario::class, 'ID_estadousuario', 'ID_estadousuario');
    }

}
