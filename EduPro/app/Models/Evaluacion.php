<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    use HasFactory;

    protected $fillable=['fecha',
    'comentario',
    'calificacion',
    'profesor_id',
    'calificacion_final_id'];

    /**
     * Relación inversa con Profesor (una evaluación pertenece a un profesor)
     */
    public function profesor()
    {
        return $this->belongsTo(Profesor::class,'profesor_id');
    }

    /**
     * Relacion con proyecto (una evaluacion pertence a un solo proyecto)
     */
    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class,'proyecto_id');
    }
}
