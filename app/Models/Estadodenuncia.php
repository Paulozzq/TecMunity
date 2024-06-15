<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estadodenuncia extends Model
{
    use HasFactory;

    protected $table = 'estadosdenuncias';
    protected $primaryKey = 'ID_estadodenuncia';
    public $incrementing = true;
    protected $keyType = 'bigint';
    public $timestamp = true;

    protected $fillable =[
      'nombre', 'descripcion',
    ];

    public function denuncia(){
      return $this->hasMany(Denuncia::class, 'ID_estadodenuncia', 'ID_estadodenuncia')
    }
}
