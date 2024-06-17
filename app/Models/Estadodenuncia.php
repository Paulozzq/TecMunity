<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estadodenuncia extends Model
{
    use HasFactory;

    protected $table = 'estadosdenuncias';

    protected $primaryKey = 'ID_estadodenuncia';

    protected $fillable = [
        'nombre_estado',
        'descripcion_estado'
    ];

    public function denuncia()
    {
        return $this->hasMany(Denuncia::class, 'ID_estadodenuncia', 'ID_estadodenuncia');
    }
}
