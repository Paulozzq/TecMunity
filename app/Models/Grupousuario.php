<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupousuario extends Model
{
    use HasFactory;
    protected $table = 'usuariosgrupos';
    protected $primaryKey = ['ID_usuariogrupo'];

    protected $fillable = [
        'ID_usuario',
        'ID_grupos',
        'fecha_union',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'ID_usuario', 'id');
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'ID_grupos', 'ID_grupos');
    }
}
