<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    use HasFactory;

    protected $table = 'notificaciones';

    protected $primaryKey = 'ID_notificacion';

    protected $fillable = [
        'user1', 'user2', 'ID_tipo', 'leido', 'fecha',
    ];

    public function usuario1()
    {
        return $this->belongsTo(Usuario::class, 'user1', 'ID_usuario');
    }

    public function usuario2()
    {
        return $this->belongsTo(Usuario::class, 'user2', 'ID_usuario');
    }

    public function tipoNotificacion()
    {
        return $this->belongsTo(TipoNotificacion::class, 'ID_tipo', 'ID_tiponotificacion');
    }
}
