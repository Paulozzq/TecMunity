<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $primaryKey = 'ID_roles';
    public $incrementing = true;
    protected $keyType = 'bigint';
    public $timestamp = true;

    protected $fillable = [
      'nombre', 'descripcion',
    ];

    //relaciones
    public function usuarios()
    {
      return $this->hasMany(Usuario::class, 'ID_roles', 'ID_roles');
    }
    

}
