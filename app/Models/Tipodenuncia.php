<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipodenuncia extends Model
{
    use HasFactory;
    protected $table = 'tiposdenuncias';
    protected $primaryKey = 'ID_tipodenuncia';
    protected $fillable = [
        'nombre_tipo',
        'descripcion_tipo'
    ];

    public function denuncias()
    {
        return $this->hasMany(Denuncia::class, 'ID_tipodenuncia', 'ID_tipodenuncia');
    }
}
