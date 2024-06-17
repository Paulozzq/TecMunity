<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;
    protected $table = 'roles';
    protected $primaryKey = 'ID_roles';

    protected $fillable = [
        'nombre_roles', 'descripcion_roles'
    ];

    public function usuario(){
        return $this->hasMany(Usuario::class, 'ID_roles', 'ID_roles');
    }
}
