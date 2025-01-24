<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','descripcion'];

    /**
     * Relación uno a muchos con los alumnos (una especialidad tiene muchos alumnos)
     */
    public function alumnos()
    {
        return $this->hasMany(Alumno::class,'especialidad_id');
    }

    /**
     * Relacion Especialidad con proyectos (un proyecto pertenece a una especialidad por el alumno autor)
     */
    public function proyectos()
    {
        return $this->hasManyThrough(
            Proyecto::class,
            Alumno::class,
            'especialidad_id', //clave foranea en la tabla intermedia (alumno)
            'id', //primary key en la tabla de destion (proyectos)
            'id', //primary key en la tabla de origen (especialidad)
            'proyecto_id' //clave foranea en tabla intermedia
        );
    }
}
