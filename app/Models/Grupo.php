<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;
    protected $table = 'grupos';
    protected $primaryKey = 'ID_grupos';

    protected $fillable = [
        'nombre',
        'Fecha_creacion',
        'ID_creador',
        'ID_carrera',
    ];

    public function creador(){
        return $this->belongsTo(Usuario::class, 'ID_creador','id');
    }

    public function carrera(){
        return $this->belongsTo(Carrera::class, 'ID_carrera','ID_carrera');
    }

    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'usuariosgrupos', 'ID_grupos', 'ID_usuario')
                    ->withPivot('fecha')
                    ->withTimestamps();
    }
}
