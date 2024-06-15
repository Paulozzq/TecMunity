<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupousuario extends Model
{
    use HasFactory;

    protected $table = 'gruposusuarios';

    protected $primaryKey = ['ID_usuario', 'ID_grupo'];

    public $incrementing = false;

    protected $fillable = [
        'ID_usuario', 'ID_grupo', 'fecha',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'ID_usuario', 'ID_usuario');
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'ID_grupo', 'ID_grupo');
    }
}
