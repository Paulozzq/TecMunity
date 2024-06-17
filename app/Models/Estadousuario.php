<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estadousuario extends Model
{
    use HasFactory;
    protected $table = 'estadosusuarios';
    protected $primaryKey = 'ID_estadousuario';

    protected $fillable = [
        'nombre_estado',
        'descripcion_estado',
    ];

    public function usuario()
    {
        return $this->hasMany(Usuario::class, 'ID_estadousuario', 'ID_estadousuario');
    }
}
