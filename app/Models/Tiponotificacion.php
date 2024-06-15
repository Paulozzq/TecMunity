<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiponotificacion extends Model
{
    use HasFactory;
    protected $table = 'tiponotificaciones';

    protected $primaryKey = 'ID_tiponotificacion';

    protected $fillable = [
        'nombre', 'descripcion',
    ];

    public function notificaciones()
    {
        return $this->hasMany(Notificacion::class, 'ID_tipo', 'ID_tiponotificacion');
    }
}
