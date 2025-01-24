<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    //campos de asignacion masiva
    protected $fillable = ['nombre',
        'apellido',
        'email',
        'curso',
        'dni',
        'especialidad_id'];

    /**
     * Relación con la especialidad (un alumno pertenece a una especialidad)
     */
    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class,'especialid_id');
    }

   /**
     * Relación muchos a muchos con los proyectos a través de supervisiones.
     */
    public function proyectos()
    {
        return $this->belongsToMany(Proyecto::class, 'supervisiones', 'alumno_id', 'proyecto_id')
            ->withPivot('profesor_id', 'fecha_asig', 'rol')
            ->withTimestamps();
    }

    /**
     * Relación muchos a muchos con los profesores a través de supervisiones (un alumno puede ser supervisado por varios profesores)
     */
    public function profesores()
    {
        return $this->belongsToMany(Profesor::class, 'supervisiones', 'alumno_id', 'profesor_id')
            ->withPivot('proyecto_id', 'fecha_asig', 'rol')
            ->withTimestamps();
    }
}
