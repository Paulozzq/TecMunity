<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupousuario extends Model
{
    use HasFactory;
    protected $table = 'usuariosgrupos';
    protected $primaryKey = ['ID_usuario', 'ID_grupos'];

    protected $fillable = [
        'ID_usuario',
        'ID_grupo',
        'fecha',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'ID_usuario', 'id');
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'ID_grupo', 'ID_grupos');
    }
}
