<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;

    protected $table = 'carreras';
    protected $primaryKey = 'ID_carrera';
    public $incrementing = true;
    protected $keyType = 'bigint';
    public $timestamps = true;

    protected $fillable = [
      'ID_departamento', 'nombre',
    ];

    // Relación uno a muchos con la tabla Usuarios
    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'ID_carrera', 'ID_carrera');
    }

    public function departamentos()
    {
      return $this->belongsTo(Departamento::class, 'ID_departamento', 'ID_departamento');
    }


}
