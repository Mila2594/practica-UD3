<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    protected $fillable = ['titulo',
    'descripcion',
    'tipo_proyecto_id',
    'fecha_inicio',
    'fecha_limite'];


    /**
     * Relación con el tipo_proyecto (un proyecto pertenece a un tipo de proyecto)
     */
    public function tipoProyecto()
    {
        return $this->belongsTo(TipoProyecto::class,'tipo_proyecto_id');
    }

     /**
     * Relación muchos a muchos con los profesores a través de supervisiones.
     */
    public function profesores()
    {
        return $this->belongsToMany(Profesor::class, 'supervisiones', 'proyecto_id', 'profesor_id')
            ->withPivot('alumno_id', 'fecha_asig', 'rol')
            ->withTimestamps();
    }

    /**
     * Relación muchos a muchos con los alumnos a través de supervisiones.
     */
    public function alumnos()
    {
        return $this->belongsToMany(Alumno::class, 'supervisiones', 'proyecto_id', 'alumno_id')
            ->withPivot('profesor_id', 'fecha_asig', 'rol')
            ->withTimestamps();
    }

    /**
     * Relacion inversa con evaluacion (un proyecto puede tener varias evaluaciones)
     */
    public function evaluaciones()
    {
        return $this->hasMany(Evaluacion::class,'proyecto_id');
    }


    /**
     * Relación uno a uno con calificacion final
     */
    public function calificacionFinal()
    {
        return $this->hasOne(calificacionFinal::class,'proyecto_id','id');
    }

}
