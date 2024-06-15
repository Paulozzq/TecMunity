<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipodenuncia extends Model
{
    use HasFactory;

    protected $table = 'tiposdenuncias';
    protected $primaryKey = 'ID_tipodenuncia';
    public $incrementing = true;
    protected $keyType = 'bigint';
    public $timestamp = true;

    protected $fillable =[
      'nombre', 'descripcion',
    ];

    public function denunciatip(){
      return $this->hasMany(Denuncia::class, 'ID_tipodenuncia', 'ID_tipodenuncia')
    }
}
