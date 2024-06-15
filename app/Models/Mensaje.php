<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    use HasFactory;

    protected $table = 'mensajes';

    protected $fillable = [
        'ID_emisor', 'ID_receptor', 'contenido', 'fecha'
    ];

    // Relación muchos a uno con la tabla Usuario (para ID_emisor)
    public function emisor()
    {
        return $this->belongsTo(Usuario::class, 'ID_emisor', 'ID_usuario');
    }

    // Relación muchos a uno con la tabla Usuario (para ID_receptor)
    public function receptor()
    {
        return $this->belongsTo(Usuario::class, 'ID_receptor', 'ID_usuario');
    }
}
