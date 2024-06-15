<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estadoamistad extends Model
{
    use HasFactory;

    protected $table = 'estadosamistades';
    protected $primaryKey = 'ID_estadoamistad';
    public $incrementing = true;
    protected $keyType = 'bigint';
    public $timestamp = true;

    protected $fillable =[
      'nombre', 'descripcion',
    ];

    public function amistad(){
      return $this->hasMany(Amistad::class, 'ID_estadoamistad', 'ID_estadoamistad');
    }
}
