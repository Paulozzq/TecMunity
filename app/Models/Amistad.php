<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amistad extends Model
{
    use HasFactory;

    protected $table = 'amistades';

    protected $primaryKey = 'ID_amistad';

    protected $fillable = [
        'ID_usuario', 'ID_amigo', 'fecha', 'estado'
    ];

    // Relación muchos a uno con la tabla Usuario (para ID_usuario)
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'ID_usuario', 'id');
    }

    // Relación muchos a uno con la tabla Usuario (para ID_amigo)
    public function amigo()
    {
        return $this->belongsTo(Usuario::class, 'ID_amigo', 'id');
    }
}
