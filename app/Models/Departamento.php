<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    protected $table = 'departamentos';
    protected $primaryKey = 'ID_departamento';
    public $incrementing = true;
    protected $keyType = 'bigint';
    public $timestamp = true;
    protected $fillable = ['nombre'];

    //relaciones

    public function carreras(){
      return $this->hasMany(Carrera::class, 'ID_departamento', 'ID_departamento');
    }
}
