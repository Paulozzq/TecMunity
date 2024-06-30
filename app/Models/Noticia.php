<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    use HasFactory;

    protected $table = 'noticias'; // Nombre de la tabla en la base de datos

    protected $primaryKey = 'id'; // Nombre de la clave primaria

    protected $fillable = [
        'titulo',
        'contenido',
        'imagen',
        'autor',
    ];

    // Aquí puedes definir relaciones si es necesario
}

