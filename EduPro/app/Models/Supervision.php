<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supervision extends Model
{
    use HasFactory;

    protected $table='supervisiones';
    protected $fillable = ['alumno_id','proyecto_id','profesor_id','fecha_asig','rol'];

    /**
    * Relación inversa con el Alumno (un registro de supervisión pertenece a un alumno)
    */
    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'alumno_id');
    }

    /**
    * Relación inversa con el Profesor (un registro de supervisión pertenece a un profesor)
    */
    public function profesor()
    {
        return $this->belongsTo(Profesor::class, 'profesor_id');
    }

    /**
    * Relación inversa con Proyecto (un registro de supervisión pertenece a un proyecto)
    */
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'proyecto_id');
    }
}
