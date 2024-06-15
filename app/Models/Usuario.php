<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use HasFactory;

    protected $table = 'usuarios';
    protected $primaryKey = 'ID_usuario';
    public $incrementing = true;
    protected $keyType = 'bigint';
    public $timestamp = true;

    protected $fillable = [
      'nombre', 'apellido', 'email', 'username', 'password', 'fecha_nacimiento',
      'sexo', 'ID_estadousuario', 'privado', 'ID_roles', 'avatar', 'portada',
      'ID_carrera', 'biografia',
    ];

    //relaciones dentro
    public function roles(){
      return $this->belongsTo(Rol::class, 'ID_roles', "ID_roles");
    }
    public function carreras(){
      return $this->belongsTo(Carrera::class, 'ID_carrera', 'ID_carrera');
    }
    public function estadosusuarios(){
      return $this->belongsto(Estadousuario::class, 'ID_estadousuario', 'ID_estadousuario');
    }

    //relaciones fuera
    public function amistadesEnviadas()
    {
        return $this->hasMany(Amistad::class, 'ID_emisor', 'ID_usuario');
    }
    public function amistadesRecibidas()
    {
        return $this->hasMany(Amistad::class, 'ID_receptor', 'ID_usuario');
    }

    public function publicaciones(){
      return $this->hasMany(Publicacion::class, 'ID_usuario', 'ID_usuario');
    }

    public function mensajesenviados(){
      return $this->hasMany(Mensaje::class, 'ID_emisor', 'ID_usuario');
    }
    public function mensajesrecibidos(){
      return $this->hasMany(Mensaje::class, 'ID_receptor', 'ID_usuario');
    }

    public function denuncia1(){
      return $this->hasMany(Denuncia::class, 'ID_denunciante', 'ID_usuario');
    }
    public function denuncia2(){
      return $this->hasMany(Denuncia::class, 'ID_denunciado', 'ID_usuario')
    }

    public function grupos()
    {
        return $this->belongsToMany(Grupo::class, 'gruposusuarios', 'ID_usuario', 'ID_grupo')
                    ->withTimestamps();
    }
    public function usuariocomentario()
    {
        return $this->hasMany(Usuario::class, 'ID_usuario', 'ID_usuario');
    }

    public function usuariolike()
    {
        return $this->hasMany(Usuario::class, 'ID_usuario', 'ID_usuario');
    }

    public function usuarionotificacion()
    {
        return $this->belongsTo(Notificacion::class, 'user1', 'ID_usuario');
    }

    public function usuarionotificacion2()
    {
        return $this->belongsTo(Notificacion::class, 'user2', 'ID_usuario');
    }




    public function setPasswordAttribute($value){
        $this->attributes['password'] =  bcrypt($value);
    }
}
