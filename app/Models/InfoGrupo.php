<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoGrupo extends Model
{
    use HasFactory;

    protected $table = 'info_grupo';
    protected $primaryKey = 'ID_info';

    protected $fillable = [
        'ID_grupo',
        'descripcion',
        'avatar',
        'portada',
        'tema',
        'privado',
    ];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'ID_grupo', 'ID_grupos');
    }

    public function creador()
{
    return $this->belongsTo(Usuario::class, 'ID_creador');
}

}
