<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amistad extends Model
{
    use HasFactory;

    protected $table = 'amistades';

    protected $primaryKey = 'ID_amistad';

    protected $fillable = [
        'ID_emisor', 'ID_receptor', 'fecha', 'ID_estadoamistad'
    ];

    //funciones dentro
    public function emisor()
    {
        return $this->belongsTo(Usuario::class, 'ID_emisor', 'ID_usuario');
    }
    public function receptor()
    {
        return $this->belongsTo(Usuario::class, 'ID_receptor', 'ID_usuario');
    }
    public function estadoamistad(){
        return $this->belongsTo(Estadoamistad::class, 'ID_estadoamistad', 'ID_estadoamistad');
    }
}
