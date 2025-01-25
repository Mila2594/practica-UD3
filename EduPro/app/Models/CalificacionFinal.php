<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalificacionFinal extends Model
{
    use HasFactory;

    protected $table = 'calificaciones_finales';

    protected $fillable= ['fecha_cierre',
    'comentario',
    'proyecto_id'];

    /**
     * Relación con Proyecto (un proyecto tiene una calificación final)
     */
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class,'proyecto_id');
    }

    public function evaluaciones()
    {
        return $this->proyecto->evaluaciones();  // Accede a evaluaciones a través del proyecto
    }

    /**
     * Calcular el promedio basado en las calificaciones de las evaluaciones
     */
    public function calcularPromedio()
    {
        $evaluaciones = $this->evaluaciones;
        if ($evaluaciones->isEmpty()) {
            return null; // Si no hay evaluaciones, el promedio es 0
        }

        // Calcular el promedio de las calificaciones
        $promedio = $evaluaciones->avg('calificacion');

        return round($promedio, 2); // Redondear a 2 decimales
    }

    /**
     * Evento que se ejecuta antes de guardar la calificación final
     */
    protected static function booted()
    {
        static::saving(function ($calificacionFinal) {
            // Calcular el promedio y asignarlo al campo 'promedio'
            $promedio = $calificacionFinal->calcularPromedio();

            if ($promedio === null) {
                // Si no hay evaluaciones, asignar estado como 'en revision'
                $calificacionFinal->estado = 'en revision';
            } else {
                // Si hay evaluaciones, asignar el promedio
                $calificacionFinal->promedio = $promedio;

                // Asignar el estado según el promedio
                if ($calificacionFinal->promedio < 5.0) {
                    $calificacionFinal->estado = 'suspenso';
                } else {
                    $calificacionFinal->estado = 'aprobado';
                }
            }
        });
    }

}
