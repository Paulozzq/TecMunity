<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;

    protected $table = 'carreras'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'nombre', 'ID_departamento'// Lista de campos que pueden ser asignados masivamente
    ];

    // Relación uno a muchos con la tabla Usuarios
    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'ID_carrera', 'ID_carrera');
    }
    public function departamentos(){
        return $this->belongsTo(Departamento::class, 'ID_departamento', 'ID_departamento');
    }

    public function carrera(){
        return $this->hasMany(Grupo::class, 'ID_carrera', 'ID_carrera');
    }
}
