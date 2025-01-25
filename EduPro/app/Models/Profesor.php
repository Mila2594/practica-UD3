<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    use HasFactory;

    protected $table='profesores';

    protected $fillable=['nombre',
    'apellido',
    'email',
    'dni',
    'especialidad'];

    /**
     * Relacion de uno a muchos con Proyectos (un profesor puede supervisar ninguno o varios proyectos)
     */
    public function proyectos()
    {
        return $this->belongsToMany(Proyecto::class, 'supervisiones', 'profesor_id', 'proyecto_id')
            ->withPivot('alumno_id', 'fecha_asig', 'rol')
            ->withTimestamps();
    }

    /**
     * Relacion de uno a muchos con Alumnos (un profesor puede supervisar a ninguno o varios alumnos)
    */
    public function alumnos()
    {
        return $this->belongsToMany(Alumno::class, 'supervisiones', 'profesor_id', 'alumno_id')
            ->withPivot('proyecto_id', 'fecha_asig', 'rol')
            ->withTimestamps();
    }

    /**
     * Relación de uno a muchos con Evaluaciones (un profesor puede evaluar ninguno o varios proyectos)
     */
    public function evaluaciones()
    {
        return $this->hasMany(Evaluacion::class, 'profesor_id');
    }

}
