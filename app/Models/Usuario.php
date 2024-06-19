<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use HasFactory;

    protected $table = 'usuarios'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'nombre', 'apellido', 'email', 'username', 'password', 'fecha_nacimiento',
        'fecha_registro', 'sexo', 'ID_estadousuario', 'privado', 'ID_roles', 'avatar', 'portada', 'ID_carrera', 'biografia',
    ];

    // Relación muchos a uno con la tabla Carreras
    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'ID_carrera', 'ID_carrera');
    }

    // Relación uno a muchos con la tabla Publicaciones
    public function publicaciones()
    {
        return $this->hasMany(Publicacion::class, 'ID_usuario', 'id');
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class, 'ID_usuario', 'id');
    }

    // Relación uno a muchos con la tabla Likes
    public function likes()
    {
        return $this->hasMany(Like::class, 'ID_usuario', 'id');
    }

    // Relación muchos a muchos con la tabla Amistades (para amigos)
    public function amigos()
    {
        return $this->hasMany(Amistad::class, 'ID_usuario', 'id');
    }

    // Relación muchos a muchos con la tabla Amistades (para usuarios)
    public function usuarios()
    {
        return $this->hasMany(Amistad::class, 'ID_amigo', 'id');
    }

    // Relación uno a muchos con la tabla Mensajes (como emisor)
    public function mensajesEnviados()
    {
        return $this->hasMany(Mensaje::class, 'ID_emisor', 'id');
    }
 
    // Relación uno a muchos con la tabla Mensajes (como receptor)
    public function mensajesRecibidos()
    {
        return $this->hasMany(Mensaje::class, 'ID_receptor', 'id');
    }

    // Relación uno a muchos con la tabla Notificaciones (para las notificaciones enviadas)
    public function notificacionesEnviadas()
    {
        return $this->hasMany(Notificacion::class, 'user1', 'id');
    }

    // Relación uno a muchos con la tabla Notificaciones (para las notificaciones recibidas)
    public function notificacionesRecibidas()
    {
        return $this->hasMany(Notificacion::class, 'user2', 'id');
    }

    // Relacion Roles 
    public function roles(){
        return $this->belongsTo(Rol::class, 'ID_roles', 'ID_roles');
    }

    public function estadousuario(){
        return $this->belongsTo(Estadousuario::class, 'ID_estadousuario', 'ID_estadousuario');
    }

    public function creadorgrupo(){
        return $this->hasMany(Grupo::class, 'ID_creador', 'id');
    }

    //muchos a muchos grupo
    public function grupos()
    {
        return $this->hasMany(Grupousuario::class, 'ID_usuario', 'id');
    }

    public function setPasswordAttribute($value){
        $this->attributes['password'] =  bcrypt($value);
    }
}
